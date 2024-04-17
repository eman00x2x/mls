<?php

namespace Library;

use Library\UserClient;
use Library\Document;

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

	function setUserAgent() {

		$doc = new Document();
		$doc->addScriptDeclaration("

			$(document).ready(function() {

				let userAgent = navigator.userAgent;
				let browser = userAgent.indexOf('Chrome') > -1? 
					'Chrome' : (userAgent.indexOf('Safari') > -1? 
						'Safari' : (userAgent.indexOf('Firefox') > -1? 
							'Firefox' : (userAgent.indexOf('MSIE') > -1? 
								'MSIE' : (userAgent.indexOf('Trident') > -1? 
									'Trident' : (userAgent.indexOf('Edge') > -1? 'Edge' : '')
									)
								)
							)
						);

				console.log(userAgent);
				console.log(browser);
				

			});

		");

	}

}