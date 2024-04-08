<?php

namespace Api\Documentation\Application\Controller;

class ApiV1Controller extends \Main\Controller {

    public $doc;

    function __construct() {
        $this->setTempalteBasePath(ROOT."Api\Documentation");
        $this->doc = $this->getLibrary("Factory")->getDocument();
    }

    function docs() {

        $this->doc->setTitle(CONFIG['site_name'] . " API Documentation");

        $this->setTemplate("v1/documentation.php");
        return $this->getTemplate();
    }

}