<?php

namespace Manage\Application\Controller;

class HandshakesController extends \Admin\Application\Controller\HandshakesController {

	function __construct() {
		parent::__construct();

		$this->account_id = $this->session['account_id'];

    }

	function edit($id, $account_id = null) {
		return parent::edit($id, $this->account_id);
	}

}