<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Manage Property Listing of ".$data['account_name']['firstname']." ".$data['account_name']['lastname']."</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> Property Listings</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						$html[] = "<span class='ajax btn btn-dark btn-download-listings'><i class='ti ti-download me-2'></i> Download Listings</span>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("ListingsController@index", null, ["status" => 2])."'><i class='ti ti-home-dollar me-2'></i> Show Sold</a>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("ListingsController@add")."'><i class='ti ti-user-plus me-2'></i> New Listing</a>";

						$html[] = "<div class='dropdown'>";
							$html[] = "<button class='btn btn-dark dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-filter me-1'></i> Filter</button>";
							
							$html[] = "<div class='dropdown-menu'>";
								$html[] = "<div class='p-4'>";
								$html[] = "<div class='' style='width:350px;'>";
									$html[] = "<form id='filter-form'>";

										$html[] = "<div class='d-flex justify-content-between align-items-center'>";
											$html[] = "<h3>Filter Results</h3>";
											$html[] = "<a href='".url("ListingsController@index")."' class='text-decoration-none'><i class='ti ti-trash'></i> Clear filter</a>";
										$html[] = "</div>";
									
										$html[] = "<div class='mb-4'>";
											$html[] = "<div class='border p-3'>";
												$html[] = "<div class='form-label'>Address</div>";
												$html[] = $model->address;

												$html[] = "<div class='mb-3 street-input'>";
													$html[] = "<label class='form-label text-muted'>Street</label>";
													$html[] = "<input type='text' name='address[street]' id='address_street' value='' class='form-control' />";
												$html[] = "</div>";

												$html[] = "<div class='mb-3 village-input'>";
													$html[] = "<label class='form-label text-muted'>Village / Building</label>";
													$html[] = "<input type='text' name='address[village]' id='address_village' value='' class='form-control' />";
												$html[] = "</div>";

											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='mb-4'>";
											$html[] = "<div class='form-label'>Offer</div>";
											$html[] = "<select name='offer' id='offer' class='form-select'>";
												foreach(["for sale", "for rent"] as $offer) {
													$sel = isset($model->page['uri']['offer']) && $model->page['uri']['offer'] == $offer ? "selected" : "";
													$html[] = "<option value='".$offer."' $sel>".ucwords($offer)."</option>";
												}
											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class='mb-4'>";
											$html[] = "<div class='form-label'>Category</div>";
											$html[] = $model->categorySelection((isset($model->page['uri']['category']) ? $model->page['uri']['category'] : null));
										$html[] = "</div>";

										$html[] = "<div class='form-label'>Price</div>";
										$html[] = "<div class='mb-4'>";
											$html[] = "<select name='price' id='price' class='form-select'>";
												
												if(isset($model->page['uri']['offer']) && $model->page['uri']['offer'] == "for rent") {
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
													foreach(["0", "Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
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
														$bathroom = trim(str_replace(["Bathroom", "and more"],["",""], $room));
														$sel = isset($model->page['uri']['bathroom']) && $model->page['uri']['bathroom'] == $bathroom ? "selected" : "";
														$html[] = "<option value='".$bathroom."' $sel>$room</option>";
													}
												$html[] = "</select>";
											$html[] = "</div>";

											$html[] = "<div class='mb-4'>";
												$html[] = "<div class='form-label'>Garage</div>";
												$html[] = "<select name='parking' id='parking' class='form-select'>";
													$html[] = "<option value=''></option>";
													foreach(["1 Car Space", "2 Car Space", "3 Car Space", "4 Car Space", "5 Car Space", "6 and more Car Space"] as $space) {
														$parking = trim(str_replace(["Car Space", "and more"],["",""], $space));
														$sel = isset($model->page['uri']['parking']) && $model->page['uri']['parking'] == $parking ? "selected" : "";
														$html[] = "<option value='".$parking."' $sel>$space</option>";
													}
												$html[] = "</select>";
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
									
										$html[] = "<div class='btn-filter-container mt-5 sticky-bottom'>";
											$html[] = "<div class='pb-4' style='background-color: #f6f8fb; margin-bottom: -15px !important;'>";
												$html[] = "<span class='btn btn-primary w-100 btn-filter'><i class='ti ti-filter me-1'></i> Filter Result</span>";
											$html[] = "</div>";
										$html[] = "</div>";

									$html[] = "</form>";
								$html[] = "</div>";
								$html[] = "</div>";
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

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("ListingsController@listingIndex")."' />";
						$html[] = "<a href='".url("ListingsController@listingIndex")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['listings']) { $c=$model->page['starting_number'];
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th class='w-1'></th>";
									$html[] = "<th class='w-1'>Featured</th>";
									$html[] = "<th>Title</th>";
									$html[] = "<th>Type</th>";
									$html[] = "<th>Category</th>";
									$html[] = "<th>Address</th>";
									$html[] = "<th class='text-end'>Price</th>";
									$html[] = "<th>Status</th>";
									$html[] = "<th class='text-center'></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['listings']); $i++) { $c++;

								$availability = array(
									0 => "<span class='text-danger'>Deactivated</span>",
									1 => "<span class='text-success '>Available</span>",
									2 => "<span class='text-info'>Sold</span>",
									3 => "<span class='text-muted'>Removed</span>"
								);

								$address = $data['listings'][$i]['address'];
								unset($address['region']);
								
								$html[] = "<tr class='row_listings_".$data['listings'][$i]['listing_id']." listings-table'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><div class='avatar' data-thumb-image='".$data['listings'][$i]['thumb_img']."'></div></td>";
									$html[] = "<td class='align-middle text-center'><span class='btn-set-featured featured-indicator-container cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ListingsController@setFeatured",["id" => $data['listings'][$i]['listing_id']])."'>";
										
										$html[] = ($data['listings'][$i]['featured'] == 1) ? 
											"<svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 22 22'  fill='Orange'  class='icon icon-tabler icons-tabler-filled icon-tabler-star'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z' /></svg>"
											: "<i class='ti ti-star text-muted'></i>";

									$html[] = "</span></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['title']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['type']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['category']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'>".(implode(" ",$address))."</a></td>";
									$html[] = "<td class='align-middle text-end'><a href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'>".convertMillions($data['listings'][$i]['price'])."</a></td>";
									$html[] = "<td class='align-middle'>".($availability[$data['listings'][$i]['status']])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary btn-md' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("ListingsController@edit",[ "id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-edit me-2'></i> Update Listing</a>";
												$html[] = "<span class='dropdown-item btn-set-featured cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ListingsController@setFeatured",["id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-rubber-stamp me-2'></i> Featured Settings</span>";
												$html[] = "<span class='dropdown-item btn-sold cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ListingsController@soldSettings",["id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-currency-peso me-2'></i> Sold Settings</span>";
												if(isset($_SESSION['user_logged']['permissions']['properties']['delete'])) {
													$html[] = "<span class='dropdown-item text-light bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ListingsController@remove",["id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-x me-2'></i> Remove</span>";
												}
											$html[] = "</div>";
											
										$html[] = "</div>";
									
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<div class=''>";
                            $html[] = "<div class='empty'>";
                                $html[] = "<div class='empty-image mb-4'>";
                                    $html[] = "<img src='".CDN."images/undraw_quitting_time_dm8t.svg' height='128' />";
                                $html[] = "</div>";
                                $html[] = "<p class='empty-title'>No results found</p>";
                                $html[] = "<p class='empty-subtitle text-secondary'>Try adjusting your search or filter to find what you're looking for.</p>";
                            $html[] = "</div>";
                        $html[] = "</div>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";