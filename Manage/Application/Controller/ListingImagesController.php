<?php

namespace Manage\Application\Controller;

class ListingImagesController extends \Admin\Application\Controller\ListingImagesController {
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Manage");
	}

}