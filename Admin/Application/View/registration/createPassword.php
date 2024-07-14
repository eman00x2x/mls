<?php

$html[] = "<input type='hidden' id='reference_url' value='".url("RegistrationController@successPage")."' />";
$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@saveUser")."' />";

$html[] = "<input type='hidden' name='account_id' id='account_id' value='".$data['account_id']."' />";
$html[] = "<input type='hidden' name='name' id='name' value='".$data['account_name']['firstname']." ".$data['account_name']['lastname']."' />";

$html[] = "<div class='response mb-4'></div>";

$html[] = "<h1 class='mb-5 '>Create Password</h1>";

$html[] = "<div class='mb-3'>";
	$html[] = "<label class='form-label'><i class='ti ti-email'></i> Email</label>";
	$html[] = "<input type='email' class='form-control-plaintext' name='email' id='email' value='".$data['email']."'  placeholder='Enter Email' autocomplete='off' readonly='readonly'>";
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
		$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 4 of 4</span>";
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