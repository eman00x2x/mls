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
		
		$this->getChartEarningsThisYear();

		$data['total_accounts'] = $this->getTotalAccounts();
		$data['total_earnings'] = $this->getEarningsThisWeek();

		$this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);
	}

	function getTotalAccounts() {

		$accounts = $this->getModel("Account");
		$accounts->select(" COUNT(account_id) as total ");
		$accounts->page['limit'] = 100000;
		$data = $accounts->getList();

		return $data[0]['total'];

	}

	 function getEarningsThisWeek() {

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

	function getChartEarningsThisYear() {

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