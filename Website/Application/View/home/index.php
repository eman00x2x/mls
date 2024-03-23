<?php

$html[] = "<div class=''>";

	$html[] = "<div class='hero-image bg-azure border-bottom'>";
		$html[] = "<div class='bg-big' style='background-image: url(".CDN."images/website/4787302162.jpg);'>";
			$html[] = "<div class='hero-image-mask'></div>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row justify-content-center'>";
					$html[] = "<div class='col-md-8 col-auto'>";

						$html[] = "<form id='filter-form' action='' method='POST'>";
							$html[] = "<div class='search-filter'>";
								
								/** SPACER */
								$html[] = "<div class='mt-5 pt-5'></div>";
								$html[] = "<div class='mt-5 pt-5 d-md-block d-none'></div>";
								$html[] = "<div class='mt-5 pt-5 d-lg-block d-none'></div>";
								/** SPACER */

								$html[] = "<h1 class='display-4 text-white fw-bold'>Find the best investment! <span class='d-block fs-16 '>Only @ PAREB MLS</span></h1>";
								
								$html[] = "<div class=''>";
									$html[] = "<div class='btn-group bg-white rounded-0'>";
										$html[] = "<input type='radio' class='btn-check ' name='offer' id='offer-1' autocomplete='off' checked >";
										$html[] = "<label for='offer-1' type='button' class='btn btn-outline-primary border-0 rounded-0' style='width:150px;'>Buy</label>";
										$html[] = "<input type='radio' class='btn-check ' name='offer' id='offer-2' autocomplete='off'  >";
										$html[] = "<label for='offer-2' type='button' class='btn btn-outline-primary border-0 rounded-0' style='width:150px;'>Rent</label>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class=''>";

									$html[] = "<div class='d-flex justify-content-between align-items-center flex-wrap '>";
										$html[] = "<div class='flex-lg-grow-0 flex-grow-1 '>";
											$html[] = "<div class='form-floating rounded-0 border-0' >";
												$html[] = $model['listings']->categorySelection();
												$html[] = "<label for='category'>Category</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='flex-fill'>";
											$html[] = "<div class='form-floating border-0 rounded-0'>";
												$html[] = "<input type='text' name='address' id='location' value='' placeholder='Select desired location' class='form-control border-0' />";
												$html[] = "<label for='category'>Select Location</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='bg-white'>";
											$html[] = "<div class='cursor-pointer btn-toggle-filter-box' style='padding: 1.1rem 1.1rem 1.09rem 1.1rem'>";
												$html[] = "<span class=''><i class='ti ti-adjustments-horizontal'></i></span>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='d-none d-md-block'>";
											$html[] = "<span class='btn btn-danger btn-filter border-0 rounded-0 ' type='button' style='padding: 1.19rem 1.19rem 1.18rem 1.19rem;'><i class='ti ti-search me-2'></i> Search</span>";
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</div>";

							$html[] = "</div>";

							$html[] = "<div class='filter-container bg-blue-lt p-4 border d-none text-dark'>";
								$html[] = "<div class='float-end'>";
									$html[] = "<button type='button' class='btn-close' aria-label='Close'></button>";
								$html[] = "</div>";
								$html[] = "<h3>Filter</h3>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='d-flex gap-3 flex-wrap '>";
										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Bedroom</div>";
											$html[] = "<select name='bedroom' id='bedroom' class='form-select'>";
												$html[] = "<option value=''></option>";
												foreach(["Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
													$bedroom_val = trim(str_replace(["Bedroom", "and more"],["",""], $room));
													$html[] = "<option value='".$bedroom_val."'>$room</option>";
												}

											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Bathroom</div>";
											$html[] = "<select name='bathroom' id='bathroom' class='form-select'>";
												$html[] = "<option value=''></option>";
												foreach(["1 Bathroom", "2 Bathroom", "3 Bathroom", "4 Bathroom", "5 Bathroom", "6 and more Bathroom"] as $room) {
													$bathroom = trim(str_replace(["Bathroom", "and more"],["",""], $room));
													$html[] = "<option value='".$bathroom."'>$room</option>";
												}
											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Garage</div>";
											$html[] = "<select name='parking' id='parking' class='form-select'>";
												$html[] = "<option value=''></option>";
												foreach(["1 Car Space", "2 Car Space", "3 Car Space", "4 Car Space", "5 Car Space", "6 and more Car Space"] as $space) {
													$parking = trim(str_replace(["Car Space", "and more"],["",""], $space));
													$html[] = "<option value='".$parking."'>$space</option>";
												}
											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Land Area</div>";
											$html[] = "<select name='lot_area' id='lot_area' class='form-select'>";
												$html[] = "<option value=''></option>";
												foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
													
													$land_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
													
													$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
													$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)."sqm");
													$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)."sqm");

													$html[] = "<option value='".$land_area."' >".$r1." - ".$r2."</option>";
												}
											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Floor Area</div>";
											$html[] = "<select name='floor_area' id='floor_area' class='form-select'>";
												$html[] = "<option value=''></option>";
												foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "50001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
													
													$floor_area = trim(str_replace(["Below", "and above", "sqm", " "],["","", "", ""], $range));
													
													$area = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));
													$r1 = ($area[0] == 0 ? "Below" : number_format($area[0],0)." sqm");
													$r2 = ($area[1] == "00" ? "above " : number_format($area[1],0)." sqm");
													$html[] = "<option value='".$floor_area."'>".$r1." - ".$r2."</option>";
												}

											$html[] = "</select>";
										$html[] = "</div>";

										$html[] = "<div class=''>";
											$html[] = "<div class='fs-12 form-label'>Price</div>";
											$html[] = "<select name='price' id='price' class='form-select'>";
												
												/* if($model->page['uri']['offer'] == "for rent") {
													$price_range = explode(",", "0 - Below 10000, 10000 - 20000, 20001 - 40000, 40001 - 60000, 60001 - 100000, 100001 - 1000000, 1000001 and above - 00");
												}else { */
													$price_range = explode(",", "0 - Below 1000000, 1000001 - 3000000, 3000001 - 6000000, 6000001 - 10000000, 10000001 - 15000000, 15000001 - 25000000, 25000001 - 35000000, 35000001 - 45000000, 45000001 - 50000000, 50000001 - 80000000, 80000001 - 100000000, 100000001 - 120000000, 120000001 - 140000000, 140000001 - 160000000, 160000001 - 180000000, 180000001 - 200000000, 200000001 - 230000000, 230000001 - 260000000, 260000001 - 290000000, 310000001 - 350000000, 350000001 and above - 00");
												/* } */
											
												$html[] = "<option value=''></option>";
												foreach($price_range as $range) {

													$price_val = trim(str_replace(["Below", "and above", " "],["","", ""], $range));
													
													$price = explode(" - ", str_replace(["sqm", "Below", "and above"],"", $range));

													$r1 = ($price[0] == "0" ? "Below" : "&#8369;".number_format($price[0],0)." - ");
													$r2 = ($price[1] == "00" ? "and above " : "&#8369;".number_format($price[1],0)."");

													$html[] = "<option value='".$price_val."'>".$r1." ".$r2."</option>";
												}
											$html[] = "</select>";
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</div>";

								$html[] = "<div class=''>";
									$html[] = "<div class='d-flex gap-1 flex-wrap'>";

										$html[] = "<div class='flex-fill mb-3'>";
											$html[] = "<span class='fs-12 form-label'>Features & Amenities</span>";
											$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
												foreach($model['listings']->amenities() as $amenities) {
													$html[] = "<label class='form-check cursor-pointer'>";
														$html[] = "<input type='checkbox' class='form-check-input' name='amenities[]' value='$amenities' />";
														$html[] = "<span class='form-check-label'>$amenities</span>";
													$html[] = "</label>";
												}
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='flex-fill mb-3'>";
											$html[] = "<span class='fs-12 form-label'>Tags</span>";
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

										$html[] = "<div class='mb-3 m-auto'>";
											$html[] = "<span class='fs-12 form-label'>Include Foreclosure Property?</span>";
											$html[] = "<label class='form-check form-switch cursor-pointer'>";
												$html[] = "<input class='form-check-input' type='checkbox' value='0'>";
												$html[] = "<span class='form-check-label form-check-label-on'>On</span>";
												$html[] = "<span class='form-check-label form-check-label-off'>Off</span>";
											$html[] = "</label>";
											$html[] = "<div class='small text-secondary'>If On, results will include foreclosure properties</div>";
										$html[] = "</div>";

									$html[] = "</div>";

									$html[] = "<div class='text-center mt-5  d-sm-block d-md-none inner-filter'>";
										$html[] = "<span class='btn btn-danger w-100 border-0 btn-filter' type='button'><i class='ti ti-search me-2'></i> Search</span>";
									$html[] = "</div>";
									
								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</form>";

						$html[] = "<div class='text-center mt-3 d-sm-block d-md-none outer-filter'>";
							$html[] = "<span class='btn btn-danger w-100 border-0 btn-filter' type='button'><i class='ti ti-search me-2'></i> Search</span>";
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl'>";
			$html[] = "<div class='mb-3 py-5 px-3'>";

				$html[] = "<div class='popular-location-container text-center'>";
					$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading popular locations, please wait...</p>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";


	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='my-3 py-5 px-3'>";
			$html[] = "<div class='featured-post-container'>";
				$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading featured properties, please wait...</p>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
				
	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl'>";
			$html[] = "<div class='my-3 py-5 px-3'>";
				$html[] = "<h2>About</h2>";
				$html[] = "<div class=''>";
					$html[] = "<img src='".CDN."images/item_default.jpg' class='float-start me-2' style='width:200px;' />";
					$html[] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum volutpat nunc, ut malesuada magna pellentesque sollicitudin. In ut nisl finibus augue luctus dictum. Nulla et tincidunt nunc. Sed aliquam rhoncus interdum. Vivamus convallis lectus et enim rhoncus tempor. Vestibulum cursus porttitor massa nec consectetur. Sed in est porttitor lacus interdum interdum vitae a nulla.</p>";
					$html[] = "<p>Fusce lobortis, risus et consectetur rhoncus, turpis turpis interdum mi, et lobortis magna enim ut tortor. Proin finibus fringilla placerat. Fusce laoreet lacus est, sed vulputate justo hendrerit quis. Donec at ipsum ipsum. Vivamus eget varius metus. Ut semper dapibus augue nec gravida. Nam suscipit nibh urna, elementum malesuada neque semper posuere. Quisque viverra egestas felis at pulvinar. Fusce laoreet ipsum ut porttitor consequat. Proin tempor massa vel enim interdum consequat. Phasellus tempus arcu quis nibh finibus semper.</p>";
					$html[] = "<p>Proin maximus, lacus ac ultrices maximus, velit elit auctor mauris, eu convallis metus velit id tellus. Sed interdum diam ligula, et blandit risus feugiat eu. Cras diam nulla, condimentum in neque a, consequat sagittis eros. Praesent mollis iaculis nisl accumsan aliquam. Fusce a turpis nisi. Duis semper accumsan dolor a elementum. Nullam ac ultrices eros. Sed semper, massa quis vulputate convallis, tellus libero porta odio, vel placerat arcu purus et sem. Curabitur iaculis erat vitae arcu suscipit, sit amet pellentesque purus euismod. Quisque in vestibulum tellus. Pellentesque feugiat nulla sit amet sapien sollicitudin vehicula. Proin eu lacus sodales, porta risus in, semper felis. Nam ante nibh, tincidunt eget malesuada in, sodales ut nibh.</p>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='my-3 py-5 px-3'>";
			$html[] = "<div class='latest-articles-container'>";
				$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading articles, please wait...</p>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";