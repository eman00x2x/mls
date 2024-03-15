<?php

$html[] = "<div class='page-body p-2'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='my-3'>";
			$html[] = "<div class='row gap-2 justify-content-center'>";
				$html[] = "<div class='col-md-5 col-12'>";

					$html[] = "<div class=''>";
						$html[] = "<a data-fslightbox data-type='image' href='".$data['thumb_img']."'>";
							$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-image: url(".$data['thumb_img'].")'>";
								$html[] = "<span style='position: absolute; top:-1px; left: -1px;' class='fw-bold bg-white text-dark p-2'><i class='ti ti-photo'></i> +".count($data['images'])."</span>";
							$html[] = "</div>";
						$html[] = "</a>";

						$html[] = "<div class='mb-3'>";
							if($data['images']) {
								$html[] = "<div class='d-flex gap-2 justify-content-center overflow-auto'>";
								for($i=0; $i<count($data['images']); $i++) {
									if($i <= 6) {
										if($data['thumb_img'] != $data['images'][$i]['url']) {
											$html[] = "<a data-fslightbox data-type='image' href='".$data['images'][$i]['url']."'>";
												$html[] = "<div class='avatar avatar-xl' style='position:relative; background-image: url(".$data['images'][$i]['url'].")'>";
													
													if($i == 5) {
														$html[] = "<div class='overlay d-md-none d-sm-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
															$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".(count($data['images']) - 5)."</span>";
														$html[] = "</div>";
													}
												
													if($i == 6) {
														$html[] = "<div class='overlay d-none d-md-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
															$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".(count($data['images']) - 6)."</span>";
														$html[] = "</div>";
													}

												$html[] = "</div>";
											$html[] = "</a>";
										}
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
				
				    $html[] = "<div class='mb-4'>";
						$html[] = "<h1>".$data['title']."</h1>";
						$html[] = "<p><i class='ti ti-map-pin'></i> ".$data['address']['barangay']." ".$data['address']['municipality']."</p>";
						$html[] = "<p class='display-5 fw-bold text-green'>&#8369;".number_format($data['price'], 0)."</p>";
						$html[] = "<p class='fs-16'><span><i class='ti ti-category'></i> ".$data['category']."</span></p>";

						$html[] = "<div class='mb-3 d-flex gap-5 align-items-center'>";
							$html[] = "<div class='fs-24 fw-bold'>";
								$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Land Area:</small>";
								$html[] = "<span><i class='ti ti-maximize'></i> ".$data['lot_area']."sqm</span>";
							$html[] = "</div>";
							$html[] = "<div class='fs-24 fw-bold'>";
								$html[] = "<small class='fw-normal fs-12 d-block text-muted'> Floor Area:</small>";
								$html[] = "<span><i class='ti ti-maximize'></i> ".$data['floor_area']."sqm</span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='mb-4 d-flex gap-5 align-items-center'>";
							$html[] = "<div class='fw-bold'><i class='ti ti-bed'></i> ".$data['bedroom']."<span class='d-block fw-normal text-muted fs-12'>Bedroom</span></div>";
							$html[] = "<div class='fw-bold'><i class='ti ti-bath'></i> ".$data['bathroom']."<span class='d-block fw-normal text-muted fs-12'>Bathroom</span></div>";
							$html[] = "<div class='fw-bold'><i class='ti ti-car-garage'></i> ".$data['parking']."<span class='d-block fw-normal text-muted fs-12'>Car Space</span></div>";
						$html[] = "</div>";

						$html[] = "<span class='text-muted fs-12'>Posted by:</span>";
						$html[] = "<div class='property-agent-container'>";
							$html[] = "<div class='d-flex py-1 align-items-center'>";
								$html[] = "<span class='avatar me-2' style='background-image: url(".$data['account']['logo'].")'></span>";
								$html[] = "<div class='flex-fill'>";
									$html[] = "<div class='font-weight-medium'>";
										$html[] = $data['account']['firstname']." ".$data['account']['lastname'];
									$html[] = "</div>";
									$html[] = "<div class='text-muted'>".$data['account']['profession']."</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";

	$html[] = "<div class='bg-white pt-5 border-top mt-4'>";
		$html[] = "<div class='container-xl'>";
			
			$html[] = "<div class='row'>";
				$html[] = "<div class='col-md-8'>";

					$html[] = "<div class='mb-2 description border-bottom' style='height: 300px; overflow: hidden;'>";
						$html[] = "<h3>Description</h3>";
						$html[] = $data['long_desc'];
					$html[] = "</div>";
					$html[] = "<span class='btn btn-description-toggle'>Show more...</span>";

					$html[] = "<div class='amenities mt-4'>";
						$html[] = "<h3>Amenities</h3>";
						$html[] = "<ul class='' style='list-style: none; columns: 2; -webkit-columns: 2; -moz-columns: 2;'>";
							$amenities = explode(",",$data['amenities']);
							for($i=0; $i<count($amenities); $i++) {
                                $html[] = "<li>";
                                    $html[] = "<i class='ti ti-check'></i> ".$amenities[$i];
                                $html[] = "</li>";
                            }
						$html[] = "</ul>";
					$html[] = "</div>";

				$html[] = "</div>";

				$html[] = "<div class='col-md-4'>";
					$html[] = "<div class='sidebar d-none d-md-block sticky-top'>";
						$html[] = "<div class='card'>";

							$html[] = "<div class='card-body'>";

								$html[] = "<div class='inquiry-form-container'>";
									$html[] = "<h2 class='card-title mb-4'><i class='ti ti-message'></i> Send Message</h2>";

									$html[] = "<div class='send-message-agent-container'></div>";
							
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
											$html[] = "<label class='form-label'>Name</label>";
											$html[] = "<input type='text' name='name' id='name' value='' class='form-control' />";
										$html[] = "</div>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='form-label'>Email Address</label>";
											$html[] = "<input type='email' name='email' id='email' value='' class='form-control' />";
										$html[] = "</div>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='form-label'>Mobile Number</label>";
											$html[] = "<input type='number' name='mobile_no' id='mobile_no' value='' class='form-control' />";
										$html[] = "</div>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='form-label'>Message</label>";
											$html[] = "<textarea name='message' id='message' value='' class='form-control'></textarea>";
										$html[] = "</div>";

									$html[] = "</form>";

									$html[] = "<div class='mb-3'>";
										$security_code = rand(1000, 9999);
										$html[] = "<div class=''>";
											$html[] = "<p class='m-0 p-0'>Enter security code: <span class='fw-bold'>".$security_code."</span></p>";
										$html[] = "</div>";

										$html[] = "<label class='form-label'>Security Code</label>";
										$html[] = "<input type='text' name='input_security_code' id='input_security_code' value='' data-code='$security_code' class='form-control' />";
									$html[] = "</div>";

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

									$html[] = "<span class='btn btn-primary btn-send-message w-100'><i class='ti ti-send me-1'></i> Send Message</span>";

								$html[] = "</div>";

							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='bottom-wrap d-sm-block d-md-none mt-5'>";
	$html[] = "<div class='bg-white fixed-bottom px-4 py-3'>";
		$html[] = "<span class='btn btn-primary btn-send-message-toggle w-100' data-bs-toggle='offcanvas' href='#offcanvasEnd' role='button' aria-controls='offcanvasEnd'>Send Message</span>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";