<?php

namespace Manage\Application\Controller;

class TestimonialsController extends \Admin\Application\Controller\TestimonialsController {

	private $account_id;

	function __construct() {
		parent::__construct();
		$this->account_id = $this->session['account_id'];
	}

	function index($account_id = null) {
		return parent::index($this->account_id);
	}

	function add($account_id = null) {
		return parent::add($this->account_id);
	}

	function edit($id, $account_id = null) {
		return parent::edit($id, $this->account_id);
	}

	function delete($id, $account_id = null) {
		return parent::delete($id, $this->account_id);
	}

}