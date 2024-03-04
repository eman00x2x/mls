<?php

namespace Manage\Application\Controller;

class MessagesController extends \Admin\Application\Controller\MessagesController {
	
	private $account_id;
	
	function __construct() {
		parent::__construct();

		$this->account_id = $this->session['account_id'];

		if(!isset($this->session['privileges']['chat_access'])) {
			$this->getLibrary("Factory")->setMsg("Accessing Chat requires premium privileges. Elevate your subscription status or opt for a premium subscription to unlock access.", "warning");
			response()->redirect(url("DashboardController@index"));
		}
	}
	
}