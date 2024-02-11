<?php

namespace Manage\Application\Controller;

class TransactionsController extends \Admin\Application\Controller\TransactionsController {

	private $account_id;

	function __construct() {
		parent::__construct();
		$this->account_id = $_SESSION['account_id'];
		
		$this->validation_url = url("TransactionsController@validateCheckOut");
		$this->payment_status_url = url("TransactionsController@paymentStatus");
	}

	function index() {

		$this->setTempalteBasePath(ROOT."Manage");

		if(isset($_REQUEST['date'])) {

			switch($_REQUEST['date']) {
				case 'today':
					$q = " created_at >= '".strtotime(date("Y-m-d",DATE_NOW))."' ";
					break;

				case 'this-week':

					$day = date('w');
					$week_start = strtotime(date('Y-m-d', strtotime('-'.$day.' days')));
					$week_end = strtotime(date('Y-m-d', strtotime('+'.(6-$day).' days')));

					$q = " created_at >= '$week_start' AND  created_at <= '$week_end' ";
					break;

				case 'this-month':

					$first_day = strtotime(date('Y-m-01', DATE_NOW));
					$last_day = strtotime(date('Y-m-t', DATE_NOW));

					$q = " created_at >= '$first_day' AND  created_at <= '$last_day' ";
					break;

				case 'this-year':
					$first_day_of_year = strtotime("01/01");
					$last_day_of_year = strtotime("12/31");

					$q = " created_at >= '$first_day_of_year' AND  created_at <= '$last_day_of_year' ";
					break;

				case 'last-7-days':
					$last_7_days = strtotime("-7 days", DATE_NOW);
					$q = " created_at >= '$last_7_days' AND  created_at <= '".DATE_NOW."' ";
					break;

				case 'last-month': 
					$last_month = strtotime("-1 month", DATE_NOW);
					$first_day_last_month = strtotime(date('Y-m-01', $last_month));
					$last_day_last_month = strtotime(date('Y-m-t', $last_month));

					$q = " created_at >= '$first_day_last_month' AND  created_at <= '$last_day_last_month' ";
					break;

				case 'last-year':
					$last_year = date("Y",strtotime("-1 year", DATE_NOW));
					$first_day_of_year = strtotime($last_year.'-01-01');
					$last_day_of_year = strtotime($last_year.'-12-31');

					$q = " created_at >= '$first_day_of_year' AND  created_at <= '$last_day_of_year' ";
					break;
			}

			$filters[] = $q;
			$uri['date'] = $_REQUEST['date'];
		}

		$filters[] = " account_id = ".$this->account_id;

		$transaction = $this->getModel("Transaction");
		$transaction->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");

		$transaction->page['limit'] = 20;
		$transaction->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$transaction->page['target'] = url("TransactionsController@index");
		$transaction->page['uri'] = (isset($uri) ? $uri : []);

		
		$data = $transaction->getList();

		$this->setTemplate("transactions/transactions.php");
		return $this->getTemplate($data,$transaction);
		
	}

	function checkout($premium_id) {

		if(!isset($_SESSION['permissions']['subscriptions'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to purchase a premium for this account","error");
			response()->redirect(url("DashboardController@index"));
		}

		return parent::selectedPremium($this->account_id, $premium_id);
	}

	function validateCheckOut() {
		return parent::checkoutValidate($this->account_id);
	}

	function invoice($transaction_id) {
		return parent::invoices($this->account_id, $transaction_id);
	}

}