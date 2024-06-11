<?php

namespace Admin\Application\Controller;

class PoliciesController extends \Main\Controller
{

    function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
        $this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function index($name) {

        $policies = [
            "community-guidelines" => "community_guidelines",
            "mls-policy" => "mls_policy",
            "refund-policy" => "refund_policy",
            "data-privacy" => "data_privacy",
            "terms" => "terms"
        ];

        if(in_array($name, [
            "community-guidelines", 
            "mls-policy", 
            "refund-policy",
            "data-privacy",
            "terms"
        ])) {

            $this->doc->setTitle(ucwords(str_replace("-", " ", $name)));

            $data = CONFIG[$policies[$name]];

            $this->setTemplate("policy/policy.php");
            return $this->getTemplate($data);

        }

        $this->response(404);

    }

}