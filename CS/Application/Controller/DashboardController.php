<?php

namespace CS\Application\Controller;

class DashboardController extends \Admin\Application\Controller\DashboardController {

    function __construct() {
        parent::__construct();
		$this->setTempalteBasePath(ROOT."/Cs");
	}

    function index() {

        $this->getKycDateVerified();

        $data['kyc'] = $this->getKycStatus();
        $data['kyc_verifier'] = $this->getKycVerifierStatistics();
        $data['kyc_statistics'] = $this->getKycStatistics();

		$this->setTemplate("dashboard/index.php");
		return $this->getTemplate($data);

	}

}