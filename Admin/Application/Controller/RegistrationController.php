<?php

namespace Admin\Application\Controller;

use Library\Mailer as Mailer;

class RegistrationController extends AccountsController {

	public $domain;
	
	function __construct() {
		parent::__construct();
	}
	
	function register() {

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Register Account - ".CONFIG['site_name']);

		$this->doc->addScript(CDN."js/encryption.js");

		$local_boards_json = json_encode(LOCAL_BOARDS);
		$membership_json = json_encode([
			"Lifetime Exempt" => ["Past National President"],
			"Lifetime Paid" => ["Past National Director", "National Director", "Past President", "Regular Member", "Associate Member"],
			"Regular" => ["Past National Director", "National Director", "Past President", "Regular Member", "Associate Member"]
		]);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			const local_boards = $local_boards_json;
			const membership = $membership_json;;

			$(document).ready(function() {
				(async () => {
					let keys = await generateKey();
					$('#publicKey').val(JSON.stringify(keys.publicKey));
					$('#privateKey').val(JSON.stringify(keys.privateKey));

					$('#api_key').val(uuidv4());
				})();
			});

			$(document).on('change', '#board_region', function() {

				let region = $('#board_region option:selected').val();

				html = '';
				for(key in local_boards[region]) {
					if (local_boards[region].hasOwnProperty(key)) {
						html += \"<option value='\" + local_boards[region][key] + \"'>\" + local_boards[region][key] + \"</option>\";
					}
				}

				$('#local_board_name').html(html);
			});

			$(document).on('change', '#membership_type', function() {

				let membership_type = $('#membership_type option:selected').val();

				html = '';
				for(key in membership[membership_type]) {
					if (membership[membership_type].hasOwnProperty(key)) {
						html += \"<option value='\" + membership[membership_type][key] + \"'>\" + membership[membership_type][key] + \"</option>\";
					}
				}

				$('#membership_position').html(html);
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
				$('.response').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>\");

				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					
					try {
						response = JSON.parse(data);
					} catch (e) {
						$('.registration_form').html(data);
						$('.response').html('');


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
				$('.response').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>\");
				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					$('.registration_form').html(data);
					$('.response').html('');
					return false;
				});
			});

			$(document).on('click', '.btn-verify-membership', function() {
				$('.response').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>\");
				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					response = JSON.parse(data);

					if(response.status == 2) {
						$('.response').html(response.message);
					}else {
						$('.registration_form').html(response.data);
					}

					return false;
				});
			});
		");

		$this->setTemplate("registration/membership_verification.php");
		return $this->getTemplate();
		
	}

	function agreeToDataPrivacy() {

		parse_str(file_get_contents('php://input'), $_POST);

		$accounts = $this->getModel("Account");
		$user = $this->getModel("User");
		$v = $this->getLibrary("Factory")->getValidator();

		$v->validateEmail($_POST['email_address'], "Invalid email address");

		$response = $this->verifyMembership($_POST['email_address']);
		if($response['status'] == 2) {
			$v->addError("Email address not found in the list of members, Please contact the administrator");
		}

		$user->column['email'] = $_POST['email_address'];
		$accounts->column['email'] = $_POST['email_address'];

		if($accounts->getByEmail() || $user->getByEmail()) {

			$v->addError("Email already registered");

			/** 
			 * REGISTRATION INTERUPTED AND USER ACCOUNT DID NOT CREATE
			*/
			if($user->getByEmail() === false) {
				/** CREATE USER ACCOUNT */
				return $this->createUserForm($accounts->column['email']);
			}

			if($accounts->column['status'] == "pending_activation") {

				$mes = "Account pending activation. Please check your email for the activation link. or <a href='".url("RegistrationController@resendActivationLinkForm")."'>Resend Activation Link</a>";
				$this->getLibrary("Factory")->setMsg($mes, "error");

				return json_encode([
					"status" => 2,
					"message" => getMsg()
				]);

			}

		}

		if(!isset($_POST['membership_type']) || $_POST['membership_type'] == "") {
			$v->addError("Select membership type");
		}

		if(!isset($_POST['membership_position']) || $_POST['membership_position'] == "") {
			$v->addError("Select membership standing");
		}
		
		if($v->foundErrors()) {

			$mes = $v->listErrors();
			$this->getLibrary("Factory")->setMsg($mes, "error");
			return json_encode([
				"status" => 2,
				"type" => "error",
                "message" => getMsg()
			]);

		}
		
		$data = $_POST;
		/* $data['email'] = $response['data']['email'];
		$data['broker_prc_license_id'] = $response['data']['broker_prc_license_id']; */
		$data['data_privacy'] = CONFIG['data_privacy'];

		$this->setTemplate("registration/dataPrivacy.php");
		return json_encode([
			"status" => 1,
			"data" => $this->getTemplate($data)
		]);

	}

	function registerBroker() {

		parse_str(file_get_contents('php://input'), $_POST);

		$this->setTemplate("registration/broker_license.php");
		return $this->getTemplate($_POST);

	}

	function registerAccount() {

		parse_str(file_get_contents('php://input'), $_POST);

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Register Account - ".CONFIG['site_name']);

		$reference = $this->getModel("LicenseReference");
		$response =	$reference->getByLicenseId($_POST['broker_prc_license_id']);

		if($response['status'] == 1) {

			if($response['data']['reference_id'] == 0) {
				$response['data']['broker_prc_license_id'] = $_POST['broker_prc_license_id'];
			}

			$response['data']['message_keys']['publicKey'] = $_POST['message_keys']['publicKey'];
			$response['data']['message_keys']['privateKey'] = $_POST['message_keys']['privateKey'];

			$response['data']['membership_type'] = $_POST['membership_type'];
			$response['data']['membership_position'] = $_POST['membership_position'];
			$response['data']['membership_status'] = $_POST['membership_status'];

			$response['data']['pin'] = $_POST['pin'];
			$response['data']['api_key'] = $_POST['api_key'];
			$response['data']['email_address'] = $_POST['email_address'];

			$response['data']['board_regions'] = array_keys(LOCAL_BOARDS);
			sort($response['data']['board_regions']);

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

	function accountActivation($code) {

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle(CONFIG['site_name'] . " Account Activation");

		$code = base64_decode($code);
		$code = json_decode($code, true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			response()->redirect(MANAGE . 'not-found');
		}

		if(!isset($code['expiration']) && $code['expiration'] >= DATE_NOW) {
			response()->redirect(MANAGE . 'not-found');
		}

		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $code['account_id'];
		$accounts->and(" email = '".$code['email']."' AND status = 'pending_activation' ");
		$data = $accounts->getById();

		if($data) {

			$accounts->save( $data['account_id'], [
				"board_region" => json_encode($data['board_region']),
				"account_name" => json_encode($data['account_name']),
				"profile" => json_encode($data['profile']),
				"status" => "active"
			]);

			$this->setTemplate("registration/activation.php");
			return $this->getTemplate($data);

		}

		response()->redirect(MANAGE . 'not-found');

	}

	function successPage() {
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Successfully Registered - ".CONFIG['site_name']);

		$this->setTemplate("registration/successPage.php");
		return $this->getTemplate();
	}

	function createUserForm($email) {

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Account Registration - ".CONFIG['site_name']);

		$accounts = $this->getModel("Account");
		$accounts->column['email'] = $email;
		$data = $accounts->getByEmail();

		$this->setTemplate("registration/createPassword.php");
		return json_encode([
			"status" => 1,
			"data" => $this->getTemplate($data)
		]);

	}

	function saveUser() {

		parse_str(file_get_contents('php://input'), $_POST);

		$user = $this->getModel("User");
		$response = $user->saveNew([
			"account_id" => $_POST['account_id'],
			"name" => $_POST['name'],
			"email" => $_POST['email'],
			"password" => $_POST['password'],
			"cpassword" => $_POST['cpassword'],
			"userlevel" => 1,
			"user_status" => "active",
			"permissions" => json_encode(USER_PERMISSIONS),
			"privileges" => json_encode(CONFIG['privileges']),
			"created_at" => DATE_NOW
		]);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		if($response['status'] == 1) {

			/** SEND EMAIL ACTIVATION LINK */
			$mail = new Mailer();
			$send = $mail
				->build( $this->mailActivationUrl($_POST) )
					->send([
						"to" => [
							$_POST['email']
						]
					], CONFIG['site_name'] . " Account activation ");

		}

		return json_encode([
			"status" => $response['status'],
			"message" => getMsg()
		]);
		
	}

	function resendActivationLinkForm() {

		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->doc->setTitle("Resend Activation Link to Email - ".CONFIG['site_name']);

		$this->doc->addScriptDeclaration("
			$(document).on('click', '.btn-resend-activation', function() {

				$('.response').html(\"<div class='d-flex gap-2 align-items-center'><div class='loader'></div> <p class='mb-0'>Sending activation link, please wait...</p></div>\");
				$('.btn-resend-activation').addClass('d-none');

				$.post($('#save_url').val(), $('#form').serialize(), function(data) {
					response = JSON.parse(data);

					if(response.status == 2) {
						$('.btn-resend-activation').removeClass('d-none');
					}

					$('.response').html(response.message);
				});
			});
		");

		$this->setTemplate("registration/resendActivationLinkForm.php");
		return $this->getTemplate();
	}

	function sendActivationLink() {

		$account = $this->getModel("Account");
		$account->column['email'] = $_POST['email'];
		$data = $account->getByEmail();

		if($data) {

			$data['name'] = $data['account_name']['firstname']." ".$data['account_name']['lastname'];

			/** SEND EMAIL ACTIVATION LINK */
			$mail = new Mailer();
			$send = $mail
				->build( $this->mailActivationUrl($data) )
					->send([
						"to" => [
							$_POST['email']
						]
					], CONFIG['site_name'] . " Account activation ");
			
			if($send['status'] == 2) {
				$this->getLibrary("Factory")->setMsg("The activation link could not be sent. Please try again later.", "error");
			}else {
				$this->getLibrary("Factory")->setMsg("Activation link has been successfully sent.", "success");
			}

			$response['status'] = $send['status'];
		}else {
			$this->getLibrary("Factory")->setMsg("Sorry, no records were found for the email address you provided", "error");
			$response['status'] = 2;
		}

		return json_encode(array(
			"type" => 1,
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function verifyMembership($email) {

		if (($handle = fopen(ROOT . "/Cdn/emails.csv", "r")) !== FALSE) {
			while (($fields = fgetcsv($handle, 1000, ",")) !== FALSE) {

				if($fields[0] == $email) {
                    return [
						"status" => 1,
						"data" => [
							"email" => $fields[0],
							"broker_prc_license_id" => $fields[1]
						]
					];
                }

			}
			fclose($handle);
		}

		return [
			"status" => 2,
			"message" => "Email address not found"
		];

	}

	function saveNew() {
		return parent::saveNew();
	}
	
}