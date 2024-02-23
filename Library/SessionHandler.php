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

		if($this->get("logged")) {
			/* already logged */

			if(isset($_REQUEST['logout'])) {
				/** user wants to logout */
				$this->end($this->getLoggedUser());
				return;
			}

			/* check if logging in the same domain */
			if($this->get('domain') != $this->getCurrentDomain()) {
				$this->end($this->getLoggedUser());
				return;
			}

			/* verify user if the same */
			if(!$this->validateLoggedUser()) {
				/** logged user is different from record */
				$controller = new MainController();
				$controller->getLibrary("Factory")->setMsg("Someone already using this account! you will be logout.","error");
				return;
            }

		}else {
			/* not logged */
			return;
		}

		return 1;

	}

	function end($data) {

		$controller = new MainController();
		$user_login = $controller->getModel("UserLogin");
		$user_login->save($data['user_id'], [
			"status" => 0
		]);

		$this->clear();
		$this->destroy();

	}

	function validateLoggedUser() {

		$data = $this->getLoggedUser();

		if($data) {

			/* Already logged check if session_id is equal to the stored data */
			if($data['session_id'] != $this->getId()) {
				/* session_id not same */
				$this->end($data);
				return false;
			}

			/* session_id same, do nothing */

		}

		return true;

	}

	function getLoggedUser() {

		$session = $this->get("user_logged");

		$controller = new MainController();
		$user_login = $controller->getModel("UserLogin");
		$user_login->column['user_id'] = $session['user_id'];
		$user_login->and(" status = 1 ");
		return $user_login->getByUserId();

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