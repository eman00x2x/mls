<?php

$html[] = "<input type='hidden' name='save_url' id='save_url' value='".MANAGE_ALIAS."/checkCredentials' />";
$html[] = "<input type='hidden' name='reference_url' id='reference_url' value='".MANAGE_ALIAS."/' />";

$html[] = "<div class='d-flex flex-column bg-white'>";
	$html[] = "<div class='row g-0 flex-fill'>";
		$html[] = "<div class='row g-0 flex-fill'>";
			$html[] = "<div class='col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center'>";
				$html[] = "<div class='container container-tight my-5 px-lg-5'>";

					$html[] = "<div class='px-3'>";
						$html[] = "<div class='text-center mb-4'>";
							$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand fs-32'><img src='".CDN."images/logo.png' style='width:32px;' /> ".CONFIG['site_name']."</a>";
							$html[] = "<span class='d-block'><b>Account Authentication</b></span>";
						$html[] = "</div>";

						$html[] = "<form id='form' class='border-0' action='' method='POST'>";

							$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
							$html[] = "<input type='hidden' name='user_agent' id='user_agent' value='' />";

							$html[] = "<h2 class='h3 text-center mb-4'>Login to your account</h2>";
							
							$html[] = "<div class='mb-3 '>";
								$html[] = "<label class='form-label'>Email Address</label>";
								$html[] = "<input type='email' class='form-control' name='email' id='email'  placeholder='Enter email' autocomplete='off' tabindex='1'>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3 '>";
								$html[] = "<label class='form-label'>";
									$html[] = "<span>Password</span>";
									$html[] = "<span class='form-label-description'><a href='".url("AuthenticatorController@getForgotPasswordForm")."' class='text-decoration-none' title='Send Password Reset Link'><i class='ti ti-user-question'></i> I forgot my password</a></span>";
								$html[] = "</label>";
								$html[] = "<div class='input-group input-group-flat'>";
									$html[] = "<input type='password' class='form-control' name='password' id='password' placeholder='Password' tabindex='2'>";
									$html[] = "<span class='input-group-text'>";
										
									$html[] = "</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='form-footer'>";
								$html[] = "<span class='btn btn-primary w-100 btn-login'>Sign in</span>";
							$html[] = "</div>";
						$html[] = "</form>";

						$html[] = "<div class='response text-center'>";
							$html[] = getMsg();
						$html[] = "</div>";

						$html[] = "<div class='text-center text-secondary mt-3'>";
							$html[] = "Don't have account yet? <a href='".url("RegistrationController@register")."' tabindex='-1'>Sign up</a>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-12 col-lg-6 col-xl-8 d-none d-lg-block'>";
				$html[] = "<div class='bg-cover h-100 min-vh-100' style='background-image: url(".CDN."images/real-estate.jpg); background-size: 110%;'></div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";