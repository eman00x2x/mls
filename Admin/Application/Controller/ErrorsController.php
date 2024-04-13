<?php

namespace Admin\Application\Controller;

class ErrorsController extends \Main\Controller {

    function __construct() {
        $this->setTempalteBasePath(ROOT."/Admin");
    }

    function notFound() {
        $this->getLibrary("HttpHeaders")->setHeaderStatus(404);
        $this->setTemplate("errors/notFound.php");
		return $this->getTemplate();
    }

    function forbidden() {
        $this->getLibrary("HttpHeaders")->setHeaderStatus(403);
        $this->setTemplate("errors/forbidden.php");
		return $this->getTemplate();
    }

    function serverError() {
        $this->getLibrary("HttpHeaders")->setHeaderStatus(500);
        $this->setTemplate("errors/serverError.php");
		return $this->getTemplate();
    }

}