<?php

namespace Api\V1\Application\Controller; 

use Api\V1\Application\Controller\ErrorsController;

class AuthenticatorController extends \Admin\Application\Controller\AuthenticatorController {

    public $account;

    function __construct() {

        if(!isset($_SERVER['HTTP_X_API_KEY'])) {
			if(!isset($_GET['api_key'])) {
				ErrorsController::getInstance()->resourceNotFound();
			}else {
				$api_key = $_GET['api_key'];
			}
		}else {
			$api_key = $_SERVER['HTTP_X_API_KEY'];
		}

        $account = $this->getModel("Account");
        $account->select(" logo, company_name, profession, real_estate_license_number, board_region as board_location, local_board_name, 
            account_name as name, birthdate, CONCAT(street, ' ', city, ' ', province) as address, mobile_number, email, tin, privileges,
            status, registered_at
        ");
        $account->column['api_key'] = $api_key;
        $data = $account->getByApiKey();
        
        unset($data['api_key']);

        if($data) {

            $subscription = $this->getModel("AccountSubscription");
            $subscription->column['account_id'] = $data['account_id'];
            $privileges = $subscription->getSubscription();

            if($privileges) {
                foreach($privileges as $key => $value) {
                    if(isset($data['privileges'][$key])) {
                        $data['privileges'][$key] += $value;
                    }else {
                        $data['privileges'][$key] = $value;
                    }
                }
            }

            if(isset($data['privileges']['api_access']) && $data['privileges']['api_access'] >= 1) {
                $this->account = $data;
                return;
            }else {
                echo json_encode([
                    "message" => "You do not have enough privileges to access the API. Please refer to the documentation",
                    "url" => API. "documentation"
                ]);
                exit();
            }

        }

        ErrorsController::getInstance()->resourceNotFound();

	}

}