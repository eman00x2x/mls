<?php

$html[] = "<div class='d-flex flex-column'>";
$html[] = "<div class='page page-center'>";
	$html[] = "<div class='container container-tight py-4'>";

		$html[] = "<div class='text-center mb-4 mt-5'>";
			$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><img src='".CDN."images/logo.png' style='width:32px;' /> ".CONFIG['site_name']."</span></a>";
			$html[] = "<span class='d-block'><b>Account Registration</b></span>";
		$html[] = "</div>";

			$html[] = "<form id='form' action='' method='POST'>";
				$html[] = "<input type='hidden' autocomplete='false' />";
				$html[] = "<input type='hidden' jsaction='paste:puy29d;' maxlength='2048' aria-autocomplete='both' aria-haspopup='false' autocapitalize='off' autocomplete='off' autocorrect='off' autofocus='' spellcheck='false'value='' aria-label='' />";
				$html[] = "<input type='hidden' dir='ltr' aria-autocomplete='list' aria-expanded='true' aria-label='' placeholder='' autocomplete='off' spellcheck='false' aria-invalid='false' aria-controls='jsc_c_3n'>";
				$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
				
				$html[] = "<div class='card card-md'>";
					$html[] = "<div class='card-body py-4 p-sm-5'>";

						$html[] = "<div class='registration_form'>";

							$html[] = "<div class='response mb-4'></div>";

							$html[] = "<input type='hidden' name='message_keys[publicKey]' id='publicKey' value='' />";
							$html[] = "<input type='hidden' name='message_keys[privateKey]' id='privateKey' value='' />";

							$html[] = "<input type='hidden' name='pin' id='pin' value='' />";
							$html[] = "<input type='hidden' name='api_key' id='api_key' value='' />";

							$html[] = "<input type='hidden' id='save_url' value='".url("RegistrationController@agreeToDataPrivacy")."' />";

							/* $html[] = "<div class='mb-4'>";
								$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Enter your Membership Email Address</h2>";
								$html[] = "<input type='email' class='form-control' name='email_address' id='email_address'  placeholder='Enter email address' autocomplete='off' tabindex='1'>";
								$html[] = "<span class='form-hint'>";
									$html[] = "<ul>";
										$html[] = "<li>The email address that you registered during your membership registration in PAREB.</li>";
									$html[] = "</ul>";
								$html[] = "</span>";
							$html[] = "</div>"; */

							$html[] = "<div class='mb-4'>";
								$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Enter a valid and working Email Address</h2>";
								$html[] = "<input type='email' class='form-control' name='email_address' id='email_address'  placeholder='Enter email address' autocomplete='off' tabindex='1'>";
								$html[] = "<span class='form-hint'>";
									$html[] = "<ul>";
										$html[] = "<li>The email address will be used as your membership official email address.</li>";
									$html[] = "</ul>";
								$html[] = "</span>";
							$html[] = "</div>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Choose your Membership Type</h2>";
								$html[] = "<select name='membership_type' class='form-select'>";
								foreach(["Lifetime Exempt", "Lifetime Paid", "Regular"] as $type) {
									$html[] = "<option value='".$type."'>".$type."</option>";
								}
								$html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Choose your Membership Standing</h2>";
								$html[] = "<select name='membership_position' class='form-select'>";
                                foreach(["Past National President", "Past National Director", "National Director", "Past President", "Regular Member", "Associate Member"] as $position) {
                                    $html[] = "<option value='".$position."'>".$position."</option>";
                                }
                                $html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<h2 class='card-title'><i class='ti ti-email'></i> Are you a Regular, New or Re-activated Member?</h2>";
								$html[] = "<select name='membership_status' class='form-select'>";
                                foreach(["Regular", "New", "Re-Activated"] as $status) {
                                    $html[] = "<option value='".$status."'>".$status."</option>";
                                }
                                $html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='row align-items-center mt-5' style='height:40px;'>";
								$html[] = "<div class='col-4'>";
									$html[] = "<span class='d-block text-muted mb-1 fs-12'>Step 1 of 4</span>";
									$html[] = "<div class='progress'>";
										$html[] = "<div class='progress-bar' style='width: 25%' role='progressbar' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' aria-label='25% Complete'>";
											$html[] = "<span class='visually-hidden'>25% Complete</span>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='col'>";
									$html[] = "<div class='btn-list justify-content-end'>";
										$html[] = "<span class='btn btn-primary btn-verify-membership'>Continue</span>";
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