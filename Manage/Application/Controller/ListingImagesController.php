<?php

namespace Manage\Application\Controller;

class ListingsImagesController extends \Admin\Application\Controller\ListingsImagesController {
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Manage");
	}

}