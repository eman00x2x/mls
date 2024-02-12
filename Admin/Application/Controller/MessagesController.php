<?php

namespace Admin\Application\Controller;

class MessagesController extends \Main\Controller {

	private $doc;
	private $ws_client;
	private $websocketAddress = "ws://localhost:8980/mls/Manage/webSocketServer.php";

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
/* 
		$this->ws_client = new \WebSocket\Client($this->websocketAddress);
		$this->ws_client
			// Add standard middlewares
			->addMiddleware(new \WebSocket\Middleware\CloseHandler())
			->addMiddleware(new \WebSocket\Middleware\PingResponder())
			; */

	}
	
	function index() {

		$this->doc->setTitle("Messages");

		$deleted_thread = $this->getModel("DeletedThread");
		$deleted_thread->select(" GROUP_CONCAT(thread_id) as thread_ids ");
		$deleted_thread->column['account_id'] = $_SESSION['account_id'];
		$data['deletedThreads'] = $deleted_thread->getByAccountId();
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		$filters[] = " JSON_CONTAINS(participants, '".$_SESSION['account_id']."', '$')";
		
		if($data['deletedThreads']['thread_ids']) {
			$filters[] = " thread_id NOT IN(".$data['deletedThreads']['thread_ids'].")";
		}

		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$thread = $this->getModel("Thread");
		$thread->where(isset($clause) ? implode("",$clause) : null)
		->orderBy(" created_at DESC ");

		$thread->page['limit'] = 20;
		$thread->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$thread->page['target'] = url("MessagesController@index");
		$thread->page['uri'] = (isset($uri) ? $uri : []);

		$data['threads'] = $thread->getList();
		
		if($data['threads']) {

			$account = $this->getModel("Account");
			$message = $this->getModel("Message");
			$user = $this->getModel("User");
			
			for($i=0; $i<count($data['threads']); $i++) {

				unset($data['threads'][$i]['accounts']);

				for($x=0; $x<count($data['threads'][$i]['participants']); $x++) {
					
					$account->column['account_id'] = $data['threads'][$i]['participants'][$x];
					$accountData = $account->getById();

					unset($accountData['account_type']);
					unset($accountData['tin']);
					unset($accountData['preferences']);
					unset($accountData['privileges']);

					$data['threads'][$i]['accounts'][$x] = $accountData;

				}

				$account->column['account_id'] = $data['threads'][$i]['created_by'];
				$accountData = $account->getById();

				$data['threads'][$i]['created_by'] = $accountData;
				$data['last_message'] = $message->getLastMessage($data['threads'][$i]['thread_id']);

				if($data['last_message']) {
					$user->select(" user_id, name, email ");
					$user->column['user_id'] = $data['last_message']['user_id'];
					$data['last_message']['from'] = $user->getById();
				}

			}
		}

		$this->setTemplate("messages/messages.php");
		return $this->getTemplate($data,$thread);

	}

	function getThreadInfoByParticipants($participants) {

		$thread = $this->getModel("Thread");
		$thread->column['participants'] = $participants;
		$data = $thread->getByParticipants();

		return json_encode($data);

	}

	function conversation($participants) {

		if(isset($participants)) {

			$participants = base64_decode($participants);

			$this->doc->setTitle("Conversation");

			$this->ajaxChatScript();
			/* $this->webSocketChatScript(); */

			$unset_account_data = explode(",","account_type,preferences,privileges,uploads");
			$unset_user_data = explode(",","user_id,password,user_level,permissions,two_factor_authentication,two_factor_authentication_aps");

			$participants = json_decode($participants, true);

			$account = $this->getModel("Account");
			foreach($participants as $participant_account_id) {
				$account->column['account_id'] = $participant_account_id;
				$data['participants'][$participant_account_id] = $account->getById();

				foreach($unset_account_data as $column) {
					unset($data['participants'][$participant_account_id][$column]);
				}
			}

			$data['participants_id'] = $participants;

			$data['thread'] = json_decode($this->getThreadInfoByParticipants(json_encode($participants)), true);
			
			if($data['thread']) {

				$message = $this->getModel("Message");
				$data['messages'] = $message->execute(" SELECT * 
					FROM (SELECT * FROM #__messages WHERE thread_id = ".$data['thread']['thread_id']." ORDER BY created_at DESC LIMIT 20) as sub 
					ORDER BY created_at ASC
				");

				if($data['messages']) {
					$user = $this->getModel("User");
					for($i=0; $i<count($data['messages']); $i++) {
						$user->column['user_id'] = $data['messages'][$i]['user_id'];
						$data['messages'][$i]['user'] = $user->getById();

						foreach($unset_user_data as $column) {
							unset($data['messages'][$i]['user'][$column]);
						}
					}
				}
			}else {
				$data['messages'] = false;
			}

			$this->setTemplate("messages/view.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}

	/* function view($participants) {

		$this->doc->setTitle("Messages");
		$this->ajaxChatScript($id);
		#$this->webSocketChatScript($id);

		$unset_account_data = explode(",","account_type,preferences,privileges,uploads");
		$unset_user_data = explode(",","user_id,password,user_level,permissions,two_factor_authentication,two_factor_authentication_aps");
		
		
		$thread = $this->getModel("Thread");
		$thread->column['participants'] = $participants;
		$data = $thread->getByParticipants();
		
		$account = $this->getModel("Account");
		for($i=0; $i<count($data['participants']); $i++) {
			$account->column['account_id'] = $data['participants'][$i];
			$data['participant'][$data['participants'][$i]] = $account->getById();

			foreach($unset_account_data as $column) {
				unset($data['participant'][$data['participants'][$i]][$column]);
			}
		}

		$data['participants'] = $data['participant'];
		unset($data['participant']);

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

					foreach($unset_user_data as $column) {
						unset($data['messages'][$i]['user'][$column]);
					}

				}
			}

			$this->setTemplate("messages/view.php");
			return $this->getTemplate($data, $message);

		}

		$this->response(404);

	} */

	function getMessages($participants,$lastMessageId) {

		$data['thread'] = json_decode($this->getThreadInfoByParticipants(base64_decode($participants)), true);

		if($data['thread']) {

			$message = $this->getModel("Message");
			$message->and(" message_id > $lastMessageId ");
			$message->orderBy(" created_at DESC ");
			$data['messages'] = $message->getByThreadId($data['thread']['thread_id']);

			if($data['messages']) {
				$user = $this->getModel("User");
				for($i=0; $i<count($data['messages']); $i++) {
					$user->column['user_id'] = $data['messages'][$i]['user_id'];
					$data['messages'][$i]['user'] = $user->getById();
				}

				$this->setTemplate("messages/getMessages.php");
				return $this->getTemplate($data);
			}

		}

	}

	function saveNewMessage() {

		parse_str(file_get_contents('php://input'), $_POST);

		$data['thread'] = json_decode($this->getThreadInfoByParticipants($_POST['participants']), true);

		if($data['thread']) {
			$thread_id = $data['thread']['thread_id'];
		}else {
			$thread = $this->getModel("Thread");
            $response = $thread->saveNew(array(
				"participants" => $_POST['participants'],
				"created_by" => $_SESSION['user_id'],
				"created_at" => DATE_NOW
			));

			$thread_id = $response['id'];
		}

		$message = $this->getModel("Message");

		$data = array(
			"user_id" => $_SESSION['user_id'],
			"thread_id" => $thread_id,
			"message" => $_POST['message'],
			"attachment" => null,
			"created_at" => DATE_NOW
		);

		$message_response = $message->saveNew($data);

		$user = $this->getModel("User");
		$user->column['user_id'] = $_SESSION['user_id'];
		$data['user'] = $user->getById();

		$response['thread_id'] = $thread_id;
		$response['user_id'] = $_SESSION['user_id'];
		$response['photo'] = $data['user']['photo'];
		$response['user_name'] = $data['user']['name'];
		$response['user_message'] = base64_encode($data['message']);;
		$response['user_sent_time'] = date("M d, Y h:ia",$data['created_at']);

		return json_encode(array(
			"status" => 1,
			"type" => "success",
			"id" => $message_response['id'],
			"thread_id" => $thread_id,
			"data" => $response
		));

	}
	
	function saveDeletedThread($id) {
		
		if($id) {
			if(isset($_REQUEST['delete'])) {
				$message = $this->getModel("DeletedThread");
				$response = $message->saveNew(array(
					"account_id" => $_SESSION['account_id'],
					"thread_id" => $id,
					"deleted_by" => $_SESSION['name'],
					"deleted_at" => DATE_NOW
				));

				$data['id'] = $response['id'];

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

	function webSocketChatScript() {

		/** 
		 * Run the websocket server first before using this
		 * webSocketServer.php
		 * 
		 * */

		$this->doc->addScriptDeclaration("

		    var wsUri = '".$this->websocketAddress."?name=" . (str_replace(" ","+",$_SESSION['name'])) ."';
			var websocket = new WebSocket(wsUri);
			var thread_id = 0;

			$(document).ready(function() {
				var div = $('.card-body');
				div.scrollTop(div[0].scrollHeight - div[0].clientHeight);

				websocket.onopen = function(ev) { // connection is open 
					console.log(' Server Open ');
				}

				websocket.onmessage = function(ev) {
					var response	= JSON.parse(ev.data);
					if(thread_id == response.thread_id) {
						html = buildMessage(response);
						$('.chat-bubbles').append(html);
					}
					div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
				};

				websocket.onerror	= function(ev) { 
					console.log('Error Occurred - ' + ev.data);
					$('#serverErrorModal').show({
						backdrop: 'static',
						keyboard: false
					});
				};

				websocket.onclose 	= function(ev) {
					console.log('Connection Closed');
					$('#serverErrorModal').show({
						backdrop: 'static',
						keyboard: false
					});
				};

			});

			$(document).on('click', '.btn-send-message', function() { sendMessage(); });
			$( document ).on( 'keydown', '#message', function( e ) { if(e.which == 13){ $('.btn-send-message').trigger('click'); } });

			function sendMessage(){
				
				var message = $('#message').val();
				var participants = $('#participants').val();
				if(message != '') {

					$('.btn-send').removeClass('btn-send-message');
					
					$.post('".url("MessagesController@saveNewMessage")."', {
						'participants': participants,
						'message': message 
					},function(data) {
						response = JSON.parse(data);

						websocket.send(JSON.stringify(response.data));
						$('#message').val('');

						$('#thread_id').val(response.data['thread_id']);
						thread_id = response.data['thread_id'];

						$('.btn-send').addClass('btn-send-message');
					});
				}

			}

			function buildMessage(response) {

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
									html += \"<p>\" + atob(response.user_message) + \"</p>\";
								html += \"</div>\";
							html += \"</div>\";
						html += \"</div>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar' style='background-image: url(\"+response.photo+\")'></span>\";
						html += \"</div>\";
					html += \"</div>\";
	
				}else {

					html = \"<div class='row align-items-end'>\";
						html += \"<div class='col-auto'>\";
							html += \"<span class='avatar' style='background-image: url(\"+response.photo+\")'></span>\";
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
									html += \"<p>\" + atob(response.user_message) + \"</p>\";
								html += \"</div>\";
							html += \"</div>\";
						html += \"</div>\";
					html += \"</div>\";

				}

				return html;
			}

		");

	}

	function ajaxChatScript() {

		$this->doc->addScriptDeclaration("

		    var div;
			var idleTime = 0;
			var thread_id;
			
			$(document).ready(function() {
				div = $('.card-body');
				thread_id = parseInt($('#thread_id').val());
				div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
				div.bind('scroll', fetchMore);
				setInterval(fetchMore, 8000);
			});

			fetchMore = function() {
				
				var lastMessageId = $('.last_message_id').val();
				var participants = $('#participants').val();
				
				if(div.scrollTop() + div.innerHeight() >= div[0].scrollHeight) {
					if(thread_id > 0) {
						div.unbind('scroll', fetchMore);
						$.get(MANAGE+'threads/' + btoa(participants) + '/getMessages/' + lastMessageId, function(data) {
							if(data != '') {
								$('.last_message_id').remove();
								$('.chat-bubbles').append(data);
								div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
							}
							div.bind('scroll',fetchMore);
						});
					}
				}
			};

			$(document).on('click', '.btn-send-message', function() { sendMessage(); });
			$( document ).on( 'keydown', '#message', function( e ) { if(e.which == 13){ $('.btn-send-message').trigger('click'); } });

			function sendMessage() {

				var message = $('#message').val();
				var participants = $('#participants').val();

				if(message != '') {

					$('.btn-send').removeClass('btn-send-message');

					$.post('".url("MessagesController@saveNewMessage")."', {
						'participants': participants,
						'message': message 
					},function(data) {

						response = JSON.parse(data);

						eval('('+fetchMore+')()');
						$('#message').val('');
						div.scrollTop(div[0].scrollHeight - div[0].clientHeight);

						$('#thread_id').val(response.data['thread_id']);
						thread_id = response.data['thread_id'];

						$('.btn-send').addClass('btn-send-message');
						
					});
				}
			}
			
		");

	}

}