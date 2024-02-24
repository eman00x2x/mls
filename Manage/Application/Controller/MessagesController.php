<?php

namespace Manage\Application\Controller;

use \Admin\Application\Controller\SessionController;

class MessagesController extends \Admin\Application\Controller\MessagesController {
	
	private $account_id;
	public $session;
	
	function __construct() {
		parent::__construct();

		$this->session = SessionController::getInstance()->session->get("user_logged");
		$this->account_id = $this->session['account_id'];

		if(!isset($this->session['privileges']['chat_access'])) {
			$this->getLibrary("Factory")->setMsg("Accessing Chat requires premium privileges. Elevate your subscription status or opt for a premium subscription to unlock access.", "warning");
			response()->redirect(url("DashboardController@index"));
		}
	}
	
}