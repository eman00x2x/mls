<?php

namespace Manage\Application\Controller;

class DashboardController extends \Admin\Application\Controller\DashboardController {

	function __construct() {
        parent::__construct();
		$this->setTempalteBasePath(ROOT."Manage");
	}

    function index() {

        $this->getTrafficChart($this->session['account_id'], "this_year");
        $this->getTrafficChart($this->session['account_id'], "this_week");
        $this->getTrafficChart($this->session['account_id'], "this_month");
        
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