<?php

namespace Admin\Application\Controller;

class MessagesController extends \Main\Controller {

	private $doc;
	private $websocketAddress = "ws://192.168.2.2:5465/mls/Manage/webSocketServer.php";

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();

	}
	
	function index() {

		$this->doc->setTitle("Messages");

		$thread = $this->getModel("DeletedThread");
		$thread->select(" GROUP_CONCAT(thread_id) as thread_ids ");
		$thread->column['account_id'] = $_SESSION['account_id'];
		$data['deletedThreads'] = $thread->getByAccountId();
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$clause[] = " JSON_CONTAINS(accounts, '".$_SESSION['account_id']."', '$')";
		
		if($data['deletedThreads']['thread_ids']) {
			$clause[] = " thread_id NOT IN(".$data['deletedThreads']['thread_ids'].")";
		}

		$message = $this->getModel("Thread");
		$message->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" created_at DESC ");

		$message->page['limit'] = 20;
		$message->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$message->page['target'] = url("MessagesController@index");
		$message->page['uri'] = (isset($uri) ? $uri : []);

		$data['threads'] = $message->getList();
		
		if($data['threads']) {

			$user = $this->getModel("User");
			$account = $this->getModel("Account");
			
			for($i=0; $i<count($data['threads']); $i++) {

				unset($data['threads'][$i]['accounts']);

				for($x=0; $x<count($data['threads'][$i]['participants']); $x++) {
					$user->column['user_id'] = $data['threads'][$i]['participants'][$x];
					$userData = $user->getById();

					unset($userData['username']);
					unset($userData['password']);
					unset($userData['user_level']);
					unset($userData['permissions']);

					$account->column['account_id'] = $userData['account_id'];
					$accountData = $account->getById();

					unset($userData['account_id']);
					unset($accountData['account_type']);
					unset($accountData['tin']);
					unset($accountData['preferences']);
					unset($accountData['privileges']);

					$data['threads'][$i]['participants'][$x] = $userData;
					$data['threads'][$i]['participants'][$x]['account'] = $accountData;

				}

				$user->column['user_id'] = $data['threads'][$i]['created_by'];
				$userData = $user->getById();

				unset($userData['username']);
				unset($userData['password']);
				unset($userData['user_level']);
				unset($userData['permissions']);

				$account->column['account_id'] = $userData['account_id'];
				$accountData = $account->getById();

				unset($userData['account_id']);
				unset($accountData['account_type']);
				unset($accountData['tin']);
				unset($accountData['preferences']);
				unset($accountData['privileges']);

				$data['threads'][$i]['created_by'] = $userData;
				$data['threads'][$i]['created_by']['account'] = $accountData;

			}
		}

		$this->setTemplate("messages/messages.php");
		return $this->getTemplate($data,$message);

	}
	
	/* function view($id) {

		$this->doc->setTitle("Messages");

		$this->doc->addScriptDeclaration("

			var idleTime = 0;
			$(document).ready(function() {
				var div = $('.card-body');
				div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
				
				div.bind('scroll', fetchMore);
				setInterval(fetchMore, 10000);
				
			});

			fetchMore = function() {
				
				var lastMessageId = $('.last_message_id').val();
				var div = $('.card-body');

				if(div.scrollTop() + div.innerHeight() >= div[0].scrollHeight) {
					
					div.unbind('scroll', fetchMore);
					$.get('/messages/$id/showMessages/' + lastMessageId, function(data) {
						if(data != '') {
							$('.last_message_id').remove();
							$('.chat-bubbles').append(data);
							div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
						}
						div.bind('scroll',fetchMore);
					});
				}
			};

			$(document).on('click', '.btn-send-message', function() {
				postMessage();
			});

			function postMessage() {

				var message = $('#message').val();
				if(message != '') {
					$.post('".url("MessagesController@saveNewMessage")."', { 
						'thread_id':$id,
						'message': message 
					},function(data) {
						eval('('+fetchMore+')()');
						$('#message').val('');
					});
				}
			}
			
		");

		$thread = $this->getModel("Thread");
		$thread->column['thread_id'] = $id;
		$data = $thread->getById();

		if($data) {

			$message = $this->getModel("Message");
			$data['messages'] = $message->execute(" SELECT * 
				FROM (SELECT * FROM #__messages WHERE thread_id = ".$data['thread_id']." ORDER BY created_at DESC LIMIT 20) as sub 
				ORDER BY created_at ASC
			");

			if($data['messages']) {
				$user = $this->getModel("User");
				for($i=0; $i<count($data['messages']); $i++) {
					$user->column['user_id'] = $data['messages'][$i]['user_id'];
					$data['messages'][$i]['user'] = $user->getById();
				}
			}

			$this->setTemplate("messages/view.php");
			return $this->getTemplate($data, $message);

		}

		$this->response(404);

	} */

	function view($id) {


		$thread = $this->getModel("Thread");
		$thread->column['thread_id'] = $id;
		$data = $thread->getById();

		$this->doc->setTitle("Messages");

		$this->doc->addScriptDeclaration("

			var wsUri = '".$this->websocketAddress."';
			websocket = new WebSocket(wsUri);
			threadId = $id;

			$(document).ready(function() {
				var div = $('.card-body');
				div.scrollTop(div[0].scrollHeight - div[0].clientHeight);

				websocket.onopen = function(ev) { // connection is open 
					console.log(' Server Open ');
				}

				// Message received from server
				websocket.onmessage = function(ev) {

					console.log('Server: '+ev.data);

					var response	= JSON.parse(ev.data); //PHP sends Json data
					
					if(threadId == response.thread_id) {
						html = build_message(response);
						$('.chat-bubbles').append(html);
					}

					div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
					
				};

				websocket.onerror	= function(ev){ console.log('Error Occurred - ' + ev.data)  }; 
				websocket.onclose 	= function(ev){ console.log('Connection Closed'); };

			});

			//Message send button
			$(document).on('click', '.btn-send-message', function(){
				send_message();
			});

			//User hits enter key 
			$( document ).on( 'keydown', '#message', function( e ) {
				if(e.which == 13){
					send_message();
				}
			});

			//Send message
			function send_message(){
				
				var message = $('#message').val();
				if(message != '') {
					$.post('".url("MessagesController@saveNewMessage")."', {
						'thread_id':$id,
						'message': message 
					},function(data) {
						$('#message').val('');
					});
				}

			}

			function build_message(response) {

				var id = $_SESSION[user_id];
				
				if(response.user_id == id) {
				
					html = \"<div class='row align-items-end justify-content-end '>\";
						html += \"<div class='col col-lg-6'>\";
							html += \"<div class='chat-bubble chat-bubble-me'>\";
								
								html += \"<div class='chat-bubble-title'>\";
									html += \"<div class='row'>\";
										html += \"<div class='col chat-bubble-author'>\";
											html += response.user_name;
										html += \"</div>\";
										html += \"<div class='col-auto chat-bubble-date'>\";
											html += response.user_sent_time;
										html += \"</div>\";
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='chat-bubble-body'>\";
									html += \"<p>\" + response.user_message + \"</p>\";
								html += \"</div>\";
							html += \"</div>\";
						html += \"</div>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar'></span>\";
						html += \"</div>\";
					html += \"</div>\";
	
				}else {

					html = \"<div class='row align-items-end'>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar'></span>\";
						html += \"</div>\";
						html += \"<div class='col col-lg-6'>\";
							html += \"<div class='chat-bubble'>\";
								
								html += \"<div class='chat-bubble-title'>\";
									html += \"<div class='row'>\";
										html += \"<div class='col chat-bubble-author'>\";
											html += response.user_name;
										html += \"</div>\";
										html += \"<div class='col-auto chat-bubble-date'>\";
											html += response.user_sent_time;
										html += \"</div>\";
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='chat-bubble-body'>\";
									html += \"<p>\" + response.user_message + \"</p>\";
								html += \"</div>\";
							html += \"</div>\";
						html += \"</div>\";
					html += \"</div>\";

				}

				return html
			}

		");

		if($data) {

			$message = $this->getModel("Message");
			$data['messages'] = $message->execute(" SELECT * 
				FROM (SELECT * FROM #__messages WHERE thread_id = ".$data['thread_id']." ORDER BY created_at DESC LIMIT 20) as sub 
				ORDER BY created_at ASC
			");

			if($data['messages']) {
				$user = $this->getModel("User");
				for($i=0; $i<count($data['messages']); $i++) {
					$user->column['user_id'] = $data['messages'][$i]['user_id'];
					$data['messages'][$i]['user'] = $user->getById();
				}
			}

			$this->setTemplate("messages/view.php");
			return $this->getTemplate($data, $message);

		}

		$this->response(404);

	}

	function showMessages($thread_id,$lastMessageId) {

		$message = $this->getModel("Message");
		$message->and(" message_id > $lastMessageId ");
		$message->orderBy(" created_at DESC ");
		$data['messages'] = $message->getByThreadId($thread_id);

		if($data['messages']) {
			$user = $this->getModel("User");
			for($i=0; $i<count($data['messages']); $i++) {
				$user->column['user_id'] = $data['messages'][$i]['user_id'];
				$data['messages'][$i]['user'] = $user->getById();
			}

			$this->setTemplate("messages/showMessages.php");
			return $this->getTemplate($data);

		}

	}

	function saveNewMessage() {

		parse_str(file_get_contents('php://input'), $_POST);
		
		$message = $this->getModel("Message");

		$data = array(
			"user_id" => $_SESSION['user_id'],
			"thread_id" => $_POST['thread_id'],
			"message" => $_POST['message'],
			"attachment" => null,
			"created_at" => DATE_NOW
		);

		$id = $message->saveNew($data);

		$user = $this->getModel("User");
		$user->column['user_id'] = $_SESSION['user_id'];
		$data['user'] = $user->getById();

		$response['thread_id'] = $_POST['thread_id'];
		$response['user_id'] = $_SESSION['user_id'];
		$response['user_name'] = $data['user']['name'];
		$response['user_message'] = $data['message'];
		$response['user_sent_time'] = date("M d, Y h:ia",$data['created_at']);

		$client = new \WebSocket\Client($this->websocketAddress);
		$client
			// Add standard middlewares
			->addMiddleware(new \WebSocket\Middleware\CloseHandler())
			->addMiddleware(new \WebSocket\Middleware\PingResponder())
			;

		$client->text(json_encode($response));

		return json_encode(array(
			"status" => 1,
			"type" => "success",
			"id" => $id,
			"data" => $response
		));

	}
	
	function saveNewThread($id) {
		parse_str(file_get_contents('php://input'), $_POST);

	}

	function saveDeletedThread($id) {
		
		if($id) {
			if(isset($_REQUEST['delete'])) {
				$message = $this->getModel("Message");
				$id = $message->saveNew(array(
					"user_id" => $_SESSION['user_id'],
					"thread_id" => $_POST['thread_id'],
					"message" => $_POST['message'],
					"created_at" => DATE_NOW
				));

				$this->getLibrary("Factory")->setMsg("Message deleted!.","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}else {
				$data['id'] = $id;
				$this->setTemplate("messages/removeThread.php");
				return $this->getTemplate($data);
			}
		}

		$this->response(404);
		
	}

}