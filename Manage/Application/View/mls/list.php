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
						
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@handshakedIndex")."'><i class='ti ti-heart-handshake me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark btn-compare-table' data-url='".url("MlsController@comparePreview")."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd'><i class='ti ti-layers-difference me-2'></i> Compare Table</span>";
						$html[] = "<span class='btn btn-dark btn-filter-form d-sm-block d-md-none' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd'><i class='ti ti-filter me-2'></i> Filter Result</span>";
						
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
					
					$html[] = "<div class='form-container'>";
					$html[] = "<div class='filter-form'>";
						$html[] = "<form id='filter-form'>";

							$html[] = "<div class='offcanvas-header border-bottom-0 p-0'>";
								$html[] = "<h3><i class='ti ti-filter me-2'></i> Filter Form</h3>";
							$html[] = "</div>";
							
							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'>Address</label>";
								$html[] = $model->addresses->addressSelection((isset($model->page['uri']['address']) ? $model->page['uri']['address'] : null));
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
										$offer_type = array("for Sale","for Rent");
										foreach($offer_type as $key => $val) {
											$sel = isset($model->page['uri']['offer']) && $model->page['uri']['offer'] == $val ? "selected" : "";
											$html[] = "<option value='".$val."' $sel>".ucwords($val)."</option>";
										}
									$html[] = "</select>";
									$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex gap-2'>";
								$html[] = "<div class='form-group'>";
									$html[] = "<label class='form-label text-muted'>Property Type</label>";
									$html[] = "<div class='input-icon mb-3'>";
										$html[] = "<span class='input-icon-addon'><i class='ti ti-building-estate'></i></span>";
										$html[] = "<select class='form-control' name='type' id='type'>";
											$offer_type = array("Residential","Commercial");
											foreach($offer_type as $key => $val) {
												$sel = isset($model->page['uri']['type']) && $model->page['uri']['type'] == $val ? "selected" : "";
												$html[] = "<option value='".$val."' $sel>$val</option>";
											}
										$html[] = "</select>";
										$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='form-group'>";
									$html[] = "<label class='form-label text-muted'>Category</label>";
									$html[] = "<div class='input-icon mb-3'>";
										$html[] = "<span class='input-icon-addon'><i class='ti ti-building-store'></i></span>";
										$html[] = $model->categorySelection(isset($model->page['uri']['category']) ? $model->page['uri']['category'] : null);
										$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'><i class='ti ti-bed-flat'></i> Bedroom</label>";

								$html[] = "<div class='d-flex gap-2'>";
									$html[] = "<input type='text' name='bedroom[from]' id='from_bedroom' value='".(isset($model->page['uri']['bedroom']) ? $model->page['uri']['bedroom']['from'] : null)."' placeholder='from' class='form-control' />";
									$html[] = "<div>-</div>";
									$html[] = "<input type='number' name='bedroom[to]' id='to_bedroom' value='".(isset($model->page['uri']['bedroom']) ? $model->page['uri']['bedroom']['to'] : null)."' placeholder='to' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'><i class='ti ti-bath'></i> Bathroom</label>";

								$html[] = "<div class='d-flex gap-2'>";
									$html[] = "<input type='number' name='bathroom[from]' id='from_bathroom' value='".(isset($model->page['uri']['bathroom']) ? $model->page['uri']['bathroom']['from'] : null)."' placeholder='from' class='form-control' />";
									$html[] = "<div>-</div>";
									$html[] = "<input type='number' name='bathroom[to]' id='to_bathroom' value='".(isset($model->page['uri']['bathroom']) ? $model->page['uri']['bathroom']['to'] : null)."' placeholder='to' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'><i class='ti ti-car-garage'></i> Car Garage</label>";

								$html[] = "<div class='d-flex gap-2'>";
									$html[] = "<input type='number' name='parking[from]' id='from_parking' value='".(isset($model->page['uri']['parking']) ? $model->page['uri']['parking']['from'] : null)."' placeholder='from' class='form-control' />";
									$html[] = "<div>-</div>";
									$html[] = "<input type='number' name='parking[to]' id='to_parking' value='".(isset($model->page['uri']['parking']) ? $model->page['uri']['parking']['to'] : null)."' placeholder='to' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'><i class='ti ti-ruler'></i> Land Area</label>";

								$html[] = "<div class='d-flex gap-2'>";
									$html[] = "<input type='number' name='lot_area[from]' id='from_lot_area' value='".(isset($model->page['uri']['lot_area']) ? $model->page['uri']['lot_area']['from'] : null)."' placeholder='from' class='form-control' />";
									$html[] = "<div>-</div>";
									$html[] = "<input type='number' name='lot_area[to]' id='to_lot_area' value='".(isset($model->page['uri']['lot_area']) ? $model->page['uri']['lot_area']['to'] : null)."' placeholder='to' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='form-group mb-3'>";
								$html[] = "<label class='form-label text-muted'><i class='ti ti-currenct-peso'></i> Price</label>";

								$html[] = "<div class='d-flex gap-2'>";
									$html[] = "<input type='number' name='price[from]' id='from_price' value='".(isset($model->page['uri']['price']) ? $model->page['uri']['price']['from'] : 2500000)."' placeholder='from' class='form-control' />";
									$html[] = "<div>-</div>";
									$html[] = "<input type='number' name='price[to]' id='to_price' value='".(isset($model->page['uri']['price']) ? $model->page['uri']['price']['to'] : 10000000)."' placeholder='to' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='text-end'>";
								$html[] = "<span class='btn btn-primary btn-filter-result'>View Result</span>";
							$html[] = "</div>";

						$html[] = "</form>";
					$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-md-9 col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MlsController@MLSIndex")."' />";
						$html[] = "<a href='".url("MlsController@MLSIndex")."' class='btn btn-sm btn-light clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['listings']) { $c=$model->page['starting_number'];

						for($i=0; $i<count($data['listings']); $i++) { $c++;
							$html[] = "<div class='row_listings_".$data['listings'][$i]['listing_id']." listing-wrap my-2 pb-2 border-bottom'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-sm-5 col-md-4 col-12 text-center'>";
										$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data['listings'][$i]['listing_id']])."' class='text-decoration-none'>";
											$html[] = "<div class='avatar avatar-xxxl mb-2' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
										$html[] = "</a>";
									$html[] = "</div>";
									$html[] = "<div class='col-sm-7 col-md-8 col-12'>";
										$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data['listings'][$i]['listing_id']])."' class='text-decoration-none'>";
											$html[] = "<h3 class='p-0'>".$data['listings'][$i]['title']."<small class='d-block fw-normal'>".ucwords($data['listings'][$i]['offer'])." ".$data['listings'][$i]['category']." in ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3>";
										$html[] = "</a>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<div class='d-flex flex-wrap'>";
												$html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fw-bold fs-20'><label class='text-start d-block text-muted small fs-10 fw-normal'>Price</label>&#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
												if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Floor Area</label>".number_format($data['listings'][$i]['floor_area'],0)." sqm</span>"; }
												if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Lot Area</label>".number_format($data['listings'][$i]['lot_area'],0)." sqm</span>"; }
												if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bedroom</label>".$data['listings'][$i]['bedroom']."</span>"; }
												if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bathroom</label>".$data['listings'][$i]['bathroom']."</span>"; }
												if($data['listings'][$i]['parking'] > 0) { $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Car Garage</label>".$data['listings'][$i]['parking']."</span>"; }
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='btn-list'>";
											$html[] = "<span class='btn btn-md btn-primary btn-requestHandshake btn-requestHandshake_".$data['listings'][$i]['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
											if(!in_array($data['listings'][$i]['listing_id'],array_keys($_SESSION['compare']['listings']))) {
												$html[] = "<span class='btn btn-md btn-light btn-add-to-compare btn-add-to-compare_".$data['listings'][$i]['listing_id']."' data-url='".url("MlsController@addToCompare")."' data-id='".$data['listings'][$i]['listing_id']."'><i class='ti ti-layers-difference me-2'></i> Compare</span>";
											}
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