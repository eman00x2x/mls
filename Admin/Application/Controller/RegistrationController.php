<?php

namespace Admin\Application\Controller;

class RegistrationController extends \Main\Controller {
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->domain = ADMIN;
		return $this;
	}
	
	function register() {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Register Account - MLS");

		$doc->addScriptDeclaration("
			$(document).on('focusout', '#prc_license_id', function() {
				var license = $(this).val();
				newValue = license.replace(/^0+/, '');
				$(this).val(newValue);
			});

			$(document).on('click', '.btn-search-reference', function() {
				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					
					try {
						response = JSON.parse(data);
					} catch (e) {
						$('.registration_form').html(data);
						$('.response').html('');
						return false;
					}
					
					if(response.type == 2) {
						$('.response').html(response.message);
					}

				});
			});
		");

		$this->setTemplate("registration/broker_license.php");
		return $this->getTemplate();

	}

	function registerAccount() {

		parse_str(file_get_contents('php://input'), $_POST);

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Register Account - MLS");

		$reference = $this->getModel("LicenseReference");
		$response =	$reference->getByLicenseId($_POST['prc_license_id']);

		if($response['status'] == 1) {
			$data = $response['data'];
			
			$this->setTemplate("registration/register.php");
			return $this->getTemplate($data);

		}else {
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(array(
				"type" => 2,
				"status" => $response['status'],
				"message" => getMsg()
			));
		}

	}
	
	function saveNewAccount() {

		parse_str(file_get_contents('php://input'), $_POST);

		debug($_POST);

		$_POST['name'] = $_POST['firstname']." ".$_POST['lastname'];
		$_POST['date_added'] = DATE_NOW;
		$_POST['registration_date'] = DATE_NOW;
		$_POST['privileges'] = json_encode(ACCOUNT_PRIVILEGES);
		$_POST['permissions'] = json_encode(USER_PERMISSIONS);
		$_POST['account_type'] = "Real Estate Practitioner";
		$_POST['status'] = "active";

		$user = $this->getModel("User");
		$response = $user->saveNew($_POST);

		if($response['status'] == 1) {

			$accounts = $this->getModel("Account");
			$accountResponse = $accounts->saveNew($_POST);

			if($accountResponse['status'] == 1) {
				$data['account_id'] = $accountResponse['id'];
				$user->save($response['id'],$data);
			}else {
				$user->deleteUser($respons['user_id']);
			}

			$this->getLibrary("Factory")->setMsg($accountResponse['message'],$accountResponse['type']);

			return json_encode(array(
				"type" => 1,
				"status" => $response['status'],
				"message" => getMsg()
			));

		}

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"type" => 2,
			"status" => $response['status'],
			"message" => getMsg()
		));

	}
	
}