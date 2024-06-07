<?php

namespace Manage\Application\Controller;

class DashboardController extends \Admin\Application\Controller\DashboardController {

	function __construct() {

        parent::__construct();
		$this->setTempalteBasePath(ROOT."/Manage");

        if(KYC == 1) {
            if($this->session['kyc'] === false) {
				if(CONFIG['kyc_options']['hide_listings_if_kyc_expired'] == 1) {
					$this->getLibrary("Factory")->setMsg("Your property listings have been hidden from the public website and MLS. You must complete the KYC process before your listings can be viewed. <a href='".url("KYCController@kycVerificationForm")."'>Proceed to KYC</a>", "warning");	
				}
            }
        }

	}

    function index() {

        $this->doc->setTitle("Dashboard");

        $this->getTrafficChart($this->session['account_id'], "this_year");
        $this->getTrafficChart($this->session['account_id'], "this_week");
        $this->getTrafficChart($this->session['account_id'], "this_month");

        $data['premium'] = $this->getActivePremium();
        
        $data['max_post'] = $this->session['privileges']['max_post'];
        $data['handshake_participants'] = $this->getHandshakeParticipants($this->session['account_id']);
        $data['total_active_handshake'] = $this->getTotalActiveHandshake($this->session['account_id']);
        $data['total_listings'] = $this->getTotalListings($this->session['account_id']);
        $data['this_month_leads'] = $this->getTotalLeads($this->session['account_id'], "this_month");
        $data['most_traffic'] = $this->getMostTraffic($this->session['account_id']);

        $this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);
    }

}