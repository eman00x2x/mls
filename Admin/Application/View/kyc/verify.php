<?php

$html[] = "<input type='hidden' id='save_url' value='".url("KYCController@saveUpdate", ["id" => $data['kyc_id']])."' />";

$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
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

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user me-2'></i> KYC Verification</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<form id='form' action='' method='POST'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
	
	/** START PAGE BODY */
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='row row-deck row-cards'>";
				$html[] = "<div class='col-lg-3 col-md-6 col-sm-12 col-12'>";

					$html[] = "<div class='card mb-3'>";

						$html[] = "<div class='card-header'>";
							$html[] = "<h1 class='card-title'>Selfie Picture</h1>";
						$html[] = "</div>";

						$html[] = "<div class='card-body text-center'>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<a data-fslightbox href='".$data['documents']['kyc']['selfie']."'>";
									$html[] = "<span class='avatar avatar-xxxl rounded' style='background-image: url(".$data['documents']['kyc']['selfie'].")'></span>";
								$html[] = "</a>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3 text-start'>";
								$html[] = "<div class='card-title'><i class='ti ti-address-book'></i> Personal Information</div>";

								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-file me-1'></i> Full Name:</span> <strong>".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['middlename']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</strong></div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-calendar me-1'></i> Birth Date:</span> <strong>".date("d M Y",strtotime($data['birthdate']))."</strong></div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-mail me-1'></i> Email:</span> <strong>".$data['email']."</strong></div>";
						
							$html[] = "</div>";

							$html[] = "<div class='mt-5 text-start'>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-calendar me-1'></i> Submitted at:</span> <strong>".date("d F Y", $data['created_at'])."</strong></div>";
							$html[] = "</div>";
							
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
				$html[] = "<div class='col-lg-5 col-md-6 col-sm-12 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h1 class='card-title'>Identification Card</h1>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							$html[] = "<div class='mb-4 overflow-auto'>";
								$html[] = "<a data-fslightbox href='".$data['documents']['kyc']['id']."'>";
									$html[] = "<span class='avatar avatar-xxxl' style='width:430px; background-image:url(".$data['documents']['kyc']['id'].")'></span>";
								$html[] = "</a>";
							$html[] = "</div>";

							$html[] = "<div class='form-floating mb-3'>";
								$html[] = "<input type='text' id='id_expiration_date' value='".date("d F Y", strtotime($data['id_expiration_date']))."' class='form-control-plaintext' />";
								$html[] = "<label for='id_expiration_date'>ID Expiration Date</label>";
							$html[] = "</div>";

						/* $html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h1 class='card-title'>Verification</h1>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>"; */

							if($data['kyc_status'] == 0) {

								$html[] = "<div class='form-floating mb-4'>";
									$html[] = "<select name='verification_details' id='verification_details' class='form-select fs-22' style='height: auto;'>";

										foreach($data['verification_explanation'] as $value) {
											$sel = $data['verification_details'] == $value ? "selected" : "";
											$html[] = "<option value='$value' $sel>$value</option>";
										}
									$html[] = "</select>";
									$html[] = "<label for='verification_details'>Verification Explanation</label>";
								$html[] = "</div>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='d-flex justify-content-between'>";
										$html[] = "<a href='".url("KYCController@index")."' class='btn btn-light'><i class='ti ti-x me-1'></i> cancel</a>";
										$html[] = "<span class='btn btn-primary btn-save'><i class='ti ti-device-floppy me-1'></i> Save KYC</span>";
									$html[] = "</div>";
								$html[] = "</div>";

							}else {

								$html[] = "<div class='form-floating mb-3'>";
									$html[] = "<input type='text' id='status' value='".$data['kyc_status_description'][ $data['kyc_status'] ]."' class='form-control-plaintext fs-22' />";
									$html[] = "<label for='status'>KYC Status</label>";
								$html[] = "</div>";

								if($data['verification_details'] != "") {
									$html[] = "<div class='form-floating mb-3'>";
										$html[] = "<input type='text' id='verification_details' value='".$data['verification_details']."' class='form-control-plaintext fs-22' />";
										$html[] = "<label for='verification_details'>Verification Details</label>";
									$html[] = "</div>";
								}

							}

						$html[] = "</div>";

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
	/** END PAGE */
		
$html[] = "</form>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";