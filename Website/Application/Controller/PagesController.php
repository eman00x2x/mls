<?php

namespace Website\Application\Controller;

class PagesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {
		$this->setTemplate("pages/index.php");
		return $this->getTemplate();
	}

	function about() {
		$this->setTemplate("pages/about.php");
		return $this->getTemplate();
	}

	function contact() {
		$this->setTemplate("pages/contact.php");
		return $this->getTemplate();
	}

	function articles() {
		$this->setTemplate("pages/articles.php");
		return $this->getTemplate();
	}

	function privacy() {
		$this->setTemplate("pages/privacy.php");
		return $this->getTemplate();
	}

	function terms() {
		$this->setTemplate("pages/terms.php");
		return $this->getTemplate();
	}
	
}