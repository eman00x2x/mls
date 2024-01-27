<?php

$html[] = "<div class='row'>";
	$html[] = "<div class='col-md-4 col-12  mx-auto'>";
		$html[] = "<div class='text-center mb-5'>&nbsp;</div>";
		$html[] = "<form class='card border-0' action='' method='POST'>";

			$html[] = "<div class='card-body p-4 '>";
		
				$html[] = "<div class='text-wrap'>";
					/* $html[] = "<p class='text-center mt-4 mb-5'><img src='".CDN."images/logo.png' class='img-fluid mb-3' style='width:350px;' /><br/><b>MLS Account Management</b></p>"; */
					$html[] = "<p class='text-center mt-4 mb-5'><span class='fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span><br/><b>MLS Account Management</b></p>";
				$html[] = "</div>";

				$html[] = getMsg();

				$html[] = "<div class='mb-3'>";
					$html[] = "<label class='form-label'><i class='ti ti-user-hexagon'></i> Username</label>";
					$html[] = "<input type='text' class='form-control' name='username'  placeholder='Enter username' autocomplete='off' tabindex='1'>";
				$html[] = "</div>";

				$html[] = "<div class='mb-3'>";
					$html[] = "<label class='form-label d-flex justify-content-between'>";
						$html[] = "<span class='d-block'><i class='ti ti-key'></i> Password</span>";
						$html[] = "<span class='d-block'><a href='".url("LoginController@forgotPassword")."' class='small text-decoration-none' title='Send Password Reset Link'><i class='ti ti-user-question'></i> I forgot my password</a></span>";
					$html[] = "</label>";
					$html[] = "<input type='password' class='form-control' name='password' placeholder='Password' tabindex='2'>";
				$html[] = "</div>";

				$html[] = "<div class='form-footer text-end'>";
					$html[] = "<button type='submit' class='btn btn-primary btn-block'>Sign in</button>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</form>";
	$html[] = "</div>";
$html[] = "</div>";