<?php

$html[] = "<div class='mt-5 pt-5'></div>";

$html[] = "<div class='d-flex flex-column'>";
$html[] = "<div class='page page-center'>";
	$html[] = "<div class='container container-tight py-4'>";
		$html[] = "<div class='text-center mb-4'>";
			$html[] = "<a href='".WEBDOMAIN."' class='navbar-brand'><span class='d-block fs-30 fw-bold'><i class='ti ti-building-skyscraper'></i> MLS</span></a>";
			$html[] = "<span class='d-block'><b>MLS Account Activation</b></span>";
		$html[] = "</div>";

		$html[] = "<div class='card card-md '>";
			$html[] = "<div class='card-body text-center my-5 py-5 p-sm-5'>";

				$html[] = "<h3 class='card-title text-green'>Congratulations!</h3>";
				$html[] = "<p class='mb-5'>Your account has been activated!</p>";

				$html[] = "<a href='".url("AuthenticatorController@getLoginForm")."' class='btn btn-primary w-100'>Login Now!</a>";

			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";