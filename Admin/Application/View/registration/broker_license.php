<?php

$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@registerAccount")."' />";

$html[] = "<input type='hidden' name='message_keys[publicKey]' id='publicKey' value='".$data['message_keys']['publicKey']."' />";
$html[] = "<input type='hidden' name='message_keys[privateKey]' id='privateKey' value='".$data['message_keys']['privateKey']."' />";

$html[] = "<input type='hidden' name='pin' id='pin' value='".$data['pin']."' />";
$html[] = "<input type='hidden' name='api_key' id='api_key' value='".$data['api_key']."' />";

$html[] = "<input type='hidden' name='email_address' id='email_address' value='".$data['email_address']."' />";

$html[] = "<div class='response'></div>";
$html[] = "<div class='mb-4'>";
	$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Enter your Real Estate Broker PRC License Number</h2>";
	$html[] = "<input type='number' class='form-control' name='broker_prc_license_id' id='broker_prc_license_id' value='".$data['broker_prc_license_id']."' placeholder='Enter Real Estate Broker PRC License Number' autocomplete='off' tabindex='1'>";
	$html[] = "<span class='form-hint'>If you are a Real Estate Broker, Enter your PRC License number instead.</span>";
$html[] = "</div>";

$html[] = "<div class='row align-items-center mt-5' style='height:40px;'>";
	$html[] = "<div class='col-4'>";
		$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 3 of 4</span>";
		$html[] = "<div class='progress'>";
			$html[] = "<div class='progress-bar' style='width: 75%' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
				$html[] = "<span class='visually-hidden'>75% Complete</span>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	$html[] = "<div class='col'>";
		$html[] = "<div class='btn-list justify-content-end'>";
			$html[] = "<span class='btn btn-primary btn-search-reference'>Continue</span>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";