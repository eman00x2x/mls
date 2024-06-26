<?php

namespace Manage\Application\Controller;

class LeadGroupsController extends \Admin\Application\Controller\LeadGroupsController {

	function __construct() {

		$this->setTempalteBasePath(ROOT."/Admin");
		
		parent::__construct();
		$this->account_id = $this->session['account_id'];
	}

}