<?php

$html[] = "<div class='row'>";
	$html[] = "<div class='col-md-6 col-sm-12  mx-auto'>";
		$html[] = "<div class='text-center mb-5'>&nbsp;</div>";

		$html[] = "<input type='hidden' id='save_url' value='".url("LoginController@sendPasswordResetLink")."' />";
		$html[] = "<form id='form' class='card border-0' action='' method='POST' autocomplete='off'>";

			$html[] = "<input type='text' autocomplete='false' name='hidden' class='d-none' />";

			$html[] = "<div class='card-body p-4 '>";

				$html[] = "<div class='text-wrap'>";
					/* $html[] = "<p class='text-center mt-4 mb-5'><img src='".CDN."images/logo.png' class='img-fluid mb-3' style='width:350px;' /><br/><b>MLS Account Management</b></p>"; */
					$html[] = "<p class='text-center mt-4 mb-5'><span class='fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span><br/><b>Forgot Password</b></p>";
				$html[] = "</div>";

				$html[] = "<div class='response'>".getMsg()."</div>";

				$html[] = "<div class='mb-3'>";
					$html[] = "<label class='form-label'><i class='ti ti-email'></i> Registered Email</label>";
					$html[] = "<input type='email' class='form-control' name='email'  placeholder='Enter registered email' autocomplete='off' role='presentation' required />";
				$html[] = "</div>";

				$html[] = "<div class='form-footer text-center mb-3'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-send'></i> &nbsp; Send Password Reset Link</span>";
				$html[] = "</div>";

				$html[] = "<p class='text-center'>";
					$html[] = "<a href='".url("/")."' class='ajax text-gray' title='MLS Login'>Login here</a>";
				$html[] = "</p>";
			$html[] = "</div>";
		$html[] = "</form>";

	$html[] = "</div>";
$html[] = "</div>";