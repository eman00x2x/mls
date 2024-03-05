<?php

namespace Admin\Application\Controller;

use Library\Chart;

class DashboardController extends \Main\Controller {

	public $doc;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {
		
		$this->getTrafficChart();
		$this->getChartEarningsThisYear();

		$data['most_traffic'] = $this->getMostTraffic();
		$data['total_accounts'] = $this->getTotalAccounts();
		$data['total_earnings'] = $this->getEarningsThisWeek();

		$this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);

	}

	function getTotalAccounts(): int {

		$accounts = $this->getModel("Account");
		$accounts->select(" COUNT(account_id) as total ");
		$accounts->page['limit'] = 100000;
		$data = $accounts->getList();

		return $data[0]['total'];

	}

	function getEarningsThisWeek(): int {

		$transactions = $this->getModel("Transaction");
		$transactions->select(" SUM(premium_price) as total ");
		$transactions->where(" YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) ");
		$transactions->page['limit'] = 100000;
		$data = $transactions->getList();

		if($data[0]['total'] > 0) {
			return $data[0]['total'];
		}else {
			return 0;
		}

	}

	function getMostTraffic($account_id = null): Array {

		$traffic = $this->getModel("ListingView");
        $traffic->page['limit'] = 100000;

		$traffic->select(" t.listing_id, title, CONCAT(a.firstname, ' ', a.lastname) as posted_by, COUNT(session_id) as count ");
		$traffic->join(" t JOIN #__listings l ON t.listing_id=l.listing_id JOIN #__accounts a ON a.account_id=t.account_id ");

		if($account_id != null) {
			$traffic->where(" t.account_id = $account_id ");
		}

		$traffic->groupBy(" t.listing_id ");
        $data = $traffic->getList();
debug($data);
		return $data;

	}

	function getTrafficChart($account_id = null): void {

		$traffic = $this->getModel("ListingView");
        $traffic->page['limit'] = 100000;

		$traffic->select(" FROM_UNIXTIME(created_at, '%Y-%m-%d') as date, COUNT(session_id) as count ");

		if($account_id != null) {
			$traffic->where(" account_id = $account_id ");
		}

		$traffic->groupBy(" date ");

        $data = $traffic->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$chart['series'][] = $data[$i]['count'];
				$chart['labels'][] = $data[$i]['date'];
			}

			$chart_data['labels'] = json_encode($chart['labels']);
			$chart_data['series'] = json_encode($chart['series']);

		}

		$this->getLibrary("Charts")->getLineChart($chart_data, "getTrafficChart", "Traffic");

	}

	function getChartEarningsThisYear(): void {

		$from_date = strtotime(date("Y-01-01", DATE_NOW));
		$to_date = strtotime(date("Y-12-t", DATE_NOW));

		$transactions = $this->getModel("Transaction");
		$transactions->select(" SUM(premium_price) as total, FROM_UNIXTIME(created_at, '%Y-%m-%d') as date ");
		$transactions->where(" created_at >= $from_date AND created_at <= $to_date ");
		$transactions->groupBy(" date ");
		$transactions->page['limit'] = 100000;
		$data = $transactions->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$chart['labels'][] = $data[$i]['date'];
				$chart['series'][] = $data[$i]['total'];
			}
		}

		$chart_data['labels'] = json_encode($chart['labels']);
		$chart_data['series'] = json_encode($chart['series']);

		$this->getLibrary("Charts")->getLineChart($chart_data, "getChartEarningsThisYear", "Earnings");

	}

	

}