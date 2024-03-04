<?php

namespace Admin\Application\Controller;

use Josantonius\Session\Facades\Session;

class NotificationsController extends \Main\Controller {

	public $doc;
	public $account_id;
	public $session;

	function __construct() {

		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();

		$this->session = Session::get("user_logged");
		$this->account_id = $this->session['account_id'];

	}
	
	function index() {

		$notification = $this->getModel("Notification");

		$notification->page['limit'] = 20;
		$notification->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$notification->page['target'] = url("NotificationsController@index");
		$notification->page['uri'] = (isset($uri) ? $uri : []);

		$notification->where(" account_id = ".$this->account_id)->orderBy(" status DESC, created_at DESC");
		$data = $notification->getList();

		$this->setTemplate("notifications/index.php");
		return $this->getTemplate($data,$notification);

	}

	function getLatest() {

		$notification = $this->getModel("Notification");

		$notification->page['limit'] = 5;
		$notification->where(" account_id = ".$this->account_id)
			->and(" status = 1 ")
			->orderBy(" status DESC, created_at DESC");
		$data = $notification->getList();

		if($data) {
			$this->setTemplate("notifications/latest.php");
			return $this->getTemplate($data,$notification);
		}

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

