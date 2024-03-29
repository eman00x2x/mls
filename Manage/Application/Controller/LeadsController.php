<?php

namespace Manage\Application\Controller;

class LeadsController extends \Admin\Application\Controller\LeadsController {
	
	public $account_id;
	
	function __construct() {

		parent::__construct();
		$this->account_id = $this->session['account_id'];

		if(!$this->session['permissions']['leads']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permissions to access this content.", "warning");
			response()->redirect(url("DashboardController@index"));
		}

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
		return parent::saveUpdate($id);
	}
	
	function delete($id) {

		if(!$this->session['permissions']['leads']['delete']) {
			$this->getLibrary("Factory")->setMsg("You do not have permissions to access this content.", "warning");
			return getMsg();
		}

		return parent::delete($id);
	}

		
	
}