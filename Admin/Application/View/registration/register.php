<?php


$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@saveNew")."' />";

$html[] = "<input type='hidden' name='reference_id' value='".$data['reference_id']."' />";
$html[] = "<input type='hidden' name='broker_prc_license_id' value='".$data['broker_prc_license_id']."' />";

$html[] = "<div class='response'></div>";

$html[] = "<h1 class='mb-5 '>Create Account</h1>";

$html[] = "<div class=' mb-3'>";
	$html[] = "<label class='form-label'>Profession</label>";
	$html[] = "<select name='profession' class='form-select' id='profession'>";
		$professions = explode(",","Real Estate Broker,Real Estate Salesperson");
		foreach ($professions as $profession) {
			$html[] = "<option value='".$profession."'>$profession</option>";
		}
	$html[] = "</select>";
$html[] = "</div>";

$html[] = "<div class=' mb-3'>";
	$html[] = "<label class='form-label'>PRC License Number</label>";
	$html[] = "<input type='text' name='real_estate_license_number' id='real_estate_license_number' value='' class='form-control' />";
$html[] = "</div>";

$html[] = "<div class='row mb-3'>";
	$html[] = "<div class='col-6'>";
		$html[] = "<label class='form-label'> First Name</label>";
		$html[] = "<input type='text' class='form-control' name='firstname'  placeholder='Enter First Name' autocomplete='off' tabindex='1'>";
	$html[] = "</div>";

	$html[] = "<div class='col-6'>";
		$html[] = "<label class='form-label'>Last Name</label>";
		$html[] = "<input type='text' class='form-control' name='lastname'  placeholder='Enter Last Name' autocomplete='off' tabindex='1'>";
	$html[] = "</div>";

$html[] = "</div>";

$html[] = "<div class='mb-3'>";
	$html[] = "<label class='form-label'><i class='ti ti-email'></i> Email</label>";
	$html[] = "<input type='email' class='form-control' name='email'  placeholder='Enter Email' autocomplete='off' tabindex='1'>";
$html[] = "</div>";

$html[] = "<div class='mb-3'>";
	$html[] = "<label class='form-label'>Password</label>";
	$html[] = "<input type='password' class='form-control' name='password' id='password'  placeholder='Enter password' autocomplete='off' required />";
$html[] = "</div>";

$html[] = "<div class='mb-3'>";
	$html[] = "<label class='form-label'>Confirm Password</label>";
	$html[] = "<input type='password' class='form-control' name='cpassword' id='cpassword'  placeholder='Confirm password' autocomplete='off' required />";
$html[] = "</div>";

$html[] = "<div class='row align-items-center mt-5' style='height:40px;'>";
	$html[] = "<div class='col-4'>";
		$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 3 of 3</span>";
		$html[] = "<div class='progress'>";
			$html[] = "<div class='progress-bar' style='width: 100%' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
				$html[] = "<span class='visually-hidden'>100% Complete</span>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	$html[] = "<div class='col'>";
		$html[] = "<div class='btn-list justify-content-end'>";
			$html[] = "<span class='btn btn-primary btn-save'><i class='ti ti-device-floppy'></i> &nbsp; Register Account</span>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";