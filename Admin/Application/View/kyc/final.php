<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveNew")."' />";

$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<form id='form' action='' method='POST'>";

	$html[] = "<div class='row justify-content-center'>";
		$html[] = "<div class='col-md-6 col-12'>";

			/** START PAGE BODY */
			$html[] = "<div class='page-body'>";
				$html[] = "<div class='container-xl'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='text-center'>";

								$html[] = "<img src='".CDN."images/icons/hourglass-high.svg' width='72' />";
								$html[] = "<h1 class='display-5'>Verification on Progress</h1>";
								$html[] = "<p>Your KYC verification is currently in progress.<br/>You will receive a notification via email once the verification is complete.</p>";
								$html[] = "<img src='".CDN."images/icons/line-dotted.svg' width='72' />";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
			/** END PAGE */
		
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</form>";