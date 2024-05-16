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
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class=''>";
					$html[] = "<div class='btn-list'>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@handshakedIndex")."'><i class='ti ti-heart-handshake me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark btn-compare-table' data-url='".url("MlsController@comparePreview")."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd'><i class='ti ti-layers-difference me-2'></i> Compare Table</span>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@downloadPDFFormat", ["id" => $data['listing']['listing_id']])."'><i class='ti ti-download me-2'></i> Download</a>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	
	$html[] = "<div class='container-xl bg-white border'>";
		$html[] = "<div class='py-5 mt-3'>";
			$html[] = "<div class='row gap-2 justify-content-center'>";

				if($data['listing']['offer'] != "looking for") {
					$html[] = "<div class='col-sm-6 col-md-5 col-lg-5'>";

						$html[] = "<div id='photos' class='px-2'>";

							if($data['listing']['thumb_img'] != "") {
								$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-image: url(".$data['listing']['thumb_img'].")'>";
									$html[] = "<span style='position: absolute; top:-1px; left: -1px;' class='fw-bold bg-white text-dark p-2'><i class='ti ti-photo'></i> +".count($data['listing']['images'])."</span>";
									$html[] = "<a data-fslightbox data-type='image' href='".$data['listing']['thumb_img']."' class='stretched-link'></a>";
								$html[] = "</div>";
							}else {
								$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-color:#FFF; background-image: url(".CDN."images/item_default.jpg); background-size: auto;'>";
								$html[] = "</div>";
							}
							
							$html[] = "<div class='mb-3'>";
								if($data['listing']['images']) {
									$html[] = "<div class='d-flex gap-2 justify-content-center overflow-auto'>";

									$limit = 6;
									if($data['listing']['video'] != "") {
										$video_id = str_replace("https://www.youtube.com/watch?v=", "", $data['listing']['video']);
										$html[] = "<div><a data-fslightbox href='".$data['listing']['video']."' id='youtube_video'>";
											$html[] = "<div class='avatar avatar-xl p-2 bg-white-lt' style='background-image: url(http://img.youtube.com/vi/$video_id/sddefault.jpg)'><i class='ti ti-brand-youtube me-1 fs-36'></i></div>";
										$html[] = "</a></div>";
										$limit = 5;
									}

									$total_image = count($data['listing']['images']);

									for($i=0; $i<$total_image; $i++) {
										if($i < $limit) { $hide = "";

											if($i > ($limit - 3)) {
												$hide = "d-none d-md-block";
											}
											
											$html[] = "<div class='$hide'><a data-fslightbox data-type='image' href='".$data['listing']['images'][$i]['url']."'>";
												$html[] = "<div class='avatar avatar-xl' style='position:relative; background-image: url(".$data['listing']['images'][$i]['url'].")'>";
													
													if($i == ($limit - 3)) {
														if(($total_image - 3) > $i) {
															$html[] = "<div class='overlay d-md-none d-sm-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
																$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".($total_image - ($limit - 1))."</span>";
															$html[] = "</div>";
														}
													}
												
													if($i == ($limit - 1)) {
														if(($total_image - 1) > $i) {
															$html[] = "<div class='overlay d-none d-md-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
																$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".($total_image - $limit)."</span>";
															$html[] = "</div>";
														}
													}

												$html[] = "</div>";
											$html[] = "</a></div>";
											
										}else {
											$html[] = "<a data-fslightbox data-type='image' class='d-none' href='".$data['listing']['images'][$i]['url']."'></a>";
										}
									}
									$html[] = "</div>";
								}
							$html[] = "</div>";
						$html[] = "</div>";

					$html[] = "</div>";
				}
				$html[] = "<div class='col-sm-6 col-md-6 col-lg-4'>";
					
					$html[] = "<div class='px-2'>";

						$html[] = "<div class='d-flex justify-content-between'>";
							$html[] = "<span class='d-block text-muted fs-12 mb-2'><i class='ti ti-calendar'></i> Posted since ";
								$html[] = date("d M Y", $data['listing']['created_at']);
							$html[] = "</span>";

							$html[] = "<span class='d-block text-muted fs-12 mb-2'><i class='ti ti-calendar'></i> Modified at ";
								$html[] = date("d M Y", $data['listing']['modified_at']);
							$html[] = "</span>";
						$html[] = "</div>";

						$offer = [
							"for sale" => "<span class='text-primary'>For Sale</span>",
							"for rent" => "<span class='text-yellow'>For Rent</span>",
							"looking for" => "<span class='text-orange'>Looking For</span>"
						];

						$html[] = "<div class='mb-4'>";
							$html[] = "<h1>".$offer[$data['listing']['offer']]." ".$data['listing']['title']."</h1>";
							$html[] = "<p><i class='ti ti-map-pin'></i> ".$data['listing']['address']['barangay']." ".$data['listing']['address']['municipality']." ".$data['listing']['address']['province']."</p>";
							$html[] = "<p class='display-5 fw-bold text-highlight'>&#8369;".number_format($data['listing']['price'], 0)."</p>";
							$html[] = "<p class='fs-16'><span><i class='ti ti-category'></i> ".$data['listing']['category']."</span></p>";

							$html[] = "<div class='mb-3 d-flex gap-5 align-items-center'>";

								if($data['listing']['lot_area'] > 0) {
									$html[] = "<div class='fs-24 fw-bold'>";
										$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Land Area:</small>";
										$html[] = "<span><i class='ti ti-maximize'></i> ".$data['listing']['lot_area']."sqm</span>";
									$html[] = "</div>";
								}

								if($data['listing']['floor_area'] > 0) {
									$html[] = "<div class='fs-24 fw-bold'>";
										$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Floor Area:</small>";
										$html[] = "<span><i class='ti ti-maximize'></i> ".$data['listing']['floor_area']."sqm</span>";
									$html[] = "</div>";
								}
							$html[] = "</div>";

							$html[] = "<div class='mb-3 d-flex gap-5 align-items-center'>";
								if($data['listing']['bedroom'] != "" && $data['listing']['bedroom'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-bed'></i> ".$data['listing']['bedroom']."<span class='d-block fw-normal text-muted fs-12'>Bedroom</span></div>"; }
								if($data['listing']['bathroom'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-bath'></i> ".$data['listing']['bathroom']."<span class='d-block fw-normal text-muted fs-12'>Bathroom</span></div>"; }
								if($data['listing']['parking'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-car-garage'></i> ".$data['listing']['parking']."<span class='d-block fw-normal text-muted fs-12'>Car Space</span></div>"; }
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {
		$html[] = "<div class='container-xl px-0 handshake-container'>";
			$html[] = "<div class='card-title mb-2 mt-5'><i class='ti ti-heart-handshake me-1'></i> Handshake Details</div>";
			$html[] = "<div class='d-flex gap-2 align-items-stretch justify-content-center'>";
				$html[] = "<div class='card flex-fill'>";
					$html[] = "<div class='card-body'>";
						
						$html[] = "<div class='card-title'><i class='ti ti-user me-1'></i> Requestor</div>";
						$html[] = "<div class='mb-3'>";
							$html[] = "<div class='d-flex lh-1 text-reset p-0 btn-view-profile' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountsController@profilePreview", ["id" => $data['handshake']['requestor_details']['account_id']])."'>";
								$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['handshake']['requestor_details']['logo'].")'></span>";
								$html[] = "<div class='ms-2'>";
									$html[] = "<div class='fw-bold'>".$data['handshake']['requestor_details']['account_name']['prefix']." ".$data['handshake']['requestor_details']['account_name']['firstname']." ".$data['handshake']['requestor_details']['account_name']['lastname']." ".$data['handshake']['requestor_details']['account_name']['suffix']."</div>";
									$html[] = "<div class='mt-1 small'>".$data['handshake']['requestor_details']['profession']."</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-device-mobile me-1'></i> Mobile:</span> <strong>".$data['handshake']['requestor_details']['mobile_number']."</strong></div>";
						$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-mail me-1'></i> Email:</span> <strong>".$data['handshake']['requestor_details']['email']."</strong></div>";
						
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='card flex-fill'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<div class='card-title'><i class='ti ti-heart-handshake me-1'></i> Handshake Status</div>";
						$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-status-change me-1'></i> Status:</span> <strong>".ucwords($data['handshake']['handshake_status'])."</strong></div>";
						$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Status Date:</span> <strong>".date("F d, Y", $data['handshake']['handshake_status_at'])."</strong></div>";
					$html[] = "</div>";
					
					if($_SESSION['user_logged']['account_id'] != $data['handshake']['requestor_account_id']) {
						$html[] = "<div class='text-center d-md-block d-none mb-3'>";
							$html[] = "<span class='btn btn-md btn-danger ms-1 mb-2 btn-cancel-handshake row_listings_".$data['listing']['listing_id']."' data-row='row_listings_".$data['listing']['listing_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
						$html[] = "</div>";
					}

				$html[] = "</div>";

				if($data['handshake']['handshake_status'] == "accepted") {
					
					$html[] = "<div class='card flex-fill'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='card-title'><i class='ti ti-file-description me-1'></i> Listing Details</div>";
								
								$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-certificate me-1'></i> Authority:</span> <strong>".$data['listing']['other_details']['authority_type']."</strong></div>";
								$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-license me-1'></i> Commission Share:</span> <strong>".$data['listing']['other_details']['com_share']."%</strong></div>";
								$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-moneybag me-1'></i> Option Money:</span> <strong>&#8369;".number_format($data['listing']['reservation'],0)." for ".(isset($data['listing']['payment_details']['option_money_duration']) ? $data['listing']['payment_details']['option_money_duration'] : "")." days</strong></div>";
								$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-pig-money me-1'></i> Mode of Payment:</span> <strong>".(isset($data['listing']['payment_details']['payment_mode']) ? $data['listing']['payment_details']['payment_mode'] : "")."</strong></div>";
								$html[] = "<div class='mb-1'><span class='text-muted me-1'><i class='ti ti-file-description me-1'></i> Allocation of Taxes:</span> <strong>".(isset($data['listing']['payment_details']['tax_allocation']) ? $data['listing']['payment_details']['tax_allocation'] : "")."</strong></div>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card flex-fill'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='card-title'><i class='ti ti-file-description me-1'></i> Listing Documents</div>";
								for($i=0; $i<count($data['listing']['documents']); $i++) {
									$html[] = "<div class='mb-1'><a href=''><span class='text-muted me-1'><i class='ti ti-file-description me-1'></i><strong>".$data['listing']['documents'][$i]."</strong></a></div>";
								}
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
					
				}

			$html[] = "</div>";
		$html[] = "</div>";
	}
	$html[] = "<div class='container-xl my-3 px-0'>";
		$html[] = "<div class='row'>";
			$html[] = "<div class='col-md-9 col-12'>";
                $html[] = "<div class='bg-white border px-4 pb-4 '>";

					$html[] = "<div class='sticky-top bg-white py-2 px-0 mx-0 mb-4 border-bottom'>";
						$html[] = "<div class='d-flex overflow-auto'>";
							if($data['listing']['thumb_img'] != "" && $data['listing']['images']) { $html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#photos'><i class='ti ti-photo me-1'></i> Photos</a>"; }
							if($data['listing']['video'] != "") { $html[] = "<a class='btn btn-outline-primary border-0 d-block' href='javascript:document.querySelector(\"#youtube_video\").click()'><i class='ti ti-brand-youtube me-1'></i> Video</a>"; }
							$html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#description'><i class='ti ti-file-description me-1'></i> Description</a>";
							$html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#amenities'><i class='ti ti-home-shield me-1'></i> Amenities</a>";
							$html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#payment_details'><i class='ti ti-wallet me-1'></i> Payment Details</a>";
							
							if($data['listing']['offer'] != "looking for") {
								$html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#mortgage_calculator'><i class='ti ti-calculator me-1'></i> Mortgage Claculator</a>";
								$html[] = "<a class='btn btn-outline-primary border-0 d-block' href='#currency_converter'><i class='ti ti-coins me-1'></i> Currency Converter</a>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

                    $html[] = "<div class='mb-2 description ' style='max-height: 300px; overflow: hidden;'>";
						$html[] = "<h3 id='description'><i class='ti ti-file-description me-1'></i> Description</h3>";
						$html[] = $data['listing']['long_desc'];
					$html[] = "</div>";
					$html[] = "<span class='btn btn-description-toggle d-none'>Show more...</span>";

					/** AMENITIES */
					$html[] = "<div class='amenities mt-5'>";
						$html[] = "<h3 id='amenities'><i class='ti ti-home-shield me-1'></i> Amenities</h3>";
						$html[] = "<ul class='m-0 p-0' style='list-style: none; columns: 2; -webkit-columns: 2; -moz-columns: 2;'>";
							$amenities = explode(",",$data['listing']['amenities']);
							for($i=0; $i<count($amenities); $i++) {
								$html[] = "<li class='m-0 p-0'>";
									$html[] = "<i class='ti ti-check'></i> ".$amenities[$i];
								$html[] = "</li>";
							}
						$html[] = "</ul>";
					$html[] = "</div>";
					/** AMENITIES END */

					/** PAYMENT DETAILS */
					$html[] = "<div class='price mt-5'>";
						$html[] = "<h3 id='payment_details'><i class='ti ti-wallet me-1'></i> Payment Details</h3>";
						$html[] = "<table class='table'>";
						$html[] = "<tr>";
							if($data['listing']['offer'] != "looking for") {
								$html[] = "<td class='w-50'>Selling Price</td>";
							}else {
								$html[] = "<td class='w-50'>Buyers Budget</td>";
							}
							$html[] = "<td>&#8369;".number_format($data['listing']['price'],0)."</td>";
						$html[] = "</tr>";

						if($data['listing']['offer'] != "looking for") {
							$html[] = "<tr>";
								$html[] = "<td>Reservation Fee</td>";
								$html[] = "<td>&#8369;".number_format($data['listing']['reservation'],0)."</td>";
							$html[] = "</tr>";
						}

						$html[] = "<tr>";
							$html[] = "<td>Eligible for Bank Loan</td>";
							$html[] = "<td>".((isset($data['listing']['payment_details']['bank_loan']) ? $data['listing']['payment_details']['bank_loan'] : 0) == 1 ? "Yes" : "No")."</td>";
						$html[] = "</tr>";

						$html[] = "<tr>";
							$html[] = "<td>Eligible for Pag-Ibig Housing Loan</td>";
							$html[] = "<td>".((isset($data['listing']['payment_details']['pagibig_loan']) ? $data['listing']['payment_details']['pagibig_loan'] : 0) == 1 ? "Yes" : "No")."</td>";
						$html[] = "</tr>";

						$html[] = "<tr>";
							$html[] = "<td>Assume Balance</td>";
							$html[] = "<td>".((isset($data['listing']['payment_details']['assume_balance']) ? $data['listing']['payment_details']['assume_balance'] : 0) == 1 ? "Yes" : "No")."</td>";
						$html[] = "</tr>";
						$html[] = "</table>";
						
					$html[] = "</div>";
					/** PAYMENT DETAILS END */

					if($data['listing']['offer'] != "looking for") {
						/** MORTGAGE CALCULATOR */
						$html[] = "<div class='mortgage-calculator mt-5 p-3 bg-cyan-lt border'>";
							
							$html[] = "<input type='hidden' id='selling_price' value='".$data['listing']['price']."' />";
							$html[] = "<h3 id='mortgage_calculator' class='mb-2 text-dark'><i class='ti ti-calculator'></i> Mortgage Calculator</h3>";
							$html[] = "<p class='mb-2 text-dark'>With the current price of <b>&#8369;".number_format($data['listing']['price'],0)."</b> and mortgage rates as stated below, expect to have a monthly payment of:</p>";
							
							$html[] = "<div class='p-4 border bg-white'>";
								$html[] = "<div class='row align-items-center justify-content-center'>";
									$html[] = "<div class='col-md-6'>";
										$html[] = "<div class='text-center text-highlight mb-3'>";
											$html[] = "<span class='d-block mb-2'>Monthly Payment of</span>";
											$html[] = "<span class='fs-36 fw-bold monthly_dp'></span>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<div class='col-md-6'>";

										$html[] = "<div class='d-flex gap-2 justify-content-center'>";
											$html[] = "<div class='form-floating flex-fill'>";
												$html[] = "<select id='mortgage-downpayment-selection' class='form-select'>";
												foreach(range(10, 90, 10) as $dp) {
													$sel = 20 == $dp ? "selected" : "";
													$html[] = "<option value='$dp' $sel>$dp%</option>";
												}
												$html[] = "</select>";
												$html[] = "<label for='mortgage-downpayment-selection'>Down Payment</label>";
											$html[] = "</div>";

											$html[] = "<div class='form-floating flex-fill'>";
												$html[] = "<select id='mortgage-interest-selection' class='form-select'>";
												foreach(range(0, 20, 0.25) as $interest) {
													$sel = 3.75 == $interest ? "selected" : "";
													$html[] = "<option value='".($interest)."' $sel >".number_format($interest,2)."%</option>";
												}
												$html[] = "</select>";
												$html[] = "<label for='mortgage-interest-selection'>Interest Rate</label>";
											$html[] = "</div>";

											$html[] = "<div class='form-floating flex-fill'>";
												$html[] = "<select id='mortgage-years-selection' class='form-select'>";
												for($i=0; $i<=29; $i++) {
													$sel = $i == 2 ? "selected" : "";
													$html[] = "<option value='".$i."' $sel>".($i + 1)." Years</option>";
												}
												$html[] = "</select>";
												$html[] = "<label for='mortgage-years-selection'>Years</label>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<p class='fs-12 text-muted m-0 mt-2'>You can use the mortgage calculator to estimate the monthly payment with different values.</p>";
										
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<p class='mt-2 mb-0 p-0 text-muted fs-12'>* The accuracy and applicability of this calculator are not guaranteed.</p>";
						$html[] = "</div>";
						/** MORTGAGE CALCULATOR END */

						/** CURRENCY CONVERTER */
						$html[] = "<div class='currency-converter mt-5 p-3 bg-cyan-lt border'>";
							$html[] = "<h3 id='currency_converter' class='mb-2 text-dark'><i class='ti ti-coins'></i> Currency Converter</h3>";
							$html[] = "<div class='p-4 border bg-white'>";
								
								$html[] = "<div class='row align-items-center justify-content-center'>";
									$html[] = "<div class='col-md-6 col-lg-6 col-sm-12 col-12'>";
										$html[] = "<div class='text-center text-highlight mb-3'>";
											$html[] = "<span class='d-block mb-2'>Selling Price</span>";
											$html[] = "<span class='fs-36 fw-bold selling-price' data-price='".$data['listing']['price']."'>".number_format($data['listing']['price'],0)."</span>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<div class='col-md-6 col-lg-6 col-sm-12 col-12'>";

										$html[] = "<div class='d-flex gap-2 justify-content-center flex-wrap'>";
											
											$html[] = "<div class='form-floating flex-fill'>";
												$html[] = "<select id='currency-code-selection' class='form-select'>";
												$html[] = "</select>";
												$html[] = "<label for='currency-code-selection'>Currency Code</label>";
											$html[] = "</div>";

											$html[] = "<div class='form-floating flex-fill'>";
												$html[] = "<span class='d-block base-currency text-muted fs-12'>PHP against <span class='currency-code'>USD</span></span>";
												$html[] = "<span class='d-block mt-1 base-currency-value p-2 border fw-bold'></span>";
											$html[] = "</div>";

										$html[] = "</div>";

										$html[] = "<p class='text-muted mt-2 fs-12'>Last update at <span class='last-updated-at'></span></p>";

									$html[] = "</div>";

								$html[] = "</div>";

							$html[] = "</div>";
							$html[] = "<p class='mt-2 mb-0 p-0 text-muted fs-12'>* The accuracy and applicability of this currency converter are not guaranteed.</p>";
						$html[] = "</div>";
					}

                $html[] = "</div>";
            $html[] = "</div>";

			$html[] = "<div class='col-md-3 col-12 mls-sidebar'>";

				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body text-center'>";
						$html[] = "<div class='mb-3 btn-view-profile' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountsController@profilePreview", ["id" => $data['account']['account_id']])."'>";
							$html[] = "<span class='avatar avatar-xxl rounded' style='background-image: url(".$data['account']['logo'].")'></span>";
						$html[] = "</div>";
						$html[] = "<div class='card-title mb-0'>".$data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</div>";
						$html[] = "<div class='text-secondary'>".$data['account']['profession']."</div>";
					$html[] = "</div>";

					if($data['account']['account_id'] != $_SESSION['user_logged']['account_id']) {
					    $html[] = "<a class='card-btn bg-primary text-white' href='".url("MessagesController@conversation", ["participants" => base64_encode(json_encode(array($data['listing']['account_id'],$_SESSION['user_logged']['account_id'])))], ["listing_id" => $data['listing']['listing_id'], "name" => $data['listing']['title']])."'><i class='ti ti-send me-2'></i> Send Message</a>";
					}

				$html[] = "</div>";

				$status[1] = "Available";
                $status[2] = "Sold";

				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<div class='card-title'>Posting Details</div>";
						
						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-status-change me-1'></i> Status:</span> <strong>".$status[$data['listing']['status']]."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Posted since:</span> <strong>".date("d M Y", $data['listing']['created_at'])."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Modified at:</span> <strong>".date("d M Y", $data['listing']['modified_at'])."</strong></div>";
					$html[] = "</div>";
				$html[] = "</div>";

				if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {

				}else {
					if($_SESSION['user_logged']['account_id'] != $data['account']['account_id']) {
						$html[] = "<div class='text-center'>";
							$html[] = "<span class='btn btn-md btn-primary me-1 btn-requestHandshake row_listings_".$data['listing']['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
						$html[] = "</div>";
					}
				}
			
            $html[] = "</div>";
        $html[] = "</div>";
    $html[] = "</div>";

	
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='py-4'>";

			$html[] = "<div class='row'>";
				$html[] = "<div class='col-lg-9'>";
					$html[] = "<h3><i class='ti ti-building'></i> Related Properties</h3>";
					$html[] = "<div class='related-properties-container mb-3'></div>";
				$html[] = "</div>";
				$html[] = "<div class='col-lg-3'>";
					
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";										
	$html[] = "</div>";	

$html[] = "</div>";

$html[] = "<div class='btn-wrap fixed-bottom d-sm-block d-md-none'>";
	$html[] = "<div class='text-center'>";
		if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {
			$html[] = "<span class='btn btn-md btn-danger ms-1 mb-2 btn-cancel-handshake row_listings_".$data['listing']['listing_id']."' data-row='row_listings_".$data['listing']['listing_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
		}else {
			if($_SESSION['user_logged']['account_id'] != $data['account']['account_id']) {
				$html[] = "<span class='btn btn-md btn-primary btn-requestHandshake row_listings_".$data['listing']['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
			}
		}
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";