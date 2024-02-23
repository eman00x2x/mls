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

	function check() {

		if(isset($_REQUEST['logout'])) {
			/** user wants to logout */
			return $this->end($this->getLoggedUser());
		}

		if($this->get("logged")) {
			/* already logged */

			/* check if logging in the same domain */
			if($this->get('domain') != $this->getCurrentDomain()) {
				return $this->end($this->getLoggedUser());
			}

			/* verify user if the same */
			if(!$this->validateLoggedUser()) {
				/** logged user is different from record */
				
				return [
					"status" => 0
				];
            }

			return $this->getLoggedUser();
			
		}else {
			/* not logged */
			return [
				"status" => 0
			];
		}

	}

	function end($data) {

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

	function validateLoggedUser() {

		$data = $this->getLoggedUser();

		if(isset($data['user_id'])) {

			/* Already logged check if session_id is equal to the stored data */
			if($data['session_id'] != $this->getId()) {
				/* session_id not same */
				$this->end($data);

				$controller = new MainController();
				$controller->getLibrary("Factory")->setMsg("Someone already using this account! you will be logout.","error");

				return false;
			}

			/* session_id same, do nothing */

		}

		return true;

	}

	function getLoggedUser() {

		$session = $this->get("user_logged");

		if(isset($session['user_id'])) {
			$controller = new MainController();
			$user_login = $controller->getModel("UserLogin");
			$user_login->column['user_id'] = $session['user_id'];
			$user_login->and(" status = 1 ");
			
			$user = $user_login->getByUserId();

			if($user) {
				return $user;
			}
		}

		/** user status not logged destroy session */
		return $this->end($session);

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