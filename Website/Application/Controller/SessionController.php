<?php

namespace Website\Application\Controller;

class SessionController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		
	}

	function sessionStart() {}

	function recordSession() {}

	function sessionDestroy() {}

}