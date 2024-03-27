<?php

$html[] = "<input type='hidden' name='save_url' id='save_url' value='".MANAGE_ALIAS."/checkCredentials' />";
$html[] = "<input type='hidden' name='reference_url' id='reference_url' value='".MANAGE_ALIAS."/' />";

$html[] = "<div class='d-flex flex-column'>";
	$html[] = "<div class='page page-center'>";
		$html[] = "<div class='container container-tight py-4'>";
			$html[] = "<div class='text-center mb-4 mt-5'>";
				$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span></a>";
				$html[] = "<span class='d-block'><b>MLS Account Authentication</b></span>";
			$html[] = "</div>";

			$html[] = "<div class='card card-md'>";
				$html[] = "<div class='card-body'>";
					
					$html[] = "<form id='form' class='border-0' action='' method='POST'>";

						$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

						$html[] = "<h2 class='h2 text-center mb-4'>Login to your account</h2>";
						
						$html[] = "<div class='mb-3 '>";
							$html[] = "<label class='form-label'><i class='ti ti-user-hexagon'></i> Email</label>";
							$html[] = "<input type='email' class='form-control' name='email' id='email'  placeholder='Enter email' autocomplete='off' tabindex='1'>";
						$html[] = "</div>";

						$html[] = "<div class='mb-3 '>";
							$html[] = "<label class='form-label'>";
								$html[] = "<span><i class='ti ti-key'></i> Password</span>";
								$html[] = "<span class='form-label-description'><a href='".url("AuthenticatorController@getForgotPasswordForm")."' class='text-decoration-none' title='Send Password Reset Link'><i class='ti ti-user-question'></i> I forgot my password</a></span>";
							$html[] = "</label>";
							$html[] = "<div class='input-group input-group-flat'>";
								$html[] = "<input type='password' class='form-control' name='password' id='password' placeholder='Password' tabindex='2'>";
								$html[] = "<span class='input-group-text'>";
									/* $html[] = "<a href='#' title='Show password' data-bs-toggle='tooltip'><i class='ti ti-eye'></i></a>"; */
								$html[] = "</span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-footer'>";
							/* $html[] = "<button type='submit' class='btn btn-primary w-100'>Sign in</button>"; */
							$html[] = "<span class='btn btn-primary w-100 btn-login'>Sign in</span>";
						$html[] = "</div>";
					$html[] = "</form>";

					$html[] = "<div class='response'>";
						$html[] = getMsg();
					$html[] = "</div>";
					
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='text-center text-secondary mt-3'>";
				$html[] = "Don't have account yet? <a href='".url("RegistrationController@register")."' tabindex='-1'>Sign up</a>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";