<?php

namespace Manage\Application\Controller;

class KYCController extends \Admin\Application\Controller\KYCController {

	private $account_id;

	function __construct() {
		parent::__construct();
		$this->account_id = $this->session['account_id'];
	}

	function kycVerificationForm($account_id = null) {
		return parent::kycVerificationForm($this->account_id);
	}

	function kycDocsUpload($id) {
		return parent::kycDocsUpload($this->account_id);
	}

}