<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i></h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-4'>";
			$html[] = "<div class='col-md-3'>";
				$html[] = "<div class='sidebar sticky-top'>";

					$html[] = "<div class='filter-box'>";

					    $html[] = "<h3>Filter Results</h3>";
						
						$html[] = "<div class='mb-4'>";
							$html[] = "<div class='form-label'>Category</div>";
							$html[] = $model->categorySelection((isset($model->page['uri']['category']) ? $model->page['uri']['category'] : null));
						$html[] = "</div>";

						$html[] = "<div class='form-label'>Price</div>";
						$html[] = "<div class='mb-4'>";
							$html[] = "<select name='price' id='price' class='form-select'>";
								$price_range = explode(",", "0 - Below 10000, 10000 - 20000, 20001 - 40000, 40001 - 60000, 60001 - 100000, 100001 - 1000000, 1000001 - 3000000, 3000001 - 6000000, 6000001 - 10000000, 10000001 - 15000000, 15000001 - 25000000, 25000001 - 35000000, 35000001 - 45000000, 45000001 - 50000000, 50000001 - 80000000, 80000001 - 100000000, 100000001 - 120000000, 120000001 - 140000000, 140000001 - 160000000, 160000001 - 180000000, 180000001 - 200000000, 200000001 - 230000000, 230000001 - 260000000, 260000001 - 290000000, 310000001 - 350000000, 350000001 and above - 00");
								$html[] = "<option value=''></option>";
								foreach($price_range as $range) {
									$price = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));

									$r1 = ($price[0] == "0" ? "Below" : "&#8369;".number_format($price[0],0)."");
									$r2 = ($price[1] == "00" ? "above " : "&#8369;".number_format($price[1],0)."");

									$html[] = "<option value='".trim(str_replace(["Below", "and above", " "],["","", ""], $range))."'>".$r1." - ".$r2."</option>";
								}
							$html[] = "</select>";
						$html[] = "</div>";

						$html[] = "<div class='d-flex gap-2'>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='form-label'>Bedroom</div>";
								$html[] = "<select name='bedroom' id='bedroom' class='form-select'>";
									$html[] = "<option value=''></option>";
									foreach(["Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
										$html[] = "<option value='".trim(str_replace(["Bedroom", "and more"],["",""], $room))."'>$room</option>";
									}
								$html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='form-label'>Bathroom</div>";
								$html[] = "<select name='bathroom' id='bathroom' class='form-select'>";
									$html[] = "<option value=''></option>";
									foreach(["1 Bathroom", "2 Bathroom", "3 Bathroom", "4 Bathroom", "5 Bathroom", "6 and more Bathroom"] as $room) {
										$html[] = "<option value='".trim(str_replace(["Bathroom", "and more"],["",""], $room))."'>$room</option>";
									}
								$html[] = "</select>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='d-flex gap-2'>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='form-label'>Land Area</div>";
								$html[] = "<select name='lot_area' id='lot_area' class='form-select'>";
									
									foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
										$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));

										$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)."sqm");
										$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)."sqm");

										$html[] = "<option value='".trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range))."'>".$r1." - ".$r2."</option>";
									}
								$html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='form-label'>Floor Area</div>";
								$html[] = "<select name='lot_area' id='lot_area' class='form-select'>";
									
									foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
										$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
										$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)." sqm");
										$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)." sqm");
										$html[] = "<option value='".trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range))."'>".$r1." - ".$r2."</option>";
									}

								$html[] = "</select>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-label'>Features & Amenities</div>";
						$html[] = "<div class='mb-4'>";
							$html[] = "<div class='overflow-auto border p-3' style='min-height:100px; max-height:200px;'>";
								foreach(AMENITIES as $amenities) {
									$html[] = "<label class='form-check cursor-pointer'>";
										$html[] = "<input type='checkbox' class='form-check-input' name='amenities[]' value='$amenities' />";
										$html[] = "<span class='form-check-label'>$amenities</span>";
									$html[] = "</label>";
								}
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-label'>Tags</div>";
						$html[] = "<div class='mb-4'>";
							$html[] = "<div class='overflow-auto border p-3' style='min-height:100px; max-height:200px;'>";
								foreach(PROPERTY_TAGS as $tag) {
									$html[] = "<label class='form-check cursor-pointer'>";
										$html[] = "<input type='checkbox' class='form-check-input' name='tags[]' value='$tag' />";
										$html[] = "<span class='form-check-label'>$tag</span>";
									$html[] = "</label>";
								}
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-label'>Include Foreclosure Property?</div>";
					    $html[] = "<div class='mb-4'>";
							$html[] = "<label class='form-check form-switch cursor-pointer'>";
								$html[] = "<input class='form-check-input' type='checkbox' value='0'>";
								$html[] = "<span class='form-check-label form-check-label-on'>On</span>";
								$html[] = "<span class='form-check-label form-check-label-off'>Off</span>";
							$html[] = "</label>";
							$html[] = "<div class='small text-secondary'>If On, results will include foreclosure properties</div>";
						$html[] = "</div>";

						$html[] = "<div class='mt-5'>";
							$html[] = "<span class='btn btn-primary w-100'>Filter Result</span>";
						$html[] = "</div>";

					$html[] = "</div>";
				
        		$html[] = "</div>";
        	$html[] = "</div>";

			$html[] = "<div class='col-md-9'>";
				$html[] = "<div class='row row-cards'>";
					$html[] = "<div class='space-y'>";

						$c = 0;
						for($i=0; $i<count($data['listings']); $i++) { $c++;
								$html[] = "<div class='card row_listings_".$data['listings'][$i]['listing_id']."'>";
									$html[] = "<div class='row g-0'>";
										$html[] = "<div class='col-md-3 col-sm-auto'>";
											$html[] = "<div class='card-body'>";
												$html[] = "<a href='".url("ListingsController@view", ["id" => $data['listings'][$i]['listing_id']])."'>";
													$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
												$html[] = "</a>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-md-9 col-sm-auto'>";
											$html[] = "<div class='card-body'>";
												$html[] = "<div class='row'>";
													$html[] = "<div class='col-md-8 col-8'>";
														$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data['listings'][$i]['listing_id']])."' style='text-decoration: none;' class='text-dark'><h3 class='mb-0'>".$data['listings'][$i]['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3></a>";
													$html[] = "</div>";
													
													$html[] = "<div class='col-md-4 col-4 text-end'>";
														$html[] = "<span class='fs-18 text-green fw-bold'><i class='ti ti-tag'></i> &#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
													$html[] = "</div>";
												$html[] = "</div>";

												$html[] = "<div class='row'>";
													$html[] = "<div class='col-md'>";
														$html[] = "<div class=' list-inline list-inline-dots mb-0 text-secondary '>";
															if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bedroom</span> <i class='ti ti-bed me-1'></i> ".$data['listings'][$i]['bedroom']."</div>"; }
															if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bathroom</span> <i class='ti ti-bath me-1'></i> ".$data['listings'][$i]['bathroom']."</div>"; }
															if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>	<span class='d-block mb-1 fs-10 text-muted'>Floor Area</span> <i class='ti ti-ruler me-1'></i> ".number_format($data['listings'][$i]['floor_area'],0)." sqm</div>"; }
															if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Land Area</span> <i class='ti ti-maximize me-1'></i> ".number_format($data['listings'][$i]['lot_area'],0)." sqm</div>"; }
															if($data['listings'][$i]['parking'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Garage</span> <i class='ti ti-car-garage me-1'></i> ".$data['listings'][$i]['parking']."</div>"; }
														$html[] = "</div>";

														/** MOBILE DESIGN */
														/* $html[] = "<div class='mt-3 list mb-0 text-secondary d-block d-sm-none'>";
															if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<div class='list-inline'><i class='ti ti-bed me-1'></i>".$data['listings'][$i]['bedroom']."</div>"; }
															if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<div class='list-inline'><i class='ti ti-bath me-1'></i>".$data['listings'][$i]['bathroom']."</div>"; }
															if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<div class='list-inline'><i class='ti ti-ruler me-1'></i>".number_format($data['listings'][$i]['floor_area'],0)." sqm</div>"; }
															if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<div class='list-inline'><i class='ti ti-maximize me-1'></i> ".number_format($data['listings'][$i]['lot_area'],0)." sqm</div>"; }
															if($data['listings'][$i]['parking'] > 0) { $html[] = "<div class='list-inline'><i class='ti ti-car-garage me-1'></i>".$data['listings'][$i]['parking']."</div>"; }
														$html[] = "</div>"; */
													$html[] = "</div>";

													if($data['listings'][$i]['tags']) {
														$html[] = "<div class='col-md-auto'>";
															$html[] = "<div class='mt-3 badges'>";
																foreach($data['listings'][$i]['tags'] as $tag) {
																	$html[] = "<span class='badge badge-outline text-secondary fw-normal badge-pill mx-1'>$tag</span>";
																}
															$html[] = "</div>";
														$html[] = "</div>";
													}
												$html[] = "</div>";

												/* $html[] = "<div class='mt-4 '>";
													$html[] = "<div class='btn-list'>";
														$html[] = "<span class='btn btn-md btn-primary btn-requestHandshake btn-requestHandshake_".$data['listings'][$i]['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
														if(!in_array($data['listings'][$i]['listing_id'],(isset($_SESSION['compare']['listings']) ? array_keys($_SESSION['compare']['listings']) : []))) {
															$html[] = "<span class='btn btn-md btn-light btn-add-to-compare btn-add-to-compare_".$data['listings'][$i]['listing_id']."' data-url='".url("MlsController@addToCompare")."' data-id='".$data['listings'][$i]['listing_id']."'><i class='ti ti-layers-difference me-2'></i> Compare</span>";
														}
													$html[] = "</div>";
												$html[] = "</div>"; */

											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";

							}
						
					$html[] = "</div>";
				$html[] = "</div>";
        	$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";