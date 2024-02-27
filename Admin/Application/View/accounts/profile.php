<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveUpdate",["id" => $data['account_id']])."' />";

$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='response'>";
	$html[] = "<div class='container-xl'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<h1 class='page-title'><i class='ti ti-file-certificate me-2'></i> Profile </h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='btn-list text-end'>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@index")."' title='Accounts'><i class='ti ti-list me-2'></i> Accounts</a>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		/** START PAGE BODY */
		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-status bg-orange'></div>";
						
						
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='row'>";
								$html[] = "<div class='col-lg-9 col-md-9 col-12'>";
									$html[] = "<div class='form-group mb-3'>";
										$html[] = "<label class='form-label text-muted'>Craft an impressive profile.</label>";
										$html[] = "<textarea id='snow-container' name='profile' class='form-control' style='width:100%'>".$data['profile']."</textarea>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</form>";
				
			$html[] = "</div>";
		$html[] = "</div>";
		/** END PAGE */

	$html[] = "</div>";
$html[] = "</div>";


$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Profile</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";