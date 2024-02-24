<?php

namespace Manage\Application\Controller;

use \Admin\Application\Controller\SessionController;

class ListingsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	public $session;
	
	function __construct() {
		parent::__construct();
		$this->session = SessionController::getInstance()->session->get("user_logged");
		$this->account_id = $this->session['account_id'];

		if(!$this->session['permissions']['properties']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permissions to access this content.", "warning");
			response()->redirect(url("DashboardController@index"));
		}
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