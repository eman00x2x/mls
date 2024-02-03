<?php

namespace Manage\Application\Controller;

class LoginController extends \Admin\Application\Controller\LoginController {
	
	private static $_instance = null;
	var $domain;
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->domain = MANAGE;
		return $this;
	}

}