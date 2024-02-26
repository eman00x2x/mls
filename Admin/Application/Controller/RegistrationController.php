<?php

namespace Admin\Application\Controller;

class RegistrationController extends \Admin\Application\Controller\AccountsController {
	
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

			$(document).on('change', '#policy_agree', function() {
				if($(this).prop('checked')) {
					$('.btn-continue').removeClass('d-none');
				}else {
					$('.btn-continue').addClass('d-none');
				}
			});

			$(document).on('click', '.btn-continue', function() {
				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					$('.registration_form').html(data);
					$('.response').html('');
					return false;
				});
			});
		");

		if(!isset($_POST['policy_agree'])) {
			$data['data_privacy'] = CONFIG['data_privacy'];

			$this->setTemplate("registration/dataPrivacy.php");
			return $this->getTemplate($data);
		}else {
			$this->setTemplate("registration/broker_license.php");
			return $this->getTemplate();
		}

	}

	function registerAccount() {

		parse_str(file_get_contents('php://input'), $_POST);

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Register Account - MLS");

		$reference = $this->getModel("LicenseReference");
		$response =	$reference->getByLicenseId($_POST['broker_prc_license_id']);

		if($response['status'] == 1) {

			if($response['data']['reference_id'] == 0) {
				$response['data']['broker_prc_license_id'] = $_POST['broker_prc_license_id'];
			}
				
			$this->setTemplate("registration/register.php");
			return $this->getTemplate($response['data']);

		}else {
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(array(
				"type" => 2,
				"status" => $response['status'],
				"message" => getMsg()
			));
		}

	}
	
}