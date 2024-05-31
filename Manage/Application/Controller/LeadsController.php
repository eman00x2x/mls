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

		if($this->session['kyc'] === false) {
            if(KYC == 1) {
                $this->getLibrary("Factory")->setMsg("Your property listings have been hidden from the public website and MLS. You must complete the KYC process before your listings can be viewed. <a href='".url("KYCController@kycVerificationForm")."'>Proceed to KYC</a>", "warning");
            }
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