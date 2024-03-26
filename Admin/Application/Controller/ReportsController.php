<?php

namespace Admin\Application\Controller;

class ReportsController extends \Main\Controller {

    function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function getList() {}

} 
