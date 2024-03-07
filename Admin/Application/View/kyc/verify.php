<?php

$html[] = "<input type='hidden' id='save_url' value='".url("KYCController@saveUpdate", ["id" => $data['kyc_id']])."' />";

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

	/** START PAGE BODY */
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='row justify-content-center'>";
				$html[] = "<div class='col-md-6 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";

							$html[] = "<h1 class='display-5'>Customer Verification</h1>";

							if($data['kyc_status'] == 1) {
								$html[] = "<div class='text-center'>";
									$html[] = "<img src='".CDN."images/tick_48.png' style='width:64px;' />";

									$html[] = "<div class='mb-3 mt-3'>";
										$html[] = "<a data-fslightbox href='".$data['documents']['kyc']['selfie']."'>";
											$html[] = "<span class='avatar avatar-xxxl' style='background-image:url(".$data['documents']['kyc']['selfie'].")'></span>";
										$html[] = "</a>";
									$html[] = "</div>";

									$html[] = "<p class='fs-18'>".$data['firstname']." ".$data['lastname']." is already verified!</p>";

								$html[] = "</div>";
							}else {
								
								$html[] = "<ul class='list-group list-group-flush mb-4'>";
									$html[] = "<li class='list-group-item py-2 m-0'>";
										$html[] = "<span><i class='ti ti-address-book'></i> Personal Information</span>";

										$html[] = "<div class='row'>";
											$html[] = "<div class='col-auto'>";
												$html[] = "<div class='ms-5 mt-3 '>";
													$html[] = "<table class='table table-sm table-borderless'>";
													$html[] = "<tr>";
														$html[] = "<td>Full Name</td>";
														$html[] = "<td class='fw-bold'>".$data['firstname']." ".$data['lastname']."</td>";
													$html[] = "</tr>";
													$html[] = "<tr>";
														$html[] = "<td>Birth Date</td>";
														$html[] = "<td class='fw-bold'>".date("d M Y",strtotime($data['birthdate']))."</td>";
													$html[] = "</tr>";
													$html[] = "<tr>";
														$html[] = "<td>Email Address</td>";
														$html[] = "<td class='fw-bold'>".$data['email']."</td>";
													$html[] = "</tr>";
													$html[] = "</table>";

												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";

									$html[] = "</li>";
									$html[] = "<li class='list-group-item py-2 m-0'>";
										$html[] = "<span class='mb-3 d-block'><i class='ti ti-file-check'></i> Documents</span>";

											$html[] = "<div class='mb-3'>";
												$html[] = "<a data-fslightbox href='".$data['documents']['kyc']['selfie']."'>";
													$html[] = "<span class='avatar avatar-xxxl' style='background-image:url(".$data['documents']['kyc']['selfie'].")'></span>";
												$html[] = "</a>";
											$html[] = "</div>";

											$html[] = "<div class='mb-3'>";
												$html[] = "<a data-fslightbox href='".$data['documents']['kyc']['id']."'>";
													$html[] = "<span class='avatar avatar-xxxl' style='width:430px; background-image:url(".$data['documents']['kyc']['id'].")'></span>";
												$html[] = "</a>";
											$html[] = "</div>";
										
									$html[] = "</li>";

									$html[] = "<li class='list-group-item py-2 m-0'>";
										$html[] = "<span class='mt-3 mb-3 d-block'><i class='ti ti-address-book'></i> Other Information</span>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='form-label'>ID Expiration Date</label>";
											$html[] = "<input type='date' name='id_expiration_date' value='".$data['id_expiration_date']."' class='form-control' />";
										$html[] = "</div>";

										$html[] = "<div class='mb-4'>";
											$html[] = "<label class='form-label'>KYC Staus</label>";
											$html[] = "<select name='kyc_status' class='form-select'>";
												foreach([1=>"Accept Docs", "2" => "Denied Docs"] as $key => $value) {
													$sel = $data['kyc_status'] == $key ? "selected" : "";
													$html[] = "<option value='$key' $sel>$value</option>";
												}
												
											$html[] = "</select>";
										$html[] = "</div>";

									$html[] = "</li>";

								$html[] = "</ul>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='btn-list'>";
										$html[] = "<span class='btn btn-secondary'><i class='ti ti-x me-1'></i> cancel</span>";
										$html[] = "<span class='btn btn-primary btn-save'><i class='ti ti-device-floppy me-1'></i> Save KYC</span>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
							

						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
	/** END PAGE */
		
$html[] = "</form>";