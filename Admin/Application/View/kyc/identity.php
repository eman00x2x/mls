<?php

$html[] = "<input type='hidden' id='save_url' value='".url("KYCController@saveNew", ["id" => $data['account_id']])."' />";

$html[] = "<input type='hidden' id='reference_url' value='".url("KYCController@kycVerificationForm", ["id" => $data['account_id']], ["step" => "3"])."' />";
$html[] = "<input type='hidden' id='photo_container' value='' />";
$html[] = "<form action='".url("KYCController@kycDocsUpload", ["id" => $data['account_id']])."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
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

	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
	$html[] = "<input type='hidden' name='account_id' value='".$data['account_id']."' />";

	/** START PAGE BODY */
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='row justify-content-center'>";
				$html[] = "<div class='col-md-6 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";

							$html[] = "<h1 class='display-5'>Identity Verification</h1>";
							$html[] = "<p><i class='ti ti-camera'></i> Take a selfie photo and upload</p>";

							$html[] = "<p>Example</p>";
							$html[] = "<div class='d-flex mb-3 gap-3'>";
								$html[] = "<div class=''>";
									$html[] = "<span class='avatar avatar-xxl' style='background-image: url(".CDN."images/kyc-picture-sample.png);'></span>";
								$html[] = "</div>";
								$html[] = "<div class=''>";
									$html[] = "<ul class='list-group list-group-flush'>";
										$html[] = "<li class='list-group-item py-2'><i class='ti ti-check'></i> Take a selfie of yourself with a neutral expression</li>";
										$html[] = "<li class='list-group-item py-2'><i class='ti ti-check'></i> Make sure your whole face is visible, centered and your eyes are open.</li>";
										$html[] = "<li class='list-group-item py-2'><i class='ti ti-x'></i> Do not crop your ID or use screenshot of your ID</li>";
										$html[] = "<li class='list-group-item py-2'><i class='ti ti-x'></i> Do not hide or alter parts of your face (No hats/beauty images/filters/headgear)</li>";
									$html[] = "</ul>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<p class='text-muted'>File size must be between 10KB and 5MB in .jpg/.jpeg/.png format.</p>";

							$html[] = "<hr />";

							$html[] = "<input type='hidden' class='photo-selfie' name='documents[kyc][selfie]' value='' />";
							$html[] = "<input type='hidden' class='photo-id' name='documents[kyc][id]' value='' />";

							$html[] = "<div class='d-flex mb-3 gap-4'>";
								$html[] = "<div class=''>";
									$html[] = "<span class='avatar avatar-xxl photo-preview selfie-container' style='background-image: url(".CDN."images/blank-profile.png)' data-photo-container='selfie-container'></span>";
									$html[] = "<small class='d-block mt-2 text-center fw-bold'>UPLOAD SELFIE HERE</small>";
								$html[] = "</div>";

								$html[] = "<div class=''>";
									$html[] = "<span class='avatar avatar-xxl photo-preview id-container' style='width:300px; background-image: url(".CDN."images/reb-sample-license.jpg)' data-photo-container='id-container'></span>";
									$html[] = "<small class='d-block mt-2 text-center fw-bold'>UPLOAD REAL ESTATE<br/> BROKER LICENSE (FRONT) HERE</small>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<p class='text-muted mb-4'><i class='ti ti-lock'></i> This information is used for personal verification only and kept private and confidential.</p>";

							$html[] = "<div class='text-start'>";
								$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Verify my Identity</span>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";
				
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
	/** END PAGE */
		
$html[] = "</form>";