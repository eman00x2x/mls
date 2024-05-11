<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row justify-content-center'>";
			$html[] = "<div class='col-lg-6 col-md-8 col-sm-12 col-12'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i>MLS Market Comparison </h1>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
			$html[] = "<div class='col-lg-6 col-md-8 col-sm-12 col-12'>";
				
				$html[] = "<div class='card'>";
					$html[] = "<div class='card-body'>";

						$html[] = "<form id='filter-form'>";
							$html[] = "<p class='text-muted fst-italic'>The market comparison results include listings posted in your MLS Regional Board, MLS Local Board, and the MLS National</p>";

							$html[] = "<div class='row'>";

								$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
										$html[] = "<span class='fs-12 form-label'>Offer</span>";
										$html[] = "<select name='offer' id='offer' class='form-select'>";
											foreach(["for sale", "for rent"] as $offer) {
												$html[] = "<option value='offer'>".ucwords($offer)."</option>";
											}
										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
										$html[] = "<span class='fs-12 form-label'>Categories</span>";
										$html[] = $data['categories'];
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
								    $html[] = "<div class='mb-3'>";
										$html[] = "<div class='fs-12 form-label'>Bedroom</div>";
										$html[] = "<select name='bedroom' id='bedroom' class='form-select'>";
											$html[] = "<option value=''></option>";
											foreach(["Studio", "1 Bedroom", "2 Bedroom", "3 Bedroom", "4 Bedroom", "5 Bedroom", "6 and more Bedroom"] as $room) {
												$bedroom_val = trim(str_replace(["Bedroom", "and more"],["",""], $room));
												$html[] = "<option value='".$bedroom_val."'>$room</option>";
											}

										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
										$html[] = "<div class='fs-12 form-label'>Bathroom</div>";
										$html[] = "<select name='bathroom' id='bathroom' class='form-select'>";
											$html[] = "<option value=''></option>";
											foreach(["1 Bathroom", "2 Bathroom", "3 Bathroom", "4 Bathroom", "5 Bathroom", "6 and more Bathroom"] as $room) {
												$bathroom = trim(str_replace(["Bathroom", "and more"],["",""], $room));
												$html[] = "<option value='".$bathroom."'>$room</option>";
											}
										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
										$html[] = "<div class='fs-12 form-label'>Garage</div>";
										$html[] = "<select name='parking' id='parking' class='form-select'>";
											$html[] = "<option value=''></option>";
											foreach(["1 Car Space", "2 Car Space", "3 Car Space", "4 Car Space", "5 Car Space", "6 and more Car Space"] as $space) {
												$parking = trim(str_replace(["Car Space", "and more"],["",""], $space));
												$html[] = "<option value='".$parking."'>$space</option>";
											}
										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
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
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
								    $html[] = "<div class='mb-3'>";
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
								$html[] = "</div>";

								$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
									$html[] = "<div class='mb-3'>";
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

							$html[] = "<div class='d-flex gap-3 flex-wrap'>";

								$html[] = "<div class='flex-fill mb-3'>";
									$html[] = "<span class='fs-12 form-label'>Features & Amenities</span>";
									$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
										foreach($data['amenities'] as $amenities) {
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

							$html[] = "</div>";

							$html[] = "<div class='btn-filter-container'>";
								$html[] = "<div class=''>";
									$html[] = "<span class='btn btn-primary w-100 btn-filter'><i class='ti ti-filter me-1'></i> Compare Market</span>";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</form>";
						
						/* $html[] = "<div class='row g-3'>";
							$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<label class='fw-bold text-muted mb-1'>Address</label>";
									$html[] = $data['address'];
								$html[] = "</div>";

							$html[] = "</div>";
							$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<label class='fw-bold text-muted mb-1'>Offer</label>";
									$html[] = "<input type='text' name='offer' id='offer' value='' class='form-control' />";
								$html[] = "</div>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<label class='fw-bold text-muted mb-1'>Offer</label>";
									$html[] = "<input type='text' name='offer' id='offer' value='' class='form-control' />";
								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</div>"; */

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";