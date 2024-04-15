<?php

$html[] = "<div class='d-flex flex-column'>";
$html[] = "<div class='page page-center'>";

	$html[] = "<div class='container container-tight py-4'>";
		$html[] = "<div class='text-center mb-4'>";
			$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span></a>";
			$html[] = "<span class='d-block'><b>MLS Account Registration</b></span>";
		$html[] = "</div>";

		$html[] = "<form id='form' action='' method='POST'>";
			$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
			
			$html[] = "<div class='card card-md'>";
				$html[] = "<div class='card-body py-4 p-sm-5'>";

					$html[] = "<div class='registration_form'>";

						$html[] = "<h1>Congratulations!</h1>";
						$html[] = "<p>You are now a member of PAREB MLS, but before you can log in, please activate your account by visiting your email. We have sent you the activation link.</p>";

						$html[] = "<div class=''>";
							$html[] = "<p class='text-muted'>Did you find the activation link in your email? If not, you can resend it.</p>";
							$html[] = "<a href='".url("RegistrationController@resendActivationLinkForm")."' class='btn btn-primary btn-continue'>Resend Activation link</a>";
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