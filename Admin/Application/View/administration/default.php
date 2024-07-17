<?php

$html[] = "<form action='".url("AdministrationController@uploadCSV")."' id='csvUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='csvBrowse' id='csvBrowse' />";
		$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
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
				$html[] = "<h1 class='page-title'><i class='ti ti-database me-2'></i> Database Administration</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list'>";
					/* $html[] = "<span class='btn btn-dark btn-upload-csv'><i class='ti ti-upload me-1'></i> Upload Email CSV File</span>";
					$html[] = "<a class='btn btn-dark' href='".url("AdministrationController@downloadCsvEmail")."'><i class='ti ti-download me-1'></i> Download Email CSV File</a>"; */
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-lg-3 col-md-3 col-sm-12 col-12'>";

				$html[] = "<div class='box-container  mt-2 mb-4'>";
					$html[] = "<h3 class='px-0'>Run SQL query/queries on server</h3>";

					$html[] = "<form id='form' method='POST' action=''>";
						$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
						$html[] = "<div class='form-group'>";
							$html[] = "<textarea class='form-control' name='query' id='query'></textarea>";
						$html[] = "</div>";

						$html[] = "<div class='text-end border-top pt-3'>";
							$html[] = "<span class='btn btn-md btn-primary btn-submit-admin-form cursor-pointer'>Run Query</span>";
						$html[] = "</div>";

					$html[] = "</form>";

				$html[] = "</div>";

				$html[] = "<h5>TABLE OPTIONS</h5>";
				$html[] = "<div class='dropdown'>";
					$html[] = "<button class='btn btn-secondary btn-sm dropdown-toggle mr-1 mb-1' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> SELECT TABLE </button>";
					$html[] = "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
						foreach($data['tables'] as $table_name) {
							$html[] = "<a class='dropdown-item show_table cursor-pointer' data-query='SELECT * FROM $table_name LIMIT 0,20'>".$table_name."</a>";
						}
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='dropdown'>";
					$html[] = "<button class='btn btn-secondary btn-sm dropdown-toggle  mr-1 mb-1' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> DESCRIBE TABLE </button>";
					$html[] = "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
						foreach($data['tables'] as $table_name) {
							$html[] = "<a class='dropdown-item show_table cursor-pointer' data-query='DESCRIBE $table_name'>".$table_name."</a>";
						}
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<hr/>";

				$html[] = "<span class='btn btn-sm btn-success btn-backup cursor-pointer'>Backup Database</span>";

				$html[] = "<div class='p-3 bg-white border my-3'>";
					$html[]= "<h3 class='mb-0'>Backup</h3>";
					$html[] = "<p class='fs-12 text-muted mb-2'>Reload to update the list. click to download.</p>";
					$html[] = "<div class='overflow-auto' style='height:300px;'>";
						if($data['backup_files']) {
							$html[] = "<ul class='list-group list-group-flush'>";
							$i=0;
							foreach($data['backup_files'] as $file) { $i++;
								$html[] = "<li class='list-group-item py-1 px-0 m-0'>";
									$html[] = "<div class='d-flex gap-2 justify-content-between'>";
										$html[] = "<div>$i. <a href='".url("AdministrationController@downloadBackup", null, ["file" => $file])."'>$file</a></div>";
										$html[] = "<div><span data-url='".url("AdministrationController@deleteBackup", null, ["file" => $file])."' class='text-danger btn-delete-backup cursor-pointer'><i class='ti ti-trash'></i></span></div>";
									$html[] = "</div>";
								$html[] = "</li>";
							}
							$html[] = "</ul>";
						}
						$html[] = "";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";

			$html[] = "<div class='col-lg-9 col-md-9 col-sm-12 col-12'>";

				$html[] = "<div class='box-container  mt-2 mb-4'>";
					$html[] = "<h3 class='px-0'>Result</h3>";
					$html[] = "<div class='query_result'></div>";
				$html[] = "</div>";

			$html[] = "</div>";

		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";
