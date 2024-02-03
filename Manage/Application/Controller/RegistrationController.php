<?php

namespace Manage\Application\Controller;

class RegistrationController extends \Admin\Application\Controller\RegistrationController {
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->domain = MANAGE;
		return $this;
	}

}