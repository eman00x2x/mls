<?php


$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@saveNewAccount")."' />";

$html[] = "<input type='hidden' name='reference_id' value='".$data['reference_id']."' />";
$html[] = "<input type='hidden' name='prc_license_id' value='".$data['prc_license_id']."' />";

$html[] = "<div class='response'></div>";

$html[] = "<div class='row mb-3'>";

	$html[] = "<div class='col-6'>";
		$html[] = "<label class='form-label'><i class='ti ti-user-hexagon'></i> First Name</label>";
		$html[] = "<input type='text' class='form-control' name='firstname'  placeholder='Enter First Name' autocomplete='off' tabindex='1'>";
	$html[] = "</div>";

	$html[] = "<div class='col-6'>";
		$html[] = "<label class='form-label'><i class='ti ti-user-hexagon'></i> Last Name</label>";
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

$html[] = "<div class='form-footer text-end'>";
	$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy'></i> &nbsp; Register Account</span>";
$html[] = "</div>";
