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

				$html[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon mb-2 text-green icon-lg' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0'></path><path d='M9 12l2 2l4 -4'></path></svg>";
				$html[] = "<h3 class='card-title text-green'>Congratulations!</h3>";
				$html[] = "<p class='mb-5'>Your account has been activated!</p>";

				$html[] = "<a href='".url("AuthenticatorController@getLoginForm")."' class='btn btn-primary w-100'>Login Now!</a>";

			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";