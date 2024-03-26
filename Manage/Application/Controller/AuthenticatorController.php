<?php

namespace Manage\Application\Controller;

class AuthenticatorController extends \Admin\Application\Controller\AuthenticatorController {
	
	private static $_instance = null;
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

	function __construct() {
		parent::__construct();
		$this->domain = MANAGE;
		return $this;
	}

	function getLoginForm() {

		parent::getLoginForm();
		$this->setTempalteBasePath(ROOT."Manage");
		$this->setTemplate("login/login.php");
		return $this->getTemplate();
		
	}

	function checkCredentials() {
		return parent::checkCredentials();
	}

}