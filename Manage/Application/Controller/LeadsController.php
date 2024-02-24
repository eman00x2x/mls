<?php

namespace Manage\Application\Controller;

use \Admin\Application\Controller\SessionController;

class LeadsController extends \Admin\Application\Controller\LeadsController {
	
	private $doc;
	public $account_id;
	public $session;
	
	function __construct() {

		parent::__construct();
		$this->session = SessionController::getInstance()->session->get("user_logged");
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