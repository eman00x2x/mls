<?php

function currentUrl(object $model, array $param = [], array $uri = []) {
	if($model->page['uri']['offer'] == "for sale") {
		$url = url("ListingsController@buy", $param, $uri);
	}else {
		$url = url("ListingsController@rent", $param, $uri);
	}

	return $url;
}

/* $html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'></h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>"; */

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-4'>";
			$html[] = "<div class='col-md-3'>";
				$html[] = "<div class='sidebar d-none d-md-block'>";

					$html[] = "<div class='filter-box'>";
						$html[] = "<div class='d-flex justify-content-between align-items-center'>";
					    	$html[] = "<h3>Filter Results</h3>";

							$html[] = "<a href='".currentUrl($model)."' class='text-decoration-none'><i class='ti ti-trash'></i> Clear filter</a>";
							
						$html[] = "</div>";
						$html[] = "<form id='filter-form' action='' method='POST'>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='form-label'>Category</div>";
								$html[] = $model->categorySelection((isset($model->page['uri']['category']) ? $model->page['uri']['category'] : null));
							$html[] = "</div>";

							$html[] = "<div class='form-label'>Price</div>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<select name='price' id='price' class='form-select'>";
									
									if($model->page['uri']['offer'] == "for rent") {
										$price_range = explode(",", "0 - Below 10000, 10000 - 20000, 20001 - 40000, 40001 - 60000, 60001 - 100000, 100001 - 1000000, 1000001 and above - 00");
									}else {
										$price_range = explode(",", "0 - Below 1000000, 1000001 - 3000000, 3000001 - 6000000, 6000001 - 10000000, 10000001 - 15000000, 15000001 - 25000000, 25000001 - 35000000, 35000001 - 45000000, 45000001 - 50000000, 50000001 - 80000000, 80000001 - 100000000, 100000001 - 120000000, 120000001 - 140000000, 140000001 - 160000000, 160000001 - 180000000, 180000001 - 200000000, 200000001 - 230000000, 230000001 - 260000000, 260000001 - 290000000, 310000001 - 350000000, 350000001 and above - 00");
									}
								
									$html[] = "<option value=''></option>";
									foreach($price_range as $range) {

										$price_val = trim(str_replace(["Below", "and above", " "],["","", ""], $range));
										$sel = isset($model->page['uri']['price']) && $model->page['uri']['price'] == $price_val ? "selected" : "";

										$price = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));

										$r1 = ($price[0] == "0" ? "Below" : "&#8369;".number_format($price[0],0)." - ");
										$r2 = ($price[1] == "00" ? "and above " : "&#8369;".number_format($price[1],0)."");

										$html[] = "<option value='".$price_val."' $sel>".$r1." ".$r2."</option>";
									}
								$html[] = "</select>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex gap-2'>";
								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='form-label'>Land Area</div>";
									$html[] = "<select name='lot_area' id='lot_area' class='form-select'>";
										$html[] = "<option value=''></option>";
										foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
											
											$land_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
											$sel = isset($model->page['uri']['lot_area']) && $model->page['uri']['lot_area'] == $land_area ? "selected" : "";

											$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
											$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)."sqm");
											$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)."sqm");

											$html[] = "<option value='".$land_area."' $sel>".$r1." - ".$r2."</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";

								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='form-label'>Floor Area</div>";
									$html[] = "<select name='floor_area' id='floor_area' class='form-select'>";
										$html[] = "<option value=''></option>";
										foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
											
											$floor_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
											$sel = isset($model->page['uri']['floor_area']) && $model->page['uri']['floor_area'] == $floor_area ? "selected" : "";
											
											$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
											$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)." sqm");
											$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)." sqm");
											$html[] = "<option value='".$floor_area."' $sel>".$r1." - ".$r2."</option>";
										}

									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='d-flex gap-2'>";
								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='form-label'>Bedroom</div>";
									$html[] = "<select name='bedroom' id='bedroom' class='form-select'>";
										$html[] = "<option value=''></option>";
										foreach(["Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
											$bedroom_val = trim(str_replace(["Bedroom", "and more"],["",""], $room));
											$sel = isset($model->page['uri']['bedroom']) && $model->page['uri']['bedroom'] == $bedroom_val ? "selected" : "";
											$html[] = "<option value='".$bedroom_val."' $sel>$room</option>";
										}

									$html[] = "</select>";
								$html[] = "</div>";

								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='form-label'>Bathroom</div>";
									$html[] = "<select name='bathroom' id='bathroom' class='form-select'>";
										$html[] = "<option value=''></option>";
										foreach(["1 Bathroom", "2 Bathroom", "3 Bathroom", "4 Bathroom", "5 Bathroom", "6 and more Bathroom"] as $room) {
											$bathroom = trim(str_replace(["Bedroom", "and more"],["",""], $room));
											$sel = isset($model->page['uri']['bathroom']) && $model->page['uri']['bathroom'] == $bathroom ? "selected" : "";
											$html[] = "<option value='".$bathroom."' $sel>$room</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='form-label'>Features & Amenities</div>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
									foreach(AMENITIES as $amenities) {
										$checked = isset($model->page['uri']['amenities']) && in_array($amenities, $model->page['uri']['amenities']) ? "checked" : "";										
										$html[] = "<label class='form-check cursor-pointer'>";
											$html[] = "<input type='checkbox' class='form-check-input' name='amenities[]' value='$amenities' $checked />";
											$html[] = "<span class='form-check-label'>$amenities</span>";
										$html[] = "</label>";
									}
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='form-label'>Tags</div>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
									foreach(PROPERTY_TAGS as $tag) {
										$checked = isset($model->page['uri']['tags']) && in_array($tag, $model->page['uri']['tags']) ? "checked" : "";										
										$html[] = "<label class='form-check cursor-pointer $checked'>";
											$html[] = "<input type='checkbox' class='form-check-input' name='tags[]' value='$tag' $checked />";
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
						$html[] = "</form>";

						$html[] = "<div class='btn-filter-container mt-5 sticky-bottom'>";
							$html[] = "<div class='pb-4' style='background-color: #f6f8fb; margin-bottom: -15px !important;'>";
								$html[] = "<span class='btn btn-primary w-100 btn-filter'><i class='ti ti-filter me-1'></i> Filter Result</span>";
							$html[] = "</div>";
						$html[] = "</div>";

					$html[] = "</div>";
				
        		$html[] = "</div>";
        	$html[] = "</div>";

			$html[] = "<div class='col-md-9'>";

				$html[] = "<div class='mb-2 d-flex align-items-baseline justify-content-end'>";
					
					$html[] = "<div class='btn-group'>";
						$html[] = "<div class='btn-group dropstart'>";
							$html[] = "<span class='btn btn-outline-secondary dropdown-toggle' id='btn-sort' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-sort-descending me-1'></i> Sort</span>";
							$html[] = "<ul class='dropdown-menu' aria-labelledby='btn-sort'>";

								$uri = function(array $uri) use ($model) {
									$r = $model->page['uri'];
									unset($r['offer']);

									foreach($uri as $k => $v) {
                                        $r[$k] = $v;
                                    }
									
									return $r;
								};

								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "last_modified", "order" => "ASC"]) )."' class='dropdown-item'>Newest</a></li>";
								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "last_modified", "order" => "DESC"]) )."' class='dropdown-item'>Oldest</a></li>";
								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "price", "order" => "ASC"]) )."' class='dropdown-item'>By Price</a></li>";
								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "lot_area", "order" => "ASC"]) )."' class='dropdown-item'>By Land Area</a></li>";
								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "floor_area", "order" => "ASC"]) )."' class='dropdown-item'>By Floor Area</a></li>";
								$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "score", "order" => "DESC"]) )."' class='dropdown-item'>By Relevance</a></li>";
							$html[] = "</ul>";
						$html[] = "</div>";

						$html[] = "<span class='btn btn-outline-secondary btn-filter-toggle d-sm-block d-md-none' data-bs-toggle='offcanvas' href='#offcanvasEnd' role='button' aria-controls='offcanvasEnd'><i class='ti ti-filter me-1'></i> Filter</span>";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class=''>";
					$html[] = "<p>There are a total of (".$model->rows.") results</p>";
				$html[] = "</div>";

				$html[] = "<div class='mb-3 border rounded featured-post' style='height:250px; '> <!-- FEATURED ADS --> </div>";

				$html[] = "<div class='row row-cards'>";
					$html[] = "<div class='space-y'>";
									
						if($data['listings']) {

							$c = 0;
							for($i=0; $i<count($data['listings']); $i++) { $c++;

									if ($i % 4 == 0) {
										/** Featured ads */
										$html[] = "<div class='card row_listings_".$data['listings'][$i]['listing_id']." featured-post'>";
											$html[] = "<div class='row g-0'>";
												$html[] = "<div class='col-md-3 col-sm-auto'>";
													$html[] = "<div class='card-body'>";
														$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."'>";
															$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
														$html[] = "</a>";
													$html[] = "</div>";
												$html[] = "</div>";
												$html[] = "<div class='col-md-9 col-sm-auto'>";
													$html[] = "<div class='card-body'>";
														$html[] = "<div class='row'>";
															$html[] = "<div class='col-md-8 col-8'>";
																$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' style='text-decoration: none;' class='text-dark'><h3 class='mb-0'>".$data['listings'][$i]['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3></a>";
															$html[] = "</div>";
															
															$html[] = "<div class='col-md-4 col-4 text-end'>";
																$html[] = "<span class='fs-18 text-green fw-bold'><i class='ti ti-tag'></i> &#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
															$html[] = "</div>";
														$html[] = "</div>";

														$html[] = "<div class='row'>";
															$html[] = "<div class='col-md'>";
																$html[] = "<div class='mt-3 list list-inline mb-0 text-secondary '>";
																	if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bedroom</span> <i class='ti ti-bed me-1'></i> ".$data['listings'][$i]['bedroom']."</div>"; }
																	if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bathroom</span> <i class='ti ti-bath me-1'></i> ".$data['listings'][$i]['bathroom']."</div>"; }
																	if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>	<span class='d-block mb-1 fs-10 text-muted'>Floor Area</span> <i class='ti ti-ruler me-1'></i> ".number_format($data['listings'][$i]['floor_area'],0)." sqm</div>"; }
																	if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Land Area</span> <i class='ti ti-maximize me-1'></i> ".number_format($data['listings'][$i]['lot_area'],0)." sqm</div>"; }
																	if($data['listings'][$i]['parking'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Garage</span> <i class='ti ti-car-garage me-1'></i> ".$data['listings'][$i]['parking']."</div>"; }
																$html[] = "</div>";

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
										/** End Featured ads */
									}


									$html[] = "<div class='card row_listings_".$data['listings'][$i]['listing_id']."'>";
										$html[] = "<div class='row g-0'>";
											$html[] = "<div class='col-md-3 col-sm-auto'>";
												$html[] = "<div class='card-body'>";
													$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."'>";
														$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
													$html[] = "</a>";
												$html[] = "</div>";
											$html[] = "</div>";
											$html[] = "<div class='col-md-9 col-sm-auto'>";
												$html[] = "<div class='card-body'>";
													$html[] = "<div class='row'>";
														$html[] = "<div class='col-md-8 col-8'>";
															$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' style='text-decoration: none;' class='text-dark'><h3 class='mb-0'>".$data['listings'][$i]['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3></a>";
														$html[] = "</div>";
														
														$html[] = "<div class='col-md-4 col-4 text-end'>";
															$html[] = "<span class='fs-18 text-green fw-bold'><i class='ti ti-tag'></i> &#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
														$html[] = "</div>";
													$html[] = "</div>";

													$html[] = "<div class='row'>";
														$html[] = "<div class='col-md'>";
															$html[] = "<div class='mt-3 list list-inline mb-0 text-secondary '>";
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
							}else {

								$html[] = "<div class='empty'>";
									$html[] = "<div class='empty-header'>No Results</div>";
									$html[] = "<p class='empty-title'>Oops... no results found in your search.</p>";
									$html[] = "<p class='empty-subtitle'>Clear your filter and try another search</p>";
									$html[] = "<div class='empty-action'>";
										$html[] = "<a href='".currentUrl($model)."' class='btn btn-light'>Clear filter</a>";
									$html[] = "</div>";
								$html[] = "</div>";

							}
						
					$html[] = "</div>";
				$html[] = "</div>";
        	$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";