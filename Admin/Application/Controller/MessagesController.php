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

		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$clause[] = " JSON_CONTAINS(accounts, '".$_SESSION['account_id']."', '$')";
		
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

		$thread = $this->getModel("Thread");
		$thread->column['thread_id'] = $id;
		$data = $thread->getById();

		if($data) {

			$message = $this->getModel("Message");
			$message->orderBy(" created_at DESC ");
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

	function showMessages($thread_id,$last_message_id) {

		$message = $this->getModel("Message");
		$message->and(" message_id > $last_message_id ");
		$message->orderBy(" created_at DESC ");
		$data['messages'] = $message->getByThreadId($thread_id);

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
		
		$time = DATE_NOW;

		$message = $this->getModel("Message");
		$id = $message->saveNew(array(
			"user_id" => $_SESSION['user_id'],
			"thread_id" => $_POST['thread_id'],
			"details" => json_encode(array(
				"type" => "text",
				"content" => $_POST['message']
			)),
			"created_at" => $time
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
		parse_str(file_get_contents('php://input'), $_POST);

	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		foreach($_POST['script'] as $privilege => $val) {
			if($_POST['script'][$privilege] == "" || $_POST['script'][$privilege] == 0) {
				unset($_POST['script'][$privilege]);
			}
		}

		$_POST['script'] = json_encode($_POST['script']);

		$premium = $this->getModel("Premium");
		$response = $premium->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function saveUpdate($id) {
	
		parse_str(file_get_contents('php://input'), $_POST);

		if($id) {

			foreach($_POST['script'] as $privilege => $val) {
				if($_POST['script'][$privilege] == "" || $_POST['script'][$privilege] == 0) {
					unset($_POST['script'][$privilege]);
				}
			}

			$_POST['script'] = json_encode($_POST['script']);
			
			$premium = $this->getModel("Premium");
			$response = $premium->save($id,$_POST);
			
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(
				array(
					"status" => $response['status'],
					"message" => getMsg()
				)
			);
			
		}else {
			$this->getLibrary("Factory")->setMsg("Account Subscription not found!.","error");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}
		
	}
	
	function delete($id) {

		if($id) {
		
			$premium = $this->getModel("Premium");
			$premium->column['premium_id'] = $id;
			$data = $premium->getById();

			if(isset($_REQUEST['delete'])) {
				/** DELETE ACCOUNT SUBSCRIPTION */
				$account_subscription = $this->getModel("AccountSubscription");
				$account_subscription->deleteSubscription($id,"premium_id");

				$premium->deletePremium($id);

				$this->getLibrary("Factory")->setMsg("A Premium has been deleted!.","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}else {
		
				if($data) {
					$this->setTemplate("premiums/delete.php");
					return $this->getTemplate($data);
				}

			}

		}

		$this->response(404);
		
	}
	
}