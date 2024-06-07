<?php

namespace Manage\Application\Controller;

class MessagesController extends \Admin\Application\Controller\MessagesController {
	
	private $account_id;
	
	function __construct() {
		parent::__construct();

		$this->account_id = $this->session['account_id'];

		if($this->session['privileges']['chat_access'] <= 0) {
			$this->getLibrary("Factory")->setMsg("Accessing Chat requires premium privileges. Elevate your subscription status or opt for a premium subscription to unlock access.", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		if(KYC == 1) {
            if($this->session['kyc'] === false) {
				if(CONFIG['kyc_options']['hide_listings_if_kyc_expired'] == 1) {
					$this->getLibrary("Factory")->setMsg("Your property listings have been hidden from the public website and MLS. You must complete the KYC process before your listings can be viewed. <a href='".url("KYCController@kycVerificationForm")."'>Proceed to KYC</a>", "warning");	
				}
            }
        }
		
	}
	
}