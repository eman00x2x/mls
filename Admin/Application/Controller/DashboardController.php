<?php

namespace Admin\Application\Controller;

use Library\Chart;

class DashboardController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

	function index() {

		$this->getTrafficChart();
		$this->getChartEarnings("this_year");

		$data['most_traffic'] = $this->getMostTraffic();
		$data['total_accounts'] = $this->getTotalAccounts();
		$data['total_earnings'] = $this->getEarnings("this_week");

		$this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);

	}

	function getTotalAccounts(): int {

		$accounts = $this->getModel("Account");
		$accounts->page['limit'] = 100000;

		$accounts->select(" COUNT(account_id) as total ");
		$data = $accounts->getList();

		return $data[0]['total'];

	}

	function getTotalLeads($account_id = null, $flag = "this_month"): int {

		$date_helper = \dateHelper($flag);

		$leads = $this->getModel("Lead");
		$leads->page['limit'] = 100000;

		$leads
			->select(" COUNT(lead_id) as total ")
				->where(" inquire_at >= ".$date_helper['from']." AND inquire_at <= ".$date_helper['to']." ");

		if($account_id != null) {
			$leads->and(" account_id = $account_id ");
		}

		$data = $leads->getList();

		if($data[0]['total'] > 0) {
			return $data[0]['total'];
		}else {
			return 0;
		}

	}

	function getTotalListings($account_id = null): int {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 100000;

		$listings
			->select(" COUNT(listing_id) as total ");

		if($account_id != null) {
			$listings->where(" account_id = $account_id ");
		}

		$data = $listings->getList();

		if($data[0]['total'] > 0) {
			return $data[0]['total'];
		}else {
			return 0;
		}

	}

	function getTotalActiveHandshake($account_id = null): int {

		$handshakes = $this->getModel("Handshake");
		$handshakes->page['limit'] = 100000;

		$handshakes
			->select(" COUNT(handshake_id) as total ")
				->where(" handshake_status = 'active' ");

		if($account_id != null) {
			$handshakes->and(" requestee_account_id = $account_id ");
		}

		$data = $handshakes->getList();

		if($data[0]['total'] > 0) {
			return $data[0]['total'];
		}else {
			return 0;
		}

	}

	function getHandshakeParticipants($account_id = null): array {

		$handshakes = $this->getModel("Handshake");
		$handshakes->page['limit'] = 100000;

		$handshakes
			->select(" handshake_id, requestor_details, requestee_account_id, logo, CONCAT(JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.firstname')), ' ', JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.lastname'))) as name, CONCAT(LEFT(JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.firstname')), 1), '', LEFT(JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.lastname')), 1)) as initials")
				->join(" h JOIN #__accounts a ON a.account_id=h.requestee_account_id ")
					->where(" handshake_status = 'active' ");

		if($account_id != null) {
			$handshakes->and(" requestee_account_id = $account_id ");
		}

		$data = $handshakes->getList();

		if($data) {
			return $data;
		}else {
			return [];
		}

	}

	function getEarnings($flag = "this_week"): int {

		$date_helper = \dateHelper($flag);

		$transactions = $this->getModel("Transaction");
		$transactions->page['limit'] = 100000;

		$transactions
			->select(" SUM(premium_price) as total ")
				->where(" created_at >= ".$date_helper['from']." AND created_at <= ".$date_helper['to']." ");
		
		$data = $transactions->getList();

		if($data[0]['total'] > 0) {
			return $data[0]['total'];
		}else {
			return 0;
		}

	}

	function getMostTraffic($account_id = null, $flag = "this_month"): Array {

		$date_helper = \dateHelper($flag);

		$traffic = $this->getModel("ListingView");
        $traffic->page['limit'] = 5;

		$traffic
		->select(" t.listing_id, title, CONCAT(JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.firstname')), ' ', JSON_UNQUOTE(JSON_EXTRACT(a.account_name, '$.lastname'))) as posted_by, COUNT(session_id) as count ")
			->join(" t JOIN #__listings l ON t.listing_id=l.listing_id JOIN #__accounts a ON a.account_id=t.account_id ")
				->where(" created_at >= ".$date_helper['from']." AND created_at <= ".$date_helper['to']." ")
					->groupBy(" t.listing_id ");

		if($account_id != null) {
			$traffic->and(" t.account_id = $account_id ");
		}
		
        $data = $traffic->getList();

		if($data) {
			return $data;
		}

		return [];

	}

	function getTrafficChart($account_id = null, $flag = "this_year"): void {

		$date_helper = \dateHelper($flag);

		$traffic = $this->getModel("ListingView");
        $traffic->page['limit'] = 100000;

		if($account_id != null) {
			$filter[] = " account_id = $account_id ";
		}

		$filter[] = " created_at >= ".$date_helper['from']." ";
		$filter[] = " created_at <= ".$date_helper['to']." ";

		switch($flag) {
			case 'this_year':
				$traffic->select(" FROM_UNIXTIME(created_at, '%Y-%m') as date, COUNT(session_id) as count ");
				break;

			case 'this_month':
				$traffic->select(" FROM_UNIXTIME(created_at, '%Y-%m-%d') as date, COUNT(session_id) as count ");
				break;

			case 'this_week':
				$traffic->select(" FROM_UNIXTIME(created_at, '%Y-%m-%d') as date, COUNT(session_id) as count ");
				break;

		}

		
		$traffic->where( implode(" AND ", $filter) )
					->groupBy(" date ")
						->orderBy(" created_at ASC ");

        $data = $traffic->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$chart['series'][] = $data[$i]['count'];
				$chart['labels'][] = $data[$i]['date'];
			}

			$chart_data['labels'] = json_encode($chart['labels']);
			$chart_data['series'] = json_encode($chart['series']);

			$this->getLibrary("Charts")->getLineChart($chart_data, "getTrafficChart_$flag", "Traffic");

		}

	}

	function getChartEarnings($flag = "this_year"): void {

		$date_helper = \dateHelper($flag);

		$transactions = $this->getModel("Transaction");
		$transactions->page['limit'] = 100000;

		$transactions
		->select(" SUM(premium_price) as total, FROM_UNIXTIME(created_at, '%Y-%m') as date ")
		->where(" created_at >= ".$date_helper['from']." AND created_at <= ".$date_helper['to']." ")
		->groupBy(" date ");

		$data = $transactions->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$chart['labels'][] = $data[$i]['date'];
				$chart['series'][] = $data[$i]['total'];
			}
		}

		$chart_data['labels'] = json_encode($chart['labels']);
		$chart_data['series'] = json_encode($chart['series']);

		$this->getLibrary("Charts")->getLineChart($chart_data, "getChartEarnings", "Earnings");

	}

	function getKycStatus() {

        $kyc = $this->getModel("KYC");
        $kyc->page['limit'] = 100000;

        $kyc->select(" COUNT(kyc_status) as total, 
            CASE
                WHEN kyc_status = 0 THEN 'KYC Pending Verification'
                WHEN kyc_status = 1 THEN 'KYC Verified'
                WHEN kyc_status = 2 THEN 'KYC Verification Denied'
                WHEN kyc_status = 3 THEN 'KYC ID Expired'
            END as description
        ")->groupBy(" kyc_status ");

        $data = $kyc->getList();

        return $data;

    }

    function getKycVerifierStatistics() {

        $kyc = $this->getModel("KYC");
        $kyc->page['limit'] = 100000;

        $kyc->select(" COUNT(verified_by) as total, verified_by ")
            ->groupBy(" verified_by ");

        $data = $kyc->getList();

        return $data;

    }

    function getKycStatistics() {

        $kyc = $this->getModel("KYC");
        $kyc->page['limit'] = 100000;

        $kyc->select(" COUNT(verification_details) as total, verification_details")
            ->groupBy(" verification_details ");

        $data = $kyc->getList();

        return $data;

    }

    function getKycDateVerified($flag = "this_year"): void {

		$date_helper = \dateHelper($flag);

		$kyc = $this->getModel("KYC");
        $kyc->page['limit'] = 100000;

		$filter[] = " verified_at >= ".$date_helper['from']." ";
		$filter[] = " verified_at <= ".$date_helper['to']." ";

		switch($flag) {
			case 'this_year':
				$kyc->select(" FROM_UNIXTIME(verified_at, '%Y-%m') as date, COUNT(kyc_id) as count ");
				break;

			case 'this_month':
				$kyc->select(" FROM_UNIXTIME(verified_at, '%Y-%m-%d') as date, COUNT(kyc_id) as count ");
				break;

			case 'this_week':
				$kyc->select(" FROM_UNIXTIME(verified_at, '%Y-%m-%d') as date, COUNT(kyc_id) as count ");
				break;

		}

		
		$kyc->where( implode(" AND ", $filter) )
					->groupBy(" date ")
						->orderBy(" verified_at ASC ");

        $data = $kyc->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$chart['series'][] = $data[$i]['count'];
				$chart['labels'][] = $data[$i]['date'];
			}

			$chart_data['labels'] = json_encode($chart['labels']);
			$chart_data['series'] = json_encode($chart['series']);

			$this->getLibrary("Charts")->getLineChart($chart_data, "getKycDateVerified_$flag", "Verification Dates");

		}

	}

}