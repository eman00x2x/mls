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

					$html[] = "<div class='registration_form text-center'>";

						$html[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon mb-2 text-green icon-lg' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0'></path><path d='M9 12l2 2l4 -4'></path></svg>";
						$html[] = "<h3>Congratulations!</h3>";
						$html[] = "<p>You are now a member of ".CONFIG['site_name'].", but before you can log in, please activate your account by visiting your email. We have sent you the activation link.</p>";

						$html[] = "<div class=''>";
							$html[] = "<p class='text-muted'>Did you find the activation link in your email? If not, you can resend it.</p>";
							$html[] = "<a href='".url("RegistrationController@resendActivationLinkForm")."' class=''>Resend Activation link</a>";
						$html[] = "</div>";
						
					$html[] = "</div>";
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</form>";

		$html[] = "<div class='text-center text-secondary mt-3'>";
			$html[] = "Already have account? <a href='".url("AuthenticatorController@getLoginForm")."' tabindex='-1'>Sign in</a>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";
$html[] = "</div>";