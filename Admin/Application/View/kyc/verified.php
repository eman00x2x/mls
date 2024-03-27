<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveNew")."' />";

	$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
	$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
		$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
		$html[] = "<center>";
			$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
		$html[] = "</center>";
	$html[] = "</form>";


	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

/** START PAGE BODY */
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row justify-content-center'>";
			$html[] = "<div class='col-md-6 col-12'>";

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='text-center'>";
								$html[] = "<h1 class='display-5'>You are Verified!</h1>";
								$html[] = "<div class='mb-3 mt-3'>";
									$html[] = "<a data-fslightbox href='".$data[0]['documents']['kyc']['selfie']."'>";
										$html[] = "<span class='avatar avatar-xxxl' style='background-image:url(".$data[0]['documents']['kyc']['selfie'].")'></span>";
									$html[] = "</a>";
								$html[] = "</div>";

								$html[] = "<div class='mb-3 mt-3'>";
									$html[] = "<a data-fslightbox href='".$data[0]['documents']['kyc']['id']."'>";
										$html[] = "<span class='avatar avatar-xxxl' style='width:350px; background-image:url(".$data[0]['documents']['kyc']['id'].")'></span>";
									$html[] = "</a>";
								$html[] = "</div>";

								$html[] = "<div class='mb-3 mt-3'>";
									$html[] = "<p>".date("d M Y", strtotime($data[0]['id_expiration_date']))."<span class='small text-muted d-block'>ID Expiration</span></p>";
								$html[] = "</div>";

							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</form>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";
/** END PAGE */

