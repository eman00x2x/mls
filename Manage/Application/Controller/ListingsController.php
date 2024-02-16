<?php

namespace Manage\Application\Controller;

class ListingsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	
	function __construct() {
		parent::__construct();
		$this->account_id = $_SESSION['user_logged']['account_id'];
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