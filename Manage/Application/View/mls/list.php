<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-sm-block'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@handshakedIndex")."'><i class='ti ti-user-plus me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark filter-btn' href=''><i class='ti ti-filter me-2'></i> Filter Result</span>";
						
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

		$html[] = "<div class='row'>";

			$html[] = "<div class='col-md-3 col-sm-4 d-none d-md-block'>";
				$html[] = "<div class='box-container mb-3'>";
					
					$html[] = "<div class=''>";

						$html[] = "<h3><i class='ti ti-filter me-2'></i> Filter Form</h3>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Address</label>";
							$html[] = $model->addresses->addressSelection();
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted mb-2'>Foreclosure Property</label>";
							$html[] = "<div class='form-group'>";
								$html[] = "<label class='form-check form-switch cursor-pointer'>";
									$html[] = "<input class='form-check-input' type='checkbox' name='foreclosed' value='1' id='foreclosure'  />";
									$html[] = "<span class='form-check-label' for='foreclosure'>Include foreclosure property?</span>";
								$html[] = "</label>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Offer</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-tags'></i></span>";
								$html[] = "<select class='form-control' name='offer' id='offer'>";
									$offer_type = array("For Sale","For Rent");
									foreach($offer_type as $key => $val) {
										$html[] = "<option value='".strtolower($val)."'>$val</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Property Type</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-building-estate'></i></span>";
								$html[] = "<select class='form-control' name='type' id='type'>";
									$offer_type = array("Residential","Commercial");
									foreach($offer_type as $key => $val) {
										$html[] = "<option value='".$val."'>$val</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Category</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-building-store'></i></span>";
								$html[] = $model->categorySelection();
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Bedroom</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-bed-flat'></i></span>";
								$html[] = "<select class='form-select' name='bedroom' id='bedroom'>";
									$html[] = "<option value=''>N/A</option>";
									$html[] = "<option value='Studio'>Studio</option>";
									for($i=1; $i<11; $i++) {
										$html[] = "<option value='$i'>$i Bedroom</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Bathroom</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-bath'></i></span>";
								$html[] = "<select class='form-select' name='bathroom' id='bathroom'>";
									for($i=0; $i<11; $i++) {
										$html[] = "<option value='$i'>".($i == 0 ? "No" : $i)." Bathroom</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Car Garage</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-car-garage'></i></span>";
								$html[] = "<select class='form-select' name='parking' id='parking'>";
									for($i=0; $i<11; $i++) {
										$html[] = "<option value='$i'>".($i == 0 ? "No Garage" : $i." car slot")."</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='text-end'>";
							$html[] = "<span class='btn btn-primary filter-result-btn'>View Result</span>";
						$html[] = "</div>";

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-md-9 col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MlsController@index")."' />";
						$html[] = "<a href='".url("MlsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['listings']) { $c=$model->page['starting_number'];

						for($i=0; $i<count($data['listings']); $i++) { $c++;
							$html[] = "<div class='row_listings_".$data['listings'][$i]['listing_id']." listing-wrap my-2'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-3'>";
										$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
									$html[] = "</div>";
									$html[] = "<div class='col-8'>";
										$html[] = "<h3 class='p-0'>".$data['listings'][$i]['title']."<small class='d-block fw-normal'>".ucwords($data['listings'][$i]['offer'])." ".$data['listings'][$i]['category']." in ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<div class='d-flex'>";
												$html[] = "<span class='d-block border me-2 p-2 text-center fw-bold fs-20'><label class='text-start d-block text-muted small fs-10 fw-normal'>Price</label>&#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
												if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Floor Area</label>".number_format($data['listings'][$i]['floor_area'],0)." sqm</span>"; }
												if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Lot Area</label>".number_format($data['listings'][$i]['lot_area'],0)." sqm</span>"; }
												if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bedroom</label>".$data['listings'][$i]['bedroom']."</span>"; }
												if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bathroom</label>".$data['listings'][$i]['bathroom']."</span>"; }
												if($data['listings'][$i]['parking'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Car Garage</label>".$data['listings'][$i]['parking']."</span>"; }
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='btn-list'>";
											$html[] = "<span class='btn btn-md btn-primary btn-requestHandshake btn-requestHandshake_".$data['listings'][$i]['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listings'][$i]['listing_id']])."'>Request Handshake</span>";
											$html[] = "<span class='btn btn-md btn-primary'>Compare</span>";
										$html[] = "</div>";

									$html[] = "</div>";
								$html[] = "</div>";
								
							$html[] = "</div>";
						}

					}else {
						$html[] = "<p class='mt-3'>Does not have listing yet.</p>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";