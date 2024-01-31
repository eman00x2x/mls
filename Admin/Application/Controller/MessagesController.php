<?php

namespace Admin\Application\Controller;

class MessagesController extends \Main\Controller {

	private $doc;

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
	
	function view($id) {

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
				
				var div = $('.card-body');

				if(div.scrollTop() >= div[0].scrollHeight - div[0].clientHeight ) {
					var lastMessageId = $('#last_message_id').val();
					div.unbind('scroll', fetchMore);
					$.get('/messages/$id/showMessages/' + lastMessageId, function(data) {
						
						if(data != '') {
							$('#last_message_id').remove();
							$('.chat-bubbles').append(data);
							div.bind('scroll',fetchMore);
							div.scrollTop(div[0].scrollHeight - div[0].clientHeight);
						}
					});
				}
			}

			$(document).on('click', '.btn-send-message', function() {
				postMessage();
			});

			/* function postMessage() {

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
			 */
		");

		$thread = $this->getModel("Thread");
		$thread->column['thread_id'] = $id;
		$data = $thread->getById();

		if($data) {

			$message = $this->getModel("Message");
			$message->orderBy(" created_at ASC ");
			$data['messages'] = $message->getByThreadId($data['thread_id']);

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
				$user->column['user_id'] = $data[$i]['user_id'];
				$data['messages'][$i]['user'] = $user->getById();
			}

			$this->setTemplate("messages/showMessages.php");
			return $this->getTemplate($data);

		}

	}

	function saveNewMessage() {
		parse_str(file_get_contents('php://input'), $_POST);
		
		$message = $this->getModel("Message");
		$id = $message->saveNew(array(
			"user_id" => $_SESSION['user_id'],
			"thread_id" => $_POST['thread_id'],
			"message" => $_POST['message'],
			"attachment" => null,
			"created_at" => DATE_NOW
		));

		return json_encode(array(
			"status" => 1,
			"type" => "success",
			"id" => $id
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
					"details" => json_encode(array(
						"type" => "text",
						"content" => $_POST['message']
					)),
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