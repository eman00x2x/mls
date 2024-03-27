<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("UsersController@saveUpdate",["id" => $data['account_id'], "user_id" => $data['user_id']])."' />";

$html[] = "<form id='form' action='' method='POST'>";

	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

	$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-12'>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				$html[] = "<div class='container-xl'>";

					$html[] = "<div class='row g-2 '>";
						$html[] = "<div class='col'>";
							$html[] = "<div class='page-pretitle'>Manage your account password</div>";
							$html[] = "<h1 class='page-title'><i class='ti ti-key me-2'></i> Change Password</h1>";
						$html[] = "</div>";
						$html[] = "<div class='col-auto ms-auto d-print-none'>";
							if(isset($_SESSION['permissions']['account']['access'])) {
								$html[] = "<a href='".url("AccountsController@index")."' class='btn btn-dark'><i class='ti ti-user-circle me-2'></i> My Account</a>";
							}
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='page-body'>";
				$html[] = "<div class='container-xl'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-key me-2'></i> Change Password</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='mb-3'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-lg-3 col-md-3 col-6'>";
										$html[] = "<label class='text-muted form-label text-end mt-2'>New Password</label>";
									$html[] = "</div>";

									$html[] = "<div class='col-lg-9 col-md-9 col-6'>";
										$html[] = "<input type='password' name='password' id='password' value='' class='form-control' />";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-lg-3 col-md-3 col-6'>";
										$html[] = "<label class='text-muted form-label text-end mt-2'>Confirm Password</label>";
									$html[] = "</div>";

									$html[] = "<div class='col-lg-9 col-md-9 col-6'>";
										$html[] = "<input type='password' name='cpassword' id='cpassword' value='' class='form-control' />";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<p class='text-info text-center'>You will be logout once you save your new password.</p>";

						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='text-end'>";
						$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Password</span>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
			
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</form>";
