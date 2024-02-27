<?php

namespace Admin\Application\Controller;

class SessionController extends \Main\Controller {

	private static $_instance;
	public $session;

	public static function getInstance () {
		if (self::$_instance === null) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	function __construct() {
		$this->session = new \Josantonius\Session\Session;
	}

	function begin($options = []) {
		if(!$this->session->isStarted()) { $this->session->start($options);  }
	}

	function monitor() {

		$logged = $this->session->get("user_logged");

		if(isset($logged['user_id'])) {
			/* already logged */
			if(isset($_REQUEST['logout'])) {
				/** user wants to logout */
				return $this->end();
			}

			/* check if logging in the same domain */
			if($this->session->get('domain') != $this->getCurrentDomain()) {
				return $this->end();
			}

			if(!$this->verifySession()) {
				/** invalid session */
				$this->end();
				\Library\Factory::setMsg("Someone has logged in using this account! This account will be logged out in all devices.","warning");

				return [
					"status" => 0
				];
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

		$data = $this->session->get("user_logged");

		$user_login = $this->getModel("UserLogin");
		$user_login->setStatus($data['user_id'], 0);
	
		$this->session->regenerateId();
		$this->session->clear();
		$this->session->destroy();

		return [
			"status" => 0
		];

	}

	function verifySession() {

		$data = $this->session->get("user_logged");

		$user_login = $this->getModel("UserLogin");
		$user_login->column['user_id'] = $data['user_id'];
		$user_login->and(" status = 1 ");

		$user = $user_login->getByUserId();

		if($user) {

			/** check current user session */
			if($user['session_id'] != $this->session->getId()) {
				/** user current session not same */
				return false;
			}

			/** everything is alright, update current session */
			$this->updateSession();
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

	function updateSession() {

		$session = $this->session->get("user_logged");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $session['account_id'];
		
		$user = $this->getModel("User");
		$user->column['user_id'] = $session['user_id'];
		
		$data = array_merge($account->getById(), $user->getById());

		$subscription = $this->getModel("AccountSubscription");
		$subscription->column['account_id'] = $session['account_id'];
		$data['privileges'] = $subscription->getSubscription();

		foreach($data as $key => $val) {
			$_SESSION['user_logged'][$key] = $val;
		}

	}

}