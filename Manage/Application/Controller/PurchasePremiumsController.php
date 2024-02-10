<?php

namespace Manage\Application\Controller;

class PurchasePremiumsController extends \Admin\Application\Controller\PurchasePremiumsController {

	private $account_id;

	function __construct() {
		parent::__construct();
		$this->account_id = $_SESSION['account_id'];
	}

	function index() {
		return parent::index();
	}

	function checkout($premium_id) {
		return parent::selectedPremium($this->account_id, $premium_id);
	}

}