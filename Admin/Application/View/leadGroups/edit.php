<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";

	$html[] = "<input type='hidden' id='save_url' value='".url("LeadGroupsController@saveUpdate", ["id" => $data['lead_group_id']])."' />";

	$html[] = "<div class='row justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-md-6 col-12'>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'>Lead Groups</div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-edit me-2'></i>Update Group</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";
								$html[] = "<span class='btn btn-danger btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadGroupsController@delete", ["id" => $data['lead_group_id']])."' data-content=''><i class='ti ti-trash me-2'></i> Delete Group</span>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";

			$html[] = "<div class='page-body'>";
			
				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Group Details</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Group Name</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='name' id='name' value='".$data['name']."' class='form-control' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='text-end'>";
								$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Group</span>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</form>";

			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";