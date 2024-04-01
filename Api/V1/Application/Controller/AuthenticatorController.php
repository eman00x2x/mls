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
        $account->select(" logo, company_name, profession, real_estate_license_number, board_region, local_board_name, 
            account_name, birthdate, CONCAT(street, ' ', city, ' ', province) as address, mobile_number, email, tin, privileges,
            status, registration_date as registered_at
        ");
        $account->column['api_key'] = $api_key;
        $data = $account->getByApiKey();

        unset($data['api_key']);

        if($data) {
            $this->account = $data;
            return;
        }

        ErrorsController::getInstance()->resourceNotFound();

	}

}