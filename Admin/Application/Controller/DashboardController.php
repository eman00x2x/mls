<?php

namespace Admin\Application\Controller;

class DashboardController extends \Main\Controller {

    private $doc;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function index() {

        ob_start();
        echo "<pre>";
        print_r($_SESSION);
        $data = ob_get_contents();
        ob_end_clean();

        $this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);
    }

}