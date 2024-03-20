<?php


$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@saveNew")."' />";

$html[] = "<input type='hidden' name='reference_id' value='".$data['reference_id']."' />";
$html[] = "<input type='hidden' name='broker_prc_license_id' value='".$data['broker_prc_license_id']."' />";

$html[] = "<div class='response'></div>";

$html[] = "<h1 class='mb-5 '>Create Account</h1>";

$html[] = "<div class='row mb-3'>";
	$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Board Region</label>";
	$html[] = "<div class='col-sm-9'>";
		$html[] = "<select name='board_region' class='form-select' id='board_region'>";
			foreach ($data['board_regions'] as $region) {
				$sel = $data['board_region'] == $region ? "selected" : "";
				$html[] = "<option value='".$region."' $sel>$region</option>";
			}
		$html[] = "</select>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row mb-3'>";
	$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Local Board Name</label>";
	$html[] = "<div class='col-sm-9'>";
		$html[] = "<select name='local_board_name' class='form-select' id='local_board_name'>";
			foreach ($data['local_boards'] as $name) {
				$sel = $data['local_board_name'] == $name ? "selected" : "";
				$html[] = "<option value='".$name."' $sel>$name</option>";
			}
		$html[] = "</select>";
	$html[] = "</div>";
$html[] = "</div>";

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

$html[] = "<div class='row mb-4'>";
	$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Name</label>";
	$html[] = "<div class='col-sm-9'>";
		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='form-floating mb-3 '>";
				$html[] = "<input type='text' name='prefix' id='prefix' value='".$data['account_name']['prefix']."' class='form-control'  />";
				$html[] = "<label for='prefix'>Prefix</label>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='form-floating mb-3'>";
				$html[] = "<input type='text' name='firstname' id='firstname' value='".$data['account_name']['firstname']."' class='form-control'  />";
				$html[] = "<label for='firstname'>First Name</label>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='form-floating mb-3'>";
				$html[] = "<input type='text' name='middlename' id='middlename' value='".$data['account_name']['middlename']."' class='form-control'  />";
				$html[] = "<label for='middlename'>Middle Name</label>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='form-floating mb-3'>";
				$html[] = "<input type='text' name='lastname' id='lastname' value='".$data['account_name']['lastname']."' class='form-control'  />";
				$html[] = "<label for='lastname'>Last Name</label>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='form-floating mb-3'>";
				$html[] = "<input type='text' name='suffix' id='suffix' value='".$data['account_name']['suffix']."' class='form-control'  />";
				$html[] = "<label for='mb-3'>Suffix</label>";
			$html[] = "</div>";
		$html[] = "</div>";
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