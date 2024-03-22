<?php

namespace Admin\Application\Controller;

class RegistrationController extends \Admin\Application\Controller\AccountsController {
	
	public $doc;

	function __construct() {
		parent::__construct();
	}
	
	function register() {

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Register Account - MLS");

		$this->doc->addScript(CDN."js/encryption.js");

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				(async () => {
					let keys = await generateKey();
					$('#publicKey').val(JSON.stringify(keys.publicKey));
					$('#privateKey').val(JSON.stringify(keys.privateKey));

					$('#api_key').val(uuidv4());
				})();
			});
		"));
		
		$this->doc->addScriptDeclaration("

			$(document).ready(function() {
				$('#api_key').val(uuidv4());
				$('#api_key').val(rcg());
			});

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

		$data['data_privacy'] = CONFIG['data_privacy'];

		$this->setTemplate("registration/dataPrivacy.php");
		return $this->getTemplate($data);
		
	}

	function registerBroker() {

		parse_str(file_get_contents('php://input'), $_POST);

		$this->setTemplate("registration/broker_license.php");
		return $this->getTemplate($_POST);

	}

	function registerAccount() {

		parse_str(file_get_contents('php://input'), $_POST);

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Register Account - MLS");

		$reference = $this->getModel("LicenseReference");
		$response =	$reference->getByLicenseId($_POST['broker_prc_license_id']);

		if($response['status'] == 1) {

			if($response['data']['reference_id'] == 0) {
				$response['data']['broker_prc_license_id'] = $_POST['broker_prc_license_id'];
			}

			$response['data']['message_keys']['publicKey'] = $_POST['message_keys']['publicKey'];
			$response['data']['message_keys']['privateKey'] = $_POST['message_keys']['privateKey'];

			$response['data']['pin'] = $_POST['pin'];
			$response['data']['api_key'] = $_POST['api_key'];

			$response['data']['board_regions'] = BOARD_REGIONS;
			$response['data']['local_boards'] = LOCAL_BOARDS;
			sort($response['data']['local_boards']);
				
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