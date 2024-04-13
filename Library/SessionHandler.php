<?php

namespace Library;

use Library\UserClient;

class SessionHandler extends \Josantonius\Session\Session
{

	private static $_instance = null;
	private $lifetime = "+30 minutes";
	private $container = "session";
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

	function __construct() {}

	public function init() {

		if(!$this->isStarted()) {
			$this->start();
		}

		if(!$this->has("id")) {
			$this->buildAttributes();
		}

		if(time() >= $this->get("end")) {
			$this->renew();
		}

	}

	public function buildAttributes() {

		$timestamp = time();

		$this->replace([
			"id" => $this->getId(),
			"started" => $timestamp,
			"end" => strtotime($this->lifetime, $timestamp),
			"user_agent" => json_decode(UserClient::getInstance()->information(), true)
		]);
		
	}

	public function renew() {
		$this->regenerateId();
		$this->buildAttributes();
	}

	public function getAttributes(): mixed {
		return $this->all();
	}

	public function endSession(): void {
		$this->regenerateId();
		$this->clear();
		$this->destroy();
	}

}