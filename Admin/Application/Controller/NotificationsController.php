<?php

namespace Admin\Application\Controller;

class NotificationsController extends \Main\Controller {

	private $doc;
	var $account_id;

	function __construct() {

		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['user_logged']['account_id'];

	}
	
	function index() {

		$notification = $this->getModel("Notification");

		$notification->page['limit'] = 20;
		$notification->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$notification->page['target'] = url("NotificationsController@index");
		$notification->page['uri'] = (isset($uri) ? $uri : []);

		$notification->where(" account_id = ".$this->account_id);
		$data = $notification->getList();

		$this->setTemplate("notifications/notifications.php");
		return $this->getTemplate($data,$notification);

	}

	function getLatest() {

		$notification = $this->getModel("Notification");

		$notification->page['limit'] = 20;
		$notification->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$notification->page['target'] = url("NotificationsController@index");
		$notification->page['uri'] = (isset($uri) ? $uri : []);

		$notification->where(" account_id = ".$this->account_id);
		$notification->and(" status = 1 ");
		$data = $notification->getList();

		if($data) {
			$this->setTemplate("notifications/latest.php");
			return $this->getTemplate($data,$notification);
		}

	}

	function createNotification($account_id, $data) {

		$data['content'] = array(
			"title" => $data['title'],
			"message" => $data['message'],
			"url" => $data['url'],
		);

		$data['account_id'] = $account_id;
		$data['status'] = 1;
		$data['created_at'] = DATE_NOW;

		$notification = $this->getModel("Notification");
		$response = $notification->saveNew($data);

		return json_encode(array(
			"status" => 1,
			"type" => "success",
			"id" => $response['id']
		));

	}

	function updateNotification($id) {

		$notification = $this->getModel("Notification");
		$notification->column['notification_id'] = $id;
		$data = $notification->getById();

		if($data) {
			$notification->save($id, array("status" => 0));

			return json_encode(array(
				"status" => 1,
				"url" => $data['content']['url']
			));

		}

		$this->response(404);

	}
	
}

