<?php

namespace Manage\Application\Controller;

class PurchasePremiumsController extends \Admin\Application\Controller\PurchasePremiumsController {

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}

	function index() {
		return parent::index();
	}

	function selectedPremium($premium_id) {
		return parent::selectedPremium($premium_id);
	}

}