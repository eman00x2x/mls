<?php

namespace Manage\Application\Controller;

use \Admin\Application\Controller\SessionController;

class ListingsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	private $session;
	
	function __construct() {
		parent::__construct();
		$this->session = SessionController::getInstance()->session->get("user_logged");
		$this->account_id = $this->session['account_id'];
	}
	
	function listingIndex() {
		$this->setTempalteBasePath(ROOT."Manage");
		return parent::index($this->account_id);
	}
	
	function editListing($id) {
		return parent::edit($this->account_id,$id);
	}
	
	function addListing() {
		return parent::add($this->account_id);
	}

	function saveNew() {
		return parent::saveNew();
	}

}