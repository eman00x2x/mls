<?php

namespace Api\Documentation\Application\Controller;

class APIV1Controller extends \Main\Controller {

    function __construct() {
        $this->setTempalteBasePath(ROOT."Api\Documentation");
    }

    function docs() {
        $this->setTemplate("v1/documentation.php");
        return $this->getTemplate();
    }

}