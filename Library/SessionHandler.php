<?php

namespace Library;

use Josantonius\Session\Session;
use Main\Controller as MainController;

class SessionHandler extends Session {

	private static $_instance;

	public static function getInstance () {
		if (self::$_instance === null) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	function __construct() {}

	function begin($options = []) {
		if(!$this->isStarted()) { $this->start($options);  }
	}

	function check() {

		if($this->get("logged")) {
			$session = $this->get("user_logged");

			$controller = new MainController();
			$user_login = $controller->getModel("UserLogin");
			$user_login->column['user_id'] = $session['user_id'];
			$user_login->and(" session_id = ".$this->getId());
			$data = $user_login->getByUserId();

			if($data) {
                
            }

			debug($user_login);
		}
		
	}

	function getSession() {

	}

}