<?php

namespace Admin\Application\Controller;

class PolicyController extends \Main\Controller
{

    function index($name) {

        if(in_array($name, ["community_guidelines", "mls_policy", "refund_policy"])) {

            $data = CONFIG[$name];
            $this->setTemplate("policy/policy.php");
            return $this->getTemplate($data);
            
        }

    }

}