<?php

namespace Library;

use Main\Controller as MainController;

class SessionHandler extends \Josantonius\Session\Session {

	private static $_instance;

	public static function getInstance () {
		if (self::$_instance === null) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	function __construct() {
		
	}

	function begin($options = []) {
		if(!$this->isStarted()) { $this->start($options);  }
	}

	function monitor() {

		$logged = $this->get("user_logged");

		if(isset($logged['user_id'])) {
			/* already logged */
			if(isset($_REQUEST['logout'])) {
				/** user wants to logout */
				return $this->end();
			}

			/* check if logging in the same domain */
			if($this->get('domain') != $this->getCurrentDomain()) {
				return $this->end();
			}

			if(!$this->verifySession()) {
				/** invalid session */
				\Library\Factory::setMsg("Someone has logged in using this account! This account will be logged out in all devices.","warning");
				echo getMsg();
				return $this->end();
			}

			return [
				"status" => 1
			];

		}

		/* not logged */
		return [
			"status" => 0
		];
		
	}

	function end() {

		$data = $this->get("user_logged");

		$controller = new MainController();
		$user_login = $controller->getModel("UserLogin");
		$user_login->setStatus($data['user_id'], 0);
	
		$this->regenerateId();
		$this->clear();
		$this->destroy();

		return [
			"status" => 0
		];

	}

	function verifySession() {

		$data = $this->get("user_logged");

		$controller = new MainController();
		$user_login = $controller->getModel("UserLogin");
		$user_login->column['user_id'] = $data['user_id'];
		$user_login->and(" status = 1 ");

		$user = $user_login->getByUserId();

		if($user) {

			/** check current user session */
			if($user['session_id'] != $this->getId()) {
				/** user current session not same */
				return false;
			}

			/** everything is alright, do nothing */
			return true;

		}else {
			return false;
		}

	}

	function getCurrentDomain() {

		$domain = $_SERVER['SERVER_NAME'];
		// remove trailing slashes
		$input = trim($domain, '/');

		// If not have http:// or https:// then prepend it
		if (!preg_match('#^http(s)?://#', $domain)) {
			$domain = 'http://' . $domain . '/';
		}

		return $domain;
		
	}

}