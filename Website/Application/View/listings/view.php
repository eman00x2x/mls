<?php

$html[] = "<div class='page-body mb-0'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='my-3 p-2'>";
			$html[] = "<div class='row gap-2 justify-content-center'>";
				$html[] = "<div class='col-md-5 col-12'>";

					$html[] = "<div id='photos'>";

						if($data['thumb_img'] != "") {
							$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-image: url(".$data['thumb_img'].")'>";
								$html[] = "<span style='position: absolute; top:-1px; left: -1px;' class='fw-bold bg-white text-dark p-2'><i class='ti ti-photo'></i> +".count($data['images'])."</span>";
								$html[] = "<a data-fslightbox data-type='image' href='".$data['thumb_img']."' class='stretched-link'></a>";
							$html[] = "</div>";
						}else {
							$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-color:#FFF; background-image: url(".CDN."images/item_default.jpg); background-size: auto;'>";
							$html[] = "</div>";
						}
						
						$html[] = "<div class='mb-3'>";
							if($data['images']) {
								$html[] = "<div class='d-flex gap-2 justify-content-center overflow-auto'>";

								$limit = 6;
								if($data['video'] != "") {
									$video_id = str_replace("https://www.youtube.com/watch?v=", "", $data['video']);
									$html[] = "<div><a data-fslightbox href='".$data['video']."' id='youtube_video'>";
										$html[] = "<div class='avatar avatar-xl p-2 bg-white-lt' style='background-image: url(http://img.youtube.com/vi/$video_id/sddefault.jpg)'><i class='ti ti-brand-youtube me-1 fs-36'></i></div>";
									$html[] = "</a></div>";
									$limit = 5;
								}

								$total_image = count($data['images']);

								for($i=0; $i<$total_image; $i++) {
									if($i < $limit) { $hide = "";

										if($i > ($limit - 3)) {
											$hide = "d-none d-md-block";
										}
										
										$html[] = "<div class='$hide'><a data-fslightbox data-type='image' href='".$data['images'][$i]['url']."'>";
											$html[] = "<div class='avatar avatar-xl' style='position:relative; background-image: url(".$data['images'][$i]['url'].")'>";
												
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
										$html[] = "<a data-fslightbox data-type='image' class='d-none' href='".$data['images'][$i]['url']."'></a>";
									}
								}
								$html[] = "</div>";
							}
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
				$html[] = "<div class='col-md-4 col-12'>";
				
					$html[] = "<span class='d-block text-muted fs-12 mb-2'><i class='ti ti-calendar'></i> Modified on ";
						if($data['last_modified'] > 0) {
							$html[] = date("d M Y", $data['last_modified']);
						}else {
							$html[] = date("d M Y", $data['date_added']);
						}
					$html[] = "</span>";
						
					$html[] = "<div class='mb-4'>";
						$html[] = "<h1>".$data['title']."</h1>";
						$html[] = "<p><i class='ti ti-map-pin'></i> ".$data['address']['barangay']." ".$data['address']['municipality']." ".$data['address']['province']."</p>";
						$html[] = "<p class='display-5 fw-bold text-green'>&#8369;".number_format($data['price'], 0)."</p>";
						$html[] = "<p class='fs-16'><span><i class='ti ti-category'></i> ".$data['category']."</span></p>";

						$html[] = "<div class='mb-3 d-flex gap-5 align-items-center'>";

							if($data['lot_area'] > 0) {
								$html[] = "<div class='fs-24 fw-bold'>";
									$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Land Area:</small>";
									$html[] = "<span><i class='ti ti-maximize'></i> ".$data['lot_area']."sqm</span>";
								$html[] = "</div>";
							}

							if($data['floor_area'] > 0) {
								$html[] = "<div class='fs-24 fw-bold'>";
									$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Floor Area:</small>";
									$html[] = "<span><i class='ti ti-maximize'></i> ".$data['floor_area']."sqm</span>";
								$html[] = "</div>";
							}
						$html[] = "</div>";

						$html[] = "<div class='mb-3 d-flex gap-5 align-items-center'>";
							if($data['bedroom'] != "" && $data['bedroom'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-bed'></i> ".$data['bedroom']."<span class='d-block fw-normal text-muted fs-12'>Bedroom</span></div>"; }
							if($data['bathroom'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-bath'></i> ".$data['bathroom']."<span class='d-block fw-normal text-muted fs-12'>Bathroom</span></div>"; }
							if($data['parking'] > 0) { $html[] = "<div class='fw-bold'><i class='ti ti-car-garage'></i> ".$data['parking']."<span class='d-block fw-normal text-muted fs-12'>Car Space</span></div>"; }
						$html[] = "</div>";

						/* $html[] = "<div class='mb-2 d-flex gap-5'>";
							$html[] = "<span class='d-block text-muted fs-12'><i class='ti ti-calendar'></i> ".date("d M Y", $data['date_added'])."<br/> Listed on </span>";
							$html[] = "<span class='d-block text-muted fs-12'><i class='ti ti-calendar'></i> ".date("d M Y", $data['last_modified'])."<br/> Modified on</span>";
						$html[] = "</div>"; */

						$html[] = \Library\Helper::socialMediadShareButtons([
							"title" => $data['page_title'],
							"description" => $data['page_description'],
							"img" => $data['page_image'],
							"url" => url(),
						]);

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";

	$html[] = "<div class='bg-white pt-3 border-top mt-4 px-2 pb-4'>";
		$html[] = "<div class='container-xl'>";
			
			$html[] = "<div class='row'>";
				$html[] = "<div class='col-md-8'>";

					$html[] = "<div class='sticky-top bg-white py-2 px-0 mx-0 mb-4 border-bottom'>";
						$html[] = "<div class='d-flex overflow-auto'>";
							if($data['thumb_img'] != "" && $data['images']) { $html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='#photos'><i class='ti ti-photo me-1'></i> Photos</a>"; }
							if($data['video'] != "") { $html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='javascript:document.querySelector(\"#youtube_video\").click()'><i class='ti ti-brand-youtube me-1'></i> Video</a>"; }
							$html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='#description'><i class='ti ti-file-description me-1'></i> Description</a>";
							$html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='#amenities'><i class='ti ti-home-shield me-1'></i> Amenities</a>";
							$html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='#payment_details'><i class='ti ti-wallet me-1'></i> Payment Details</a>";
							$html[] = "<a class='btn btn-outline-secondary border-0 d-block' href='#mortgage_calculator'><i class='ti ti-calculator me-1'></i> Mortgage Claculator</a>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class=' mb-4'>";

						$html[] = "<div class='mb-2 description ' style='max-height: 300px; overflow: hidden;'>";
							$html[] = "<h3 id='description'><i class='ti ti-file-description me-1'></i> Description</h3>";
							$html[] = $data['long_desc'];
						$html[] = "</div>";
						$html[] = "<span class='btn btn-description-toggle d-none'>Show more...</span>";

						/** AMENITIES */
						$html[] = "<div class='amenities mt-5'>";
							$html[] = "<h3 id='amenities'><i class='ti ti-home-shield me-1'></i> Amenities</h3>";
							$html[] = "<ul class='m-0 p-0' style='list-style: none; columns: 2; -webkit-columns: 2; -moz-columns: 2;'>";
								$amenities = explode(",",$data['amenities']);
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
								$html[] = "<td class='w-50'>Selling Price</td>";
								$html[] = "<td>&#8369;".number_format($data['price'],0)."</td>";
							$html[] = "</tr>";
							$html[] = "<tr>";
								$html[] = "<td>Reservation Fee / Option Money</td>";
								$html[] = "<td>&#8369;".number_format($data['reservation'],0)."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Eligible for Bank Loan</td>";
								$html[] = "<td>".((isset($data['payment_details']['bank_loan']) ? $data['payment_details']['bank_loan'] : 0) == 1 ? "Yes" : "No")."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Eligible for Pag-Ibig Housing Loan</td>";
								$html[] = "<td>".((isset($data['payment_details']['pagibig_loan']) ? $data['payment_details']['pagibig_loan'] : 0) == 1 ? "Yes" : "No")."</td>";
							$html[] = "</tr>";

							$html[] = "</table>";
							
						$html[] = "</div>";
						/** PAYMENT DETAILS END */


						/** MORTGAGE CALCULATOR */
						$html[] = "<div class='mortgage-calculator mt-5 p-3 bg-cyan-lt border'>";
							
							$html[] = "<input type='hidden' id='selling_price' value='".$data['price']."' />";
							$html[] = "<h3 id='mortgage_calculator' class='mb-2 text-dark'><i class='ti ti-calculator'></i> Mortgage Calculator</h3>";
							$html[] = "<p class='mb-2 text-dark'>With the current price of <b>&#8369;".number_format($data['price'],0)."</b> and mortgage rates as stated below, expect to have a monthly payment of:</p>";
							
							$html[] = "<div class='p-4 border bg-white'>";
								$html[] = "<div class='row align-items-center justify-content-center'>";
									$html[] = "<div class='col-md-6'>";
										$html[] = "<div class='text-center text-dark mb-3'>";
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
						
						$html[] = "<p class='text-muted fs-12 my-4'>Disclaimer: The information found herein are subject to change without prior notice. Interested parties are requested to verify all information relating to the property prior to purchase.</p>";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='col-md-4'>";
					$html[] = "<div class='sidebar d-none d-md-block sticky-top d-print-none'>";
						$html[] = "<div class='card'>";

							$html[] = "<div class='card-body'>";

								$html[] = "<div class='inquiry-form-container'>";
									$html[] = "<h2 class='card-title text-center'><i class='ti ti-message'></i> Send Message</h2>";

									$html[] = "<div class='row justify-content-center'>";
										$html[] = "<div class='col-md-8 col-10'>";
											$html[] = "<div class='d-flex py-1 mb-4 align-items-center'>";
												$html[] = "<span class='avatar avatar-xl me-2 rounded-circle' style='background-image: url(".$data['account']['logo'].")'></span>";
												$html[] = "<div class='flex-fill'>";
													$html[] = "<div class='font-weight-medium'>";
														$html[] = $data['account']['firstname']." ".$data['account']['lastname'];
													$html[] = "</div>";
													$html[] = "<div class='text-muted'>".$data['account']['profession']."</div>";
													if($data['account']['company_name'] != "") { $html[] = "<div class='text-muted'>".$data['account']['company_name']."</div>"; }
													$html[] = "<div class='text-muted'>Member Since ".date("Y", $data['account']['registration_date'])."</div>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<form id='inquiry-form' action='".url("ListingsController@sendMessage", ["id" => $data['listing_id']])."' method='POST'>";

										$html[] = "<input type='hidden' name='title' value='".$data['title']."' />";
										$html[] = "<input type='hidden' name='account_id' value='".$data['account_id']."' />";
										$html[] = "<input type='hidden' name='listing_id' value='".$data['listing_id']."' />";
										$html[] = "<input type='hidden' name='preferences[type]' value='".$data['type']."' />";
										$html[] = "<input type='hidden' name='preferences[bedroom]' value='".$data['bedroom']."' />";
										$html[] = "<input type='hidden' name='preferences[bathroom]' value='".$data['bathroom']."' />";
										$html[] = "<input type='hidden' name='preferences[parking]' value='".$data['parking']."' />";
										$html[] = "<input type='hidden' name='preferences[lot_area]' value='".$data['lot_area']."' />";
										$html[] = "<input type='hidden' name='preferences[category]' value='".$data['category']."' />";
										$html[] = "<input type='hidden' name='preferences[address][barangay]' value='".$data['address']['barangay']."' />";
										$html[] = "<input type='hidden' name='preferences[address][municipality]' value='".$data['address']['municipality']."' />";
										$html[] = "<input type='hidden' name='preferences[address][province]' value='".$data['address']['province']."' />";
										$html[] = "<input type='hidden' name='preferences[address][region]' value='".$data['address']['region']."' />";

										$html[] = "<div class='mb-3'>";
											$html[] = "<div class='form-floating mb-3'>";
												$html[] = "<input type='text' name='name' id='name' value='' class='form-control' placeholder='Your Name' />";
												$html[] = "<label for='name'>Your Name</label>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<div class='form-floating mb-3'>";
												$html[] = "<input type='email' name='email' id='email' value='' class='form-control' placeholder='Email Address' />";
												$html[] = "<label for='email'>Email Address</label>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='hidden-fields d-none'>";
											
											$html[] = "<div class='mb-3'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='number' name='mobile_no' id='mobile_no' value='' class='form-control' placeholder='(0000) 000-0000' data-mask='(0000) 000-0000' data-mask-visible='true' />";
													$html[] = "<label for='mobile_no'>Mobile Number</label>";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='mb-3'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<textarea name='message' id='message' value='' class='form-control' placeholder='message'></textarea>";
													$html[] = "<label for='message'>Message</label>";
												$html[] = "</div>";
											$html[] = "</div>";

											$html[] = "<div class='mb-3'>";
												$security_code = rand(1000, 9999);
												$html[] = "<div class='mb-1'>";
													$html[] = "<p class='m-0 p-0'>Enter security code: <span class='fw-bold'>".$security_code."</span></p>";
												$html[] = "</div>";

												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='text' name='input_security_code' id='input_security_code' value='' data-code='$security_code' class='form-control' placeholder='Enter security code' />";
													$html[] = "<label class='input_security_code'>Security Code</label>";
												$html[] = "</div>";
											$html[] = "</div>";

										$html[] = "</div>";

									$html[] = "</form>";

									$html[] = "<div class='error-message mb-4 d-none'>";
										$html[] = "<div class='message alert  alert-danger'>";
											$html[] = "<div class='d-flex'>";
												$html[] = "<div class=''><i class='ti ti-alert-triangle me-2' aria-hidden='true'></i></div>";
												$html[] = "<div class=''>";
													$html[] = "<p class='p-0 m-0'>Error! All fields are required!</p>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<div class='success-message mb-4 d-none'>";
										$html[] = "<div class='message alert  alert-success '>";
											$html[] = "<div class='d-flex'>";
												$html[] = "<div class=''><i class='ti ti-alert-triangle me-2' aria-hidden='true'></i></div>";
												$html[] = "<div class=''>";
													$html[] = "<p class='p-0 m-0'>Done! Message sent!</p>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<div class='security-message mb-4 d-none'>";
										$html[] = "<div class='message alert  alert-warning'>";
											$html[] = "<div class='d-flex'>";
												$html[] = "<div class=''><i class='ti ti-alert-triangle me-2' aria-hidden='true'></i></div>";
												$html[] = "<div class=''>";
													$html[] = "<p class='p-0 m-0'>Warning! wrong security code!</p>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<p class='mt-4 text-muted fs-12'>By clicking send message, you are accepting ".SITE_NAME." <a href='".url("PagesController@terms")."'>Terms and Condition</a> and <a href='".url("PagesController@privacy")."'>Privacy Policy</a> page.</p>";
									$html[] = "<span class='mb-3 btn btn-primary btn-send-message w-100'><i class='ti ti-send me-1'></i> Send Message</span>";
									
								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</div>";

						/*** ADS CONTAINER */
						$html[] = "<div class='card bg-dark-lt mt-2 rounded-0  d-print-none' style='height:250px;'>";
							$html[] = "<div class='card-body'>";
								$html[] = "<span class='d-block text-center text-muted'>ADS CONTAINER</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						/*** END ADS CONTAINER */

					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
	
	$html[] = "<div class='py-4'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='row'>";
				$html[] = "<div class='col-md-8'>";

					$html[] = "<div class='related-properties-container'></div>";

				$html[] = "</div>";
				$html[] = "<div class='col-md-4'>";
					
					/*** ADS CONTAINER */
					$html[] = "<div class='card bg-dark-lt rounded-0 d-print-none' style='height:350px;'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<span class='d-block text-center text-muted'>ADS CONTAINER</span>";
						$html[] = "</div>";
					$html[] = "</div>";
					/*** END ADS CONTAINER */

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";										
	$html[] = "</div>";										

$html[] = "</div>";

$html[] = "<div class='bottom-wrap d-sm-block d-md-none d-print-none'>";
	$html[] = "<div class='bg-white fixed-bottom px-4 py-3'>";
		$html[] = "<span class='btn btn-primary btn-send-message-toggle w-100' data-bs-toggle='offcanvas' href='#offcanvasEnd' role='button' aria-controls='offcanvasEnd'><i class='ti ti-send me-1'></i> Send Message</span>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";
