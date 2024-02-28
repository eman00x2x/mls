<?php

$html[] = "<input type='hidden' id='save_url' value='".url("LoginController@saveNewPassword")."' />";
$html[] = "<div class='d-flex flex-column'>";
	$html[] = "<div class='page page-center'>";
		$html[] = "<div class='container container-tight py-4'>";
			$html[] = "<div class='text-center mb-4 mt-5'>";
				$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span></a>";
				$html[] = "<span class='d-block'><b>MLS Account Password Reset</b></span>";
			$html[] = "</div>";

			$html[] = "<div class='card'>";
			
				$html[] = "<div class='card-body p-6'>";
					$html[] = "<div class='card-status bg-blue'></div>";
					
					if(isset($data['user_id']) && isset($data['expires'])) {
						
						$date_now = DATE_NOW;
						$expire_date = strtotime($data['expires']);
						
						if($date_now <= $expire_date) {
							
							$html[] = "<div class='card-title'>Reset your password</div>";
							$html[] = "<div class='respons mb-4'>";
								$html[] = getMsg();
							$html[] = "</div>";
							
							$html[] = "<form id='form' action='' method='POST'>";
								$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
								$html[] = "<input name='user_id' id='user_id' type='hidden' value='".$data['user_id']."' />";
								
								$html[] = "<div class='mb-3'>";
									$html[] = "<label class='form-label'>New Password</label>";
									$html[] = "<input type='password' class='form-control' name='password' id='password'  placeholder='Enter password' autocomplete='off' required />";
								$html[] = "</div>";
								
								$html[] = "<div class='mb-3'>";
									$html[] = "<label class='form-label'>Confirm Password</label>";
									$html[] = "<input type='password' class='form-control' name='cpassword' id='cpassword'  placeholder='Confirm password' autocomplete='off' required />";
								$html[] = "</div>";
							$html[] = "</form>";

							$html[] = "<div class='form-footer text-center mb-3'>";
								$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy'></i> &nbsp; Reset Password</span>";
							$html[] = "</div>";

							$html[] = "<p class='text-center'>";
								$html[] = "<span class='d-block mb-2'><a href='".url("/")."' class='text-decoration-none' title='MLS Login'><i class='ti ti-key'></i> Login here</a></span>";
								$html[] = "<span class='d-block mb-2'><a href='".url("/forgotPassword")."' class='text-decoration-none' title='Send Password Reset Link'> Request another link to reset your password</a></span>";
							$html[] = "</p>";
							
						}else {
							$html[] = "<div class='card-title'>Link Expired</div>";
							$html[] = "<p>Your password reset link has expire. Please <a href='".url("LoginController@forgot-password")."' title='Send Password Reset Link'>request another one</a> to reset your password.</p>";
						}
					}else {
						$html[] = "<div class='card-title'>Link Expired</div>";
						$html[] = "<p>Your password reset link has expire. Please <a href='".url("LoginController@forgot-password")."' title='Send Password Reset Link'>request another link</a> to reset your password.</p>";
					}

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";