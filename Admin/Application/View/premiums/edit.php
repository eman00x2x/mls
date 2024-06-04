<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("PremiumsController@saveUpdate",["id" => $data['premium_id']])."' />";

$html[] = "<form id='form' action='' method='POST'>";

	$html[] = "<input type='hidden' name='_method' id='_method' value='post' />";
	$html[] = "<input type='hidden' name='created_at' id='created_at' value='".$data['created_at']."' />";
	$html[] = "<input type='hidden' name='status' id='status' value='active' />";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

	$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-12 m-auto '>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				$html[] = "<div class='container-xl'>";
					$html[] = "<div class='row g-2 '>";
						$html[] = "<div class='col'>";
							$html[] = "<div class='page-pretitle'>Update this Premium to satisfy the general public.</div>";
							$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Update Premium</h1>";
						$html[] = "</div>";
						$html[] = "<div class='col-auto ms-auto d-print-none'>";
							$html[] = "<div class='btn-list text-end'>";
								$html[] = "<a class='ajax btn btn-dark' href='".url("PremiumsController@view",["id" => $data['premium_id']])."'><i class='ti ti-layers-union me-2'></i> View Premium</a>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='page-body'>";
				$html[] = "<div class='container-xl'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-layers-union me-2'></i> Premium Info</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='mb-3'>";
								$html[] = "<label class='form-label'>Premium Name</label>";
								$html[] = "<input type='text' name='name' value='".$data['name']."' class='form-control' />";
							$html[] = "</div>";

							$html[] = "<div class='mb-3'>";
								$html[] = "<label class='form-label'>Details</label>";
								$html[] = "<textarea class='form-control' name='details'>".$data['details']."</textarea>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3'>";
								$html[] = "<label class='form-label'>Cost per 30 days</label>";
								$html[] = "<div class='input-group'>";
									$html[] = "<span class='input-group-text'>&#8369;</span>";
									$html[] = "<input type='number' name='cost' value='".$data['cost']."' step='1' class='form-control' />";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-settings me-2'></i> Settings</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='mb-3 row'>";
								$html[] = "<label class='col-sm-3 col-form-label'>Category</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='category'>";
										foreach(["package","add-on"] as $value) {
											$sel = $value == $data['category'] ? "selected" : "";
											$html[] = "<option value='$value' $sel>".ucwords(str_replace("_"," ",$value))."</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3 row'>";
								$html[] = "<label class='col-sm-3 col-form-label'>Type</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='type'>";
										foreach([/* "permanent", */"limited_time"] as $value) {
											$sel = $value == $data['type'] ? "selected" : "";
											$html[] = "<option value='$value' $sel>".ucwords(str_replace("_"," ",$value))."</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3 row'>";
								$html[] = "<label class='col-sm-3 col-form-label'>Duration Selection</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='duration'>";
										foreach(["30,90,180,365", "30,90", "30,90,180", "30", "90", "180", "365"] as $value) {
											$list = json_encode(explode(",", $value));
											$sel = $list == json_encode($data['duration']) ? "selected" : "";
											$html[] = "<option value='$list' $sel>".$value." days</option>";
										}
									$html[] = "</select>";
									$html[] = "<span class='form-hint fs-12'>Members can select their subscription duration</span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='mb-3 row'>";
								$html[] = "<label class='col-sm-3 col-form-label'>Public Visibility</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='visibility'>";
										foreach([0,1] as $value) {
											$sel = $value == $data['visibility'] ? "selected" : "";
											$html[] = "<option value='$value' $sel>".($value == 1 ? "Show" : "Hide")."</option>";
										}
									$html[] = "</select>";
									$html[] = "<span class='form-hint fs-12'>Select \"Show\" to allow members to choose this premium; otherwise, hide it</span>";
								$html[] = "</div>";
							$html[] = "</div>";
								
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-json me-2'></i> Script</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";
							
							foreach(PREMIUM_SCRIPTS as $premium => $val) {
								$html[] = "<div class='mb-3 row'>";
									$html[] = "<label class='col-sm-3 col-form-label'>".ucwords(str_replace("_"," ", $premium))."</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='number' name='script[$premium]' value='".(isset($data['script'][$premium]) ? $data['script'][$premium] : null)."' class='form-control' />";
									$html[] = "</div>";
								$html[] = "</div>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</form>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Publish Premium</span>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";