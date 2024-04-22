<?php

namespace Library;

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
			"end" => strtotime($this->lifetime, $timestamp)/* ,
			"user_agent" => json_decode(UserClient::getInstance()->information(), true) */
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

	function getUserClient() {

		$doc = \Library\Factory::getDocument();
		$doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			const userClient = {
				\"userAgent\": null,
				\"geo\": null,
				\"browser\": null
			};
			
			$(document).ready(function() {

				const obj = JSON.parse(localStorage.getItem('client'));

				if(localStorage.getItem('client') === null) {
					getGeo();
					userClient.userAgent = navigator.userAgent;
					getBrowser();
				}

				userClient.userAgent = obj.userAgent;
				userClient.geo = obj.geo;
				userClient.browser = obj.browser;
			});

			async function getGeo() {
				$.get('https://ipinfo.io/json', function(data) {
					userClient.geo = data;
					localStorage.setItem('client', JSON.stringify(userClient));
				});
			}

			function getBrowser() {

				const isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
				const isFirefox = typeof InstallTrigger !== 'undefined';
				const isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === '[object SafariRemoteNotification]'; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));
				const isIE = /*@cc_on!@*/false || !!document.documentMode;
				const isEdge = !isIE && !!window.StyleMedia;
				const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
				const isEdgeChromium = isChrome && (navigator.userAgent.indexOf('Edg') != -1);
				const isBlink = (isChrome || isOpera) && !!window.CSS;

				if(isOpera) { userClient.browser = 'Opera'; }
				else if(isFirefox) { userClient.browser = 'Firefox'; }
				else if(isSafari) { userClient.browser = 'Safari'; }
				else if(isIE) { userClient.browser = 'IE'; }
				else if(isEdge) { userClient.browser = 'Edge'; }
				else if(isChrome) { userClient.browser = 'Chrome'; }
				else if(isEdgeChromium) { userClient.browser = 'Edge'; }
				else if(isBlink) { userClient.browser = 'Blink'; }
				else { userClient.browser = 'Unknown Browser'; }

				localStorage.setItem('client', JSON.stringify(userClient));

			}

		"));

	}

}