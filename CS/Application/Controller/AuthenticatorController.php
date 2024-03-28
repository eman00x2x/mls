<?php

namespace CS\Application\Controller;

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
		$this->domain = CS;
		return $this;
	}

}