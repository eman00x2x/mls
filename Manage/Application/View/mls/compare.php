<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div id='fb-root'></div>";
$html[] = "<script>";
	$html[] = "(function(d, s, id) {";
		$html[] = "var js, fjs = d.getElementsByTagName(s)[0];";
		$html[] = "if (d.getElementById(id)) return;";
		$html[] = "js = d.createElement(s); js.id = id;";
		$html[] = "js.src = \"https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0\";";
		$html[] = "fjs.parentNode.insertBefore(js, fjs);";
	$html[] = "}(document, 'script', 'facebook-jssdk'));";
$html[] = "</script>";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> Comparative Analysis Table</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-sm-block'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href='".MANAGE."exportToExcel.php'><i class='ti ti-download me-2'></i> Download</a>";

						$html[] = "<div class='btn-group'>";
							$html[] = "<span class='btn btn-dark filter-btn dropdown-toggle' data-bs-toggle='dropdown'><i class='ti ti-filter me-2'></i> Filter Columns</span>";
							$html[] = "<ul class='dropdown-menu'>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-avatar' /><label class='form-check-label' for='col-avatar'>Image</label></div></li>";
								/* $html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-foreclosed' /><label class='form-check-label' for='col-foreclosed'>Forclosure</label></div></li>"; */
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-category' /><label class='form-check-label' for='col-category'>Category</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-lot_area' /><label class='form-check-label' for='col-lot_area'>Land Area</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-floor_area' /><label class='form-check-label' for='col-floor_area'>Floor Area</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-bedroom' /><label class='form-check-label' for='col-bedroom'>Bedroom</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-bathroom' /><label class='form-check-label' for='col-bathroom'>Bathroom</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-parking' /><label class='form-check-label' for='col-parking'>Car Garage</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-address' /><label class='form-check-label' for='col-address'>Address</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-price' /><label class='form-check-label' for='col-price'>Price</label></div></li>";
							$html[] = "</ul>";
						$html[] = "</div>";

						$html[] = "<div class=''>";
							$html[] = "<span class='btn dropdown-toggle btn-dark' data-bs-toggle='dropdown'><i class='ti ti-table-down me-2'></i> <span class='d-none d-sm-block'>Rows</span></span>";
							$html[] = "<div class='dropdown-menu'>";
								$limit = $model->page['uri'];
								foreach([20, 50, 80, 100, 200, 500, 1000] as $rows_to_show) {                        
									$limit["rows"] = $rows_to_show;
									$html[] = "<a class='dropdown-item d-flex justify-content-between' href='".url('MlsController@compareListings', null, $limit)."'><span>Show $rows_to_show rows</span></a>";
								}
							$html[] = "</div>";
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$columns = explode(",","offer,category,lot_area,floor_area,bedroom,bathroom,parking,address,price");

		$html[] = "<div class='alert alert-info bg-white alert-dismissible fade show'>";
			$html[] = "To download all results, click on \"Rows\" and select \"Show 1000 rows.\" This will display all 1000 results, which you can then download. ";
			$html[] = "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
		$html[] = "</div>";
		
		$html[] = "<div class='card'>";
			$html[] = "<div class='table-responsive'>";
				$html[] = "<table class='table table-vcenter table-bordered card-table caption-top'>";
				$html[] = "<thead>";

					$html[] = "<tr>";
						$html[] = "<th class='text-center col-avatar'>Image</th>";
						foreach($columns as $col) {
							

							if($col == "address") {
								foreach(explode(",", "street,village,barangay,municipality,province") as $address) {
									$html[] = "<th class='text-center col-$col'>".ucwords(str_replace("_"," ",$address))."</th>";
								}
							}else {
								$html[] = "<th class='text-center col-$col'>".ucwords(str_replace("_"," ",$col))."</th>";
							}
						}

					$html[] = "<tr>";
					
				$html[] = "</thead>";

				$html[] = "<tbody>";

					for($i=0; $i<count($data['listing']); $i++) {
						
						$html[] = "<tr>";
							$html[] = "<td class='text-center col-avatar'>";
								$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data['listing'][$i]['listing_id']])."'>";
									$html[] = "<div class='avatar avatar-xl' style='background-image: url(".$data['listing'][$i]['thumb_img'].")'></div>";
								$html[] = "</a>";
							$html[] = "</td>";

							foreach($columns as $col) {
								switch($col) {
									case 'address':
										foreach(explode(",", "street,village,barangay,municipality,province") as $address) {
											$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data['listing'][$i]["address"][$address]."</td>";
										}
										break;
									
									case 'price':
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>&#8369;".number_format($data['listing'][$i]['price'],0)."</td>";
										break;

									default:
										if(isset($data['listing'][$i][$col])) {
											$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data['listing'][$i][$col]."</td>";
										}else {
											$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'></td>";
										}
								}

							}
						$html[] = "</tr>";

					}

				$html[] = "</tbody>";
				$html[] = "</table>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

		$html[] = "<div class='mt-4 text-center'>";

			$html[] = "<div class='row justify-content-center'>";
				$html[] = "<div class='col-lg-4 col-md-6 col-12'>";

					$html[] = "<div class='create-url-form'>";
						$html[] = "<h3>Create Share Link</h3>";
						$html[] = "<form id='share-form' action='' method='POST'>";
							$html[] = "<div class='form-floating mb-3'>";
								$html[] = "<select name='expiration_date' id='expiration_date' class='form-select'>";
								foreach([7, 15, 30] as $day) {
									$html[] = "<option value='".strtotime("+$day", DATE_NOW)."'>$day days</option>";
								}
								$html[] = "</select>";
								$html[] = "<label for='expiration_date'>Share Link Expiration</label>";
							$html[] = "</div>";

							$html[] = "<span class='btn btn-primary btn-create-url'>Create Share Link</span>";
						$html[] = "</form>";
					$html[] = "</div>";

					$html[] = "<div class='share-link-container text-center d-none'>";
						$html[] = "<div class='row justify-content-center mb-4'>";
							$html[] = "<div class='col-lg-4 col-md-6 col-4'>";
								$html[] = \Library\Helper::socialMediadShareButtons([
									"title" => "Compare Analysis Table",
									"description" => "A detailed comparative of different real estate properties",
									"img" => "",
									"url" => '',
								]);
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='input-group input-group'>";
							$html[] = "<span class='input-group-text'>Share link</span>";
							$html[] = "<input type='text' class='form-control share-link-input' value='' readonly />";
						$html[] = "</div>";
					$html[] = "</div>";


				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";