<?php

$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@registerAccount")."' />";
$html[] = "<div class='response'></div>";
$html[] = "<div class='mb-4'>";
	$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Enter your Real Estate Broker PRC License Number</h2>";
	$html[] = "<input type='number' class='form-control' name='prc_license_id' id='prc_license_id'  placeholder='Enter Real Estate Broker PRC License Number' autocomplete='off' tabindex='1'>";
$html[] = "</div>";

$html[] = "<div class='row align-items-center mt-5' style='height:40px;'>";
	$html[] = "<div class='col-4'>";
		$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 2 of 3</span>";
		$html[] = "<div class='progress'>";
			$html[] = "<div class='progress-bar' style='width: 66.66%' role='progressbar' aria-valuenow='66.66' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
				$html[] = "<span class='visually-hidden'>66.66% Complete</span>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	$html[] = "<div class='col'>";
		$html[] = "<div class='btn-list justify-content-end'>";
			$html[] = "<span class='btn btn-primary btn-search-reference'>Continue</span>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";