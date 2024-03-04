<?php

namespace Library;

use Josantonius\Session\Session;
use \UserClient;

class SessionHandler 
{

	private static $_instance = null;
	private $session;
	private $lifetime = "+8 hours";
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

	function __construct() {
		$this->session = new Session();
	}

	public function setConfig(Array $config) {
		
		foreach($config as $attribute => $value) {
			if(isset($this->$attribute)) {
				$this->$attribute = $value;
			}else {
				throw new Exception($attribute." is invalid.");
				break;
			}
		}

		return $this;

	}

	public function start() {

		if(!$this->session->isStarted()) {

			$this->session->start();

			$this->session->set("session_id", $this->session->getId());
			$this->session->set("started", time());
			$this->session->set("lifetime", strtotime('+8 hours', time()));

			$user_agent = json_decode(UserClient::getInstace()->information(), true);
			$this->session->set("user_agent", $user_agent);

		}

		return $this;

	}

	public function monitor() {

		if(time() >= $this->session->get("lifetime")) {
			$this->endSession();
			return false;
		}

	}

	private function endSession() {
		
		$this->session->regenerateId();
		$this->session->clear();
		$this->session->destroy();

	}

}