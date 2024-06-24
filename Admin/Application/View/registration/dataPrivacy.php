<?php

$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@registerBroker")."' />";

$html[] = "<input type='hidden' name='message_keys[publicKey]' id='publicKey' value='".$data['message_keys']['publicKey']."' />";
$html[] = "<input type='hidden' name='message_keys[privateKey]' id='privateKey' value='".$data['message_keys']['privateKey']."' />";

$html[] = "<input type='hidden' name='membership_type' id='membership_type' value='".$data['membership_type']."' />";
$html[] = "<input type='hidden' name='membership_position' id='membership_position' value='".$data['membership_position']."' />";
$html[] = "<input type='hidden' name='membership_status' id='membership_status' value='".$data['membership_status']."' />";

$html[] = "<input type='hidden' name='broker_prc_license_id' id='broker_prc_license_id' value='".$data['broker_prc_license_id']."' />";
$html[] = "<input type='hidden' name='email_address' id='email_address' value='".$data['email_address']."' />";
$html[] = "<input type='hidden' name='pin' id='pin' value='".$data['pin']."' />";
$html[] = "<input type='hidden' name='api_key' id='api_key' value='".$data['api_key']."' />";

$html[] = "<div class='response'></div>";
$html[] = "<h1>Privacy Policy</h1>";
$html[] = "<div class='overflow-auto mb-4 py-3 px-2 border-top border-bottom' style='height:380px;'>";
	$html[] = $data['data_privacy'];
$html[] = "</div>";
$html[] = "<div class='mb-4 '>";
	$html[] = "<label class='form-check cursor-pointer'>";
		$html[] = "<input type='checkbox' name='policy_agree' id='policy_agree' class='form-check-input' value='1' />";
		$html[] = "<span class='form-check-label'>I Agree to Data Privacy</span>";
	$html[] = "</label>";
$html[] = "</div>";
$html[] = "<div class='row align-items-center' style='height:40px;'>";
	$html[] = "<div class='col-4'>";
		$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 2 of 4</span>";
		$html[] = "<div class='progress'>";
			$html[] = "<div class='progress-bar' style='width: 50%' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
				$html[] = "<span class='visually-hidden'>50% Complete</span>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	$html[] = "<div class='col'>";
		$html[] = "<div class='btn-list justify-content-end'>";
			$html[] = "<span class='btn btn-primary btn-continue d-none'>Continue</span>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";