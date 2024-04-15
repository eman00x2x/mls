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
		$this->doc->addScript(CDN."philippines-addresses/json/table_address.js");

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			let current_value = {};
			
			$(document).on('change','#region',function() {
				region_id = $(this).val();
				$('input[name=\"address[region]\"]').val($('#region option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < province.length; i++) {
					let obj = province[i];
					if(obj.region_id == region_id) {
						name = obj.province_name;
						html += \"<option value='\" + obj.province_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#province').html(html);

				$('#municipality').html('');
				$('#barangay').html('');

			});

			$(document).on('change','#province',function() {
				province_id = $(this).val();
				$('input[name=\"address[province]\"]').val($('#province option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < municipality.length; i++) {
					let obj = municipality[i];
					if(obj.province_id == province_id) {
						name = obj.municipality_name;
						html += \"<option value='\" + obj.municipality_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#municipality').html(html);

				$('#barangay').html('');

			});

			$(document).on('change','#municipality',function() {
				municipality_id = $(this).val();
				$('input[name=\"address[municipality]\"]').val($('#municipality option:selected').text());

				html = \"<option value=''></option>\";
				for(let i = 0; i < barangay.length; i++) {
					let obj = barangay[i];
					if(obj.municipality_id == municipality_id) {
						name = obj.barangay_name;
						html += \"<option value='\" + obj.barangay_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
					}
				}
				$('#barangay').html(html);

			});

			$(document).on('change','#barangay',function() {
				$('input[name=\"address[barangay]\"]').val($('#barangay option:selected').text());
			});

		"));

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
				$('#pin').val(rcg());
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

						html = \"<option value=''></option>\";
						for(let i = 0; i < region.length; i++) {
							let obj = region[i];
							name = obj.region_name;
							html += \"<option value='\" + obj.region_id + \"'>\" + name.replace('ñ', 'n') + \"</option>\";
						}
						$('#region').html(html);

						$('.board-details label').css('color', '#FFF');

						$('.region-selection, .province-selection').addClass('flex-grow-1');

						$('.municipality-selection').remove();
						$('.barangay-selection').remove();
						
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

			/* $response['data']['board_regions'] = BOARD_REGIONS; */
			$response['data']['local_boards'] = LOCAL_BOARDS;
			sort($response['data']['local_boards']);

			$address = $this->getModel("Address");
			$response['data']['address'] = $address->addressSelection();

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

	function successPage() {
		$this->setTemplate("registration/successPage.php");
		return $this->getTemplate();
	}

	function resendActivationLinkForm() {
		$this->setTemplate("registration/resendActivationLinkForm.php");
		return $this->getTemplate();
	}

	function sendActivationLink() {

	}
	
}