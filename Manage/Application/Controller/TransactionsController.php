<?php

namespace Manage\Application\Controller;

class TransactionsController extends \Admin\Application\Controller\TransactionsController {

	private $account_id;

	function __construct() {
		parent::__construct();
		$this->account_id = $this->session['account_id'];
		
		$this->validation_url = url("TransactionsController@validateCheckOut");
		$this->payment_status_url = url("TransactionsController@paymentStatus");
	}

	function index($account_id) {
		return $this->index($this->account_id);
	}

	/** alias of $this->index($account_id) */
	function transactions() {
		return parent::index($this->account_id);
	}

	function mycart($premium_id) {

		if($this->session['permissions']['premiums']['process_subscription'] == 0) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to purchase a premium for this account","error");
			response()->redirect(url("DashboardController@index"));
		}

		return parent::cart($this->account_id, $premium_id);
	}

	function checkout($premium_id) {

		if($this->session['permissions']['premiums']['process_subscription'] == 0) {
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