<?php

$html[] = "<div class=''>";

	$html[] = "<div class='hero-image bg-azure border-bottom'>";
		$html[] = "<div class='bg-big' style='background-image: url(".CDN."images/website/4787302162.jpg);'>";

			$html[] = "<div class='hero-image-mask'></div>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='navbar navbar-expand-md d-print-none navbar-transparent navbar-home fs-16'>";
					$html[] = "<button class='navbar-toggler  text-white' type='button' data-bs-toggle='collapse' data-bs-target='#navbar-menu' aria-controls='navbar-menu' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>";
					$html[] = "<h1 class='navbar-brand d-none-navbar-horizontal pe-0 pe-md-3'>";
						$html[] = "<a href='".WEBDOMAIN."' class=' text-white text-decoration-none'>";
							$html[] = "<img src='".CDN."images/logo.png' width='50' class='navbar-brand-image'> PAREB MLS";
						$html[] = "</a>";
					$html[] = "</h1>";

					$html[] = "<div class='navbar-nav flex-row order-md-last'>";
						$html[] = "<div class='nav-item'>";
							$html[] = "<div class='btn-list'>";
								$html[] = "<a href='".MANAGE."' class='btn btn-outline-light border-0 p-0 ' target='_blank' rel='noreferrer'><i class='ti ti-lock me-1'></i> Login</a>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='collapse navbar-collapse' id='navbar-menu'>";
						$html[] = "<div class='d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center'>";
							$html[] = "<ul class='navbar-nav'>";
								$html[] = "<li class='nav-item fw-bold'>";

									$html[] = "<div class='dropdown'>";
										$html[] = "<span class='nav-link text-white dropdown-toggle cursor-pointer' id='menuForBuyProperty' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Buy Property</span></span>";
										$html[] = "<div class='dropdown-menu' aria-labelledby='menuForBuyProperty'>";
											foreach([
												"House and Lot", "Towhouse", "Condominium", "Residential Lot", "Commercial Lot"
											] as $category) {
												$html[] = "<a class='dropdown-item ' href='".url('ListingsController@buy', null, [ "category" => $category ])."' >Buy $category</a>";
											}
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</li>";
								$html[] = "<li class='nav-item fw-bold'>";

									$html[] = "<div class='dropdown'>";
										$html[] = "<span class='nav-link text-white dropdown-toggle cursor-pointer' id='menuForRentProperty' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Rent Property</span></span>";
										$html[] = "<div class='dropdown-menu' aria-labelledby='menuForRentProperty'>";
											foreach([
												"House and Lot", "Towhouse", "Condominium", "Residential Lot", "Commercial Lot"
											] as $category) {
												$html[] = "<a class='dropdown-item  ' href='".url('ListingsController@rent', null, [ "category" => $category ])."' >Rent $category</a>";
											}
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</li>";

								$html[] = "<li class='nav-item fw-bold'>";

									$html[] = "<div class='dropdown'>";
										$html[] = "<span class='nav-link text-white dropdown-toggle cursor-pointer' id='menuForPopularLocation' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Popular Locations</span></span>";
										$html[] = "<div class='dropdown-menu locationContainer' aria-labelledby='menuForPopularLocation'>";
											
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</li>";

								$html[] = "<li class='nav-item'>";
									$html[] = "<a class='nav-link text-white' href='".url("AccountsController@memberDirectory")."'>Find a Real Estate Broker</a>";
								$html[] = "</li>";

							$html[] = "</ul>";
						$html[] = "</div>";
					$html[] = "</div>";
					
				$html[] = "</div>";

				$html[] = "<div class='row justify-content-center'>";
					$html[] = "<div class='col-md-8 col-auto'>";

						$html[] = "<div class='px-3'>";
							$html[] = "<form id='filter-form' action='' method='POST'>";

								$html[] = "<input type='hidden' name='address[barangay]' id='barangay' value='' />";
								$html[] = "<input type='hidden' name='address[municipality]' id='municipality' value='' />";
								$html[] = "<input type='hidden' name='address[province]' id='province' value='' />";
								$html[] = "<input type='hidden' name='address[region]' id='region' value='' />";
								
								$html[] = "<div class='search-filter'>";
									
									/** SPACER */
									$html[] = "<div class='mt-5 pt-5'></div>";
									$html[] = "<div class='mt-5 pt-5 d-md-block d-none'></div>";
									$html[] = "<div class='mt-5 pt-5 d-lg-block d-none'></div>";
									/** SPACER */

									$html[] = "<div class=''>";
										$html[] = "<h1 class='d-inline display-4 text-white fw-bold'>Multiple Listing Service</h1>";
										$html[] = "<p class='d-block fs-16 text-white'>By Philippine Association of Real Estate Board (PAREB)</p>";
									$html[] = "</div>";

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
													$html[] = "<input type='text' id='address' value='' list='address_result' placeholder='Select desired location' class='form-control border-0' />";
													$html[] = "<datalist id='address_result'></datalist>";
													$html[] = "<label for='category'>Select Location</label>";
												$html[] = "</div>";
											$html[] = "</div>";
											$html[] = "<div class='bg-white'>";
												$html[] = "<div class='cursor-pointer btn-toggle-filter-box' style='padding: 1.1rem 1.1rem 1.09rem 1.1rem'>";
													$html[] = "<span class=''><i class='ti ti-adjustments-horizontal'></i></span>";
												$html[] = "</div>";
											$html[] = "</div>";
											$html[] = "<div class='d-none d-md-block'>";
												$html[] = "<span class='btn btn-primary btn-filter border-0 rounded-0 ' type='button' style='padding: 1.19rem 1.19rem 1.18rem 1.19rem;'><i class='ti ti-search me-2'></i> Search</span>";
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
													foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "5001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
														
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
													foreach(["0 - Below 100sqm", "101sqm - 200sqm", "201sqm - 300sqm", "301sqm - 400sqm", "401sqm - 500sqm", "501sqm - 1000sqm", "1001sqm - 2000sqm", "2001sqm - 5000sqm", "5001sqm - 10000sqm", "10001sqm and above - 00",] as $range) {
														
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
													$html[] = "<input type='checkbox' name='foreclosed' id='foreclosed'  value='1' class='form-check-input'>";
													$html[] = "<span class='form-check-label form-check-label-on'>Yes</span>";
													$html[] = "<span class='form-check-label form-check-label-off'>No</span>";
												$html[] = "</label>";
												$html[] = "<div class='small text-secondary'>If Yes, results will include foreclosure properties</div>";
											$html[] = "</div>";

										$html[] = "</div>";

										$html[] = "<div class='text-center mt-5  d-sm-block d-md-none inner-filter'>";
											$html[] = "<span class='btn btn-primary w-100 border-0 btn-filter' type='button'><i class='ti ti-search me-2'></i> Search</span>";
										$html[] = "</div>";
										
									$html[] = "</div>";

								$html[] = "</div>";
							$html[] = "</form>";

							$html[] = "<div class='text-center mt-3 d-sm-block d-md-none outer-filter'>";
								$html[] = "<span class='btn btn-primary w-100 border-0 btn-filter' type='button'><i class='ti ti-search me-2'></i> Search</span>";
							$html[] = "</div>";

						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl'>";
			$html[] = "<div class='mb-3 py-5 px-3 fs-16'>";

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

	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='my-3 py-5 px-3'>";
			$html[] = "<div class='latest-post-container'>";
				$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading recent properties, please wait...</p>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl py-5'>";
			$html[] = "<div class='py-5 px-3  fs-16'>";
				$html[] = "<div class='open-houses-container'>";
					$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading open houses, please wait...</p>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
				
	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl'>";
			$html[] = "<div class='py-5 px-3 fs-16'>";
				
				$html[] = "<div class='row justify-content-center my-5 py-5'>";
					$html[] = "<div class='col-lg-10 col-md-10 col-sm-12'>";

					$html[] = "<h2 class='display-3 text-blue'>About</h2>";
						$html[] = "<div class='d-flex gap-3 flex-wrap flex-lg-nowrap'>";

							$html[] = "<div class='flex-fill order-md-last mb-4'>";
								$html[] = "<img src='".CDN."images/150ceddb-4707-47e6-8009-940522ba403f.png' class='' style='width:1024px;' />";
							$html[] = "</div>";

							$html[] = "<div class='flex-fill'>";
								$html[] = "<h3>Unified Excellence <span class='d-block fw-normal fs-14'>PAREB's Nationwide Network of Real Estate Specialists</span></h3>";
								$html[] = "<p>PAREB is a non-profit organization comprising professional real estate practitioners, including consultants, appraisers, assessors, brokers, and salespersons across all 18 regions of the Philippines. Our members specialize in residential, commercial brokerage, and project selling</p>";
							$html[] = "</div>";

							$html[] = "<div class='flex-fill'>";
								$html[] = "<h3>Elevating Ethical Standards <small class='d-block fw-normal fs-14'>PAREB's Commitment to Protecting Real Estate Integrity</small></h3>";
								$html[] = "<p>PAREB champions the highest ethical conduct and standards of practice among its members. Through regular conventions, conferences, and forums, it equips and enhances the skills and knowledge of its members, advancing and protecting the interests of property owners and buyers. Additionally, PAREB collaborates as a leading partner with government regulators and policymakers to establish an environment and legal framework that safeguards the integrity of real estate transactions</p>";
							$html[] = "</div>";
							
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='my-3 py-5 px-3'>";
			$html[] = "<div class='join-container py-5 my-5 text-center fs-16'>";

				$html[] = "<div class=''>";
					$html[] = "<h2 class='mb-0 display-5 text-blue'>Elevate Your Real Estate Experience</h2>";
					$html[] = "<p>The Edge of Collaborating with a PAREB Broker</p>";
				$html[] = "</div>";

				$html[] = "<div class='row g-5 my-5'>";
					$html[] = "<div class='col-lg-6 col-md-3 col-sm-6 col-12'>";

						$html[] = "<div class='text-center'>";
							$html[] = "<span class='avatar avatar-xxl rounded-circle' style='background-image: url(".CDN."images/website/pexels-photo-3182806.webp)'></span>";
							$html[] = "<h3 class='mt-3'>Strength in Unity</h3>";
							$html[] = "<p>PAREB Network proudly spearheads the Philippine real estate arena, commanding a robust presence through its 68 Local Member Boards. With a collective force of 5,000 skilled practitioners, PAREB Network stands as a cornerstone of excellence and integrity in the industry, driving forward innovation and shaping the future landscape of real estate across the nation</p>";
						$html[] = "</div>";

					$html[] = "</div>";

					$html[] = "<div class='col-lg-6 col-md-3 col-sm-6 col-12'>";
						$html[] = "<div class='text-center'>";
							$html[] = "<span class='avatar avatar-xxl rounded-circle' style='background-image: url(".CDN."images/website/pexels-photo-5668517.webp)'></span>";
							$html[] = "<h3 class='mt-3'>Empowering Excellence</h3>";
							$html[] = "<p>PAREB brokers excel in specialized knowledge and skills, gathering comprehensive market data from both reference materials and the PAREB Network. Our members, licensed as appraisers, consultants, CPAs, lawyers, and engineers, enhance our collective expertise. Committed to client support, we prioritize knowledge-sharing and offer valuable guidance</p>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='col-lg-6 col-md-3 col-sm-6 col-12'>";
						$html[] = "<div class='text-center'>";
							$html[] = "<span class='avatar avatar-xxl rounded-circle' style='background-image: url(".CDN."images/website/document-agreement-documents-sign-48195.webp)'></span>";
							$html[] = "<h3 class='mt-3'>Simplify and Amplify</h3>";
							$html[] = "<p>To streamline the process, rather than seeking out 10 individual brokers, the seller only needs to engage one PAREB broker, who will then ensure the property's distribution throughout the extensive PAREB Network</p>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='col-lg-6 col-md-3 col-sm-6 col-12'>";
						$html[] = "<div class='text-center'>";
							$html[] = "<span class='avatar avatar-xxl rounded-circle' style='background-image: url(".CDN."images/website/pexels-photo-6347705.webp)'></span>";
							$html[] = "<h3 class='mt-3'>Expanding Horizons</h3>";
							$html[] = "<p>A typical broker usually has a limited inventory. If a buyer has specifications that a broker doesn’t carry, the broker will exert further effort to search for other properties within the PAREB network</p>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
	
	$html[] = "<div class='bg-white'>";
		$html[] = "<div class='container-xl py-5'>";
			$html[] = "<div class='my-3 py-5 px-3  fs-16'>";
				$html[] = "<div class='latest-articles-container'>";
					$html[] = "<p class='text-center mb-0'><img src='".CDN."images/loader.gif' /> loading articles, please wait...</p>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";