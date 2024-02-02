<?php

namespace Manage\Application\Controller;

class LeadsController extends \Admin\Application\Controller\LeadsController {
	
	private $doc;
	private $account_id;
	
	function __construct() {
		parent::__construct();
		$this->account_id = $_SESSION['account_id'];
	}

	function index() {
		return parent::index();
	}
	
	function edit($id) {
		return parent::edit($id);
	}
	
	function view($id) {
		return parent::view($id);
	}
	
	function saveUpdate($id) {
		
	}
	
	function delete($id) {
		return parent::delete($id);
	}

		
	
}