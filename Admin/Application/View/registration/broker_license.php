<?php

$html[] = "<div class='container-fluid'>";
	$html[] = "<div class='row'>";
		$html[] = "<div class='col-md-4 col-12  mx-auto'>";
			$html[] = "<div class='text-center mb-5'>&nbsp;</div>";
			$html[] = "<form id='form' class='card border-0' action='' method='POST'>";

				$html[] = "<div class='card-body p-4 '>";
			
					$html[] = "<div class='text-wrap'>";
						$html[] = "<p class='text-center mt-4 mb-5'><span class='fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span><br/><b>MLS Account Registration</b></p>";
					$html[] = "</div>";

					$html[] = "<div class='registration_form'>";

						$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@registerAccount")."' />";
						$html[] = "<div class='response'></div>";

						$html[] = "<div class='mb-3'>";
							$html[] = "<label class='form-label'><i class='ti ti-email'></i> Enter your Real Estate Broker PRC License Number</label>";
							$html[] = "<input type='number' class='form-control' name='prc_license_id' id='prc_license_id'  placeholder='Enter Real Estate Broker PRC License Number' autocomplete='off' tabindex='1'>";
						$html[] = "</div>";

						$html[] = "<div class='form-footer text-end'>";
							$html[] = "<span class='btn btn-outline-primary btn-search-reference'><i class='ti ti-device-floppy'></i> &nbsp; Submit</span>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</form>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";