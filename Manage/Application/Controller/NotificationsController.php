<?php

namespace Manage\Application\Controller;

class NotificationsController extends \Admin\Application\Controller\NotificationsController {

	private $doc;
	var $account_id;

	function __construct() {
		
		parent::__construct();
		$this->account_id = $_SESSION['user_logged']['account_id'];

	}
	
}

