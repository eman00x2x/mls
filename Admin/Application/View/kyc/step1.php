<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveNew")."' />";

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

$html[] = "<form id='form' action='' method='POST'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

	/** START PAGE BODY */
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='row justify-content-center'>";
				$html[] = "<div class='col-md-6 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";


							$html[] = "<h1 class='display-5'>Let's get you verified!</h1>";
							$html[] = "<p><i class='ti ti-checklist'></i> Complete the following steps to verify your account.</p>";

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

									$html[] = "<p class='text-muted'>Is the information above correct? This information must be shown on your ID card. If not, please update your <a href='".url("AccountsController@index")."'>profile</a></p>";

								$html[] = "</li>";
								$html[] = "<li class='list-group-item py-2 m-0'>";
									$html[] = "<span><i class='ti ti-file-check'></i> Document Verification</span>";
									$html[] = "<p class='text-muted'>Upload your selfie and Real Estate Broker License ID</p>";
								$html[] = "</li>";
							$html[] = "</ul>";

							$html[] = "<div class='text-start'>";
								$html[] = "<a href='".url("KYCController@kycVerificationForm",  ["id" => $data['account_id']], ["step" => 2])."' class='btn btn-outline-primary'><i class='ti ti-arrow-right me-2'></i> Continue</a>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
	/** END PAGE */
		
		

$html[] = "</form>";