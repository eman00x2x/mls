<?php

$html[] = "<div class='d-flex flex-column'>";
$html[] = "<div class='page page-center'>";
	$html[] = "<div class='container container-tight py-4'>";
		$html[] = "<div class='text-center mb-4'>";
			$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span></a>";
			$html[] = "<span class='d-block'><b>MLS Account Registration</b></span>";
		$html[] = "</div>";

			$html[] = "<form id='form' action='' method='POST'>";
				$html[] = "<div class='card card-md'>";
					$html[] = "<div class='card-body py-4 p-sm-5'>";

						$html[] = "<div class='registration_form'>";

							$html[] = "<input type='hidden' name='message_keys[publicKey]' id='publicKey' value='' />";
							$html[] = "<input type='hidden' name='message_keys[privateKey]' id='privateKey' value='' />";

							$html[] = "<input type='hidden' name='pin' id='pin' value='' />";
							$html[] = "<input type='hidden' name='api_key' id='api_key' value='' />";

							$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@registerBroker")."' />";

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
									$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 1 of 3</span>";
									$html[] = "<div class='progress'>";
										$html[] = "<div class='progress-bar' style='width: 33.33%' role='progressbar' aria-valuenow='33.33' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
											$html[] = "<span class='visually-hidden'>33.33% Complete</span>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col'>";
									$html[] = "<div class='btn-list justify-content-end'>";
										$html[] = "<span class='btn btn-primary btn-continue d-none'>Continue</span>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</form>";

			$html[] = "<div class='text-center text-secondary mt-3'>";
			$html[] = "Already have account? <a href='".url(MANAGE_ALIAS . "/")."' tabindex='-1'>Sign in</a>";
			$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";