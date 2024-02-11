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
		return parent::index();
	}

	function checkout($premium_id) {
		return parent::selectedPremium($this->account_id, $premium_id);
	}

	function validateCheckOut() {
		return parent::checkoutValidate($this->account_id);
	}

}