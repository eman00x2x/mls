<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System - Compare Table</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-sm-block'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@handshakedIndex")."'><i class='ti ti-heart-handshake me-2'></i> Handshaked</a>";

						$html[] = "<div class='btn-group'>";
							$html[] = "<span class='btn btn-dark filter-btn dropdown-toggle' data-bs-toggle='dropdown'><i class='ti ti-filter me-2'></i> Filter Columns</span>";
							$html[] = "<ul class='dropdown-menu'>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-avatar' /><label class='form-check-label' for='col-avatar'>Image</label></div></li>";
								$html[] = "<li class='dropdown-item pb-0'><div class='form-check pb-0 mb-0'><input type='checkbox' value='' class='form-check-input col-filter' checked id='col-foreclosed' /><label class='form-check-label' for='col-foreclosed'>Forclosure</label></div></li>";
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
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$html[] = "<div class='box-container mb-3'>";
		
			if($data) { $c=$model->page['starting_number'];

				$html[] = "<div class='table-responsive'>";
					$html[] = "<table class='table table-bordered table-hover table-striped'>";
					$html[] = "<tr>";
						$html[] = "<th class='align-middle text-center fw-bold col-avatar'></th>";
						$html[] = "<th class='align-middle text-center fw-bold col-foreclosed'>Forclosure?</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-offer'>Offer</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-category'>Category</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-lot_area'>Land Area</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-floor_area'>Floor Area</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-bedroom'>Bedroom</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-bathroom'>Bathroom</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-parking'>Car Garage</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-address'>Address</th>";
						$html[] = "<th class='align-middle text-center fw-bold col-price'>Price</th>";
						$html[] = "<th></th>";
					$html[] = "</tr>";

					for($i=0; $i<count($data); $i++) { $c++;

						$html[] = "<tr class='compare_row_".$data[$i]['listing_id']."'>";
							$html[] = "<td class='align-middle text-center col-avatar'><div class='avatar avatar-md' style='background-image: url(".$data[$i]['thumb_img'].")'></div></td>";
							$html[] = "<td class='align-middle text-center col-foreclosed'>".($data[$i]['foreclosed'] == 0 ? "No" : "Yes")."</td>";
							$html[] = "<td class='align-middle text-center col-offer'>".ucwords($data[$i]['offer'])."</td>";
							$html[] = "<td class='align-middle text-center col-category'>".$data[$i]['category']."</td>";
							$html[] = "<td class='align-middle text-center col-lot_area'>".($data[$i]['lot_area'] > 0 ? $data[$i]['lot_area']." sqm" : "-")."</td>";
							$html[] = "<td class='align-middle text-center col-floor_area'>".($data[$i]['floor_area'] > 0 ? $data[$i]['floor_area']." sqm" : "-")."</td>";
							$html[] = "<td class='align-middle text-center col-bedroom'>".($data[$i]['bedroom'] != 0 ? $data[$i]['bedroom'] : "-")."</td>";
							$html[] = "<td class='align-middle text-center col-bathroom'>".($data[$i]['bathroom'] != 0 ? $data[$i]['bathroom'] : "-")."</td>";
							$html[] = "<td class='align-middle text-center col-parking'>".($data[$i]['parking'] > 0 ? $data[$i]['parking'] : "-")."</td>";
							$html[] = "<td class='align-middle text-center col-address'>".$data[$i]['address']['municipality'].", ".$data[$i]['address']['province']."</td>";
							$html[] = "<td class='align-middle text-center col-price'>&#8369; ".number_format($data[$i]['price'],0)."</td>";
							$html[] = "<td class='align-middle text-center'><span class='btn btn-danger btn-remove-from-compare btn-remove-from-compare_".$data[$i]['listing_id']."' data-url='".url("MlsController@removeFromCompare")."' data-id='".$data[$i]['listing_id']."'><i class='ti ti-trash me-2'></i> Remove</span></td>";
						$html[] = "</tr>";

					}

					$html[] = "</table>";
				$html[] = "</div>";

			}else {
				$html[] = "<p class='mt-3'>Compare table is empty.</p>";
			}
			
		$html[] = "</div>";
			

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";