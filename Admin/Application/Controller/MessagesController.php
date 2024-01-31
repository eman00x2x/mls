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
		$data['deletedThreads'] = $thread->getById();
		

		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$clause[] = " JSON_CONTAINS(accounts, '".$_SESSION['account_id']."', '$')";
		
		if($data['deletedThreads']) {
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
				$(window).bind('scroll', fetchMore);
				var fetchMessages = setInterval(fetchMore, 10000);

				var idleInterval = setInterval(function() {
					idleTime = idleTime + 1;
					clearInterval(fetchMessages);
				}, 60000);

				$(this).mousemove(function(e) {
					if(idleTime > 0) {
						fetchMessages = setInterval(fetchMore, 10000);
					}

					idleTime = 0;
				});

				$(this).keypress(function(e) {
					if(idleTime > 0) {
						fetchMessages = setInterval(fetchMore, 10000);
					}

					idleTime = 0;
				});
			});

			$(document).on('click', '.btn-send-message', function() {
				$.post('".url("MessagesController@saveNewMessage")."',function(data) {

				});
			});

			fetchMore = function() {
				var lastMessageId = $('#last_message_id').val();
				var div = $('.chat');

				if(div.scrollTop() >= div.clientHeight) {
					$(window).unbind('scroll', fetchMore);
					$.get('/messages/$id/showMessages/' + lastMessageId, { 'lastMesageId' : lastMesageId }, function(data) {
						if(data != '') {
							$('#last_message_id').remove();
							$('.chat-bubbles').append(data);
							$(window).bind('scroll',fetchMore);
							div.scrollTop(div.prop('scrollHeight'));
						}
					});
				}
			}
			
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
					$user->column['user_id'] = $data[$i]['user_id'];
					$data['messages'][$i]['user'] = $user->getById();
				}
			}

			$this->setTemplate("messages/view.php");
			return $this->getTemplate($data);

		}

		$this->response(404);

	}

	function showMessages($id,$last_message_id) {

		$message = $this->getModel("Message");
		$message->and(" message_id > $last_message_id ");
		$message->orderBy(" created_at DESC ");
		$data['messages'] = $message->getByThreadId($id);

		if($data['messages']) {
			$user = $this->getModel("User");
			for($i=0; $i<count($data['messages']); $i++) {
				$user->column['user_id'] = $data[$i]['user_id'];
				$data['messages'][$i]['user'] = $user->getById();
			}
		}

		$this->setTemplate("messages/showMessages.php");
		return $this->getTemplate($data);

	}

	function saveNewMessage() {
		parse_str(file_get_contents('php://input'), $_POST);
		
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