<?php

namespace Main;

use Pecee\Http\Request as Request;

class Controller {

	private $template;
	private $basePath;

	function __construct() {}

	function response($error) {
		switch($error) {
			case 404: return redirect("/not-found",404);
			case 403: return redirect("/forbidden",403);
			case 500: return redirect("/Error",500);
		}
	}

	function getModel($model) {
		$class = "\\Main\Model\\".$model."Model";
		return new $class;
	}

	function getLibrary($library,$data=null) {
		$class = "\\Library\\".$library;
		return new $class($data);
	}

	function getVendor($vendor,$data=null) {
		$class = "\\Library\\".$vendor;
		return new $class($data);
	}

	function setHttpHeaders($statusCode,$description=null) {
		$this->getLibrary("Factory")->getHeaderStatus($statusCode,$description);
	}

	function setTempalteBasePath($path) {
		$this->basePath = $path;
	}

	function setTemplate($path) {
		$this->template = $path;
	}

	function getTemplate($data = null,$model = null, $real_path = null) {
		View::setBasePath($this->basePath);
		return View::getTemplate($this->template,$data,$model,$real_path);
	}

}
