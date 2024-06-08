<?php

$html[] = "<div class='page-body bg-white' style='margin: 0;'>";
    $html[] = "<div class='container-xl'>";

		$html[] = "<div class=' px-2 fs-16'>";
			$html[] = "<div class='row'>";
				$html[] = "<div class='col-md-8 col-12'>";
				
					$html[] = "<div class='article py-4'>";
						$html[] = "<div class=''>";

							$html[] = "<div class=''>";
								$html[] = "<h1 class='mb-1'>".$data['subject']."</h1>";

								$html[] = "<p class='my-3'>".$data['content']['details']."</p>";

								$html[] = "<ul class='list-group list-group-flush'>";
									$html[] = "<li class='list-group-item py-2'><i class='ti ti-map-pin me-1'></i> ".$data['content']['address']."</li>";
									$html[] = "<li class='list-group-item py-2'><i class='ti ti-calendar me-1'></i>".date("d M Y g:iA", strtotime($data['content']['date']))."</li>";
									$html[] = "<li class='list-group-item py-2'>";
										$html[] = "<div class='share-buttons'>";
											$html[] = $data['share_buttons'];
										$html[] = "</div>";
									$html[] = "</li>";
								$html[] = "</ul>";

								$html[] = "<h3 class='mt-3'><a href='".url("ListingsController@view", ["name" => $data['listing']['name']])."' class='text-decoration-none'><i class='ti ti-link'></i> ".$data['listing_title']."</a></h3>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
										$html[] = "<a href='".$data['attachment']."' data-fslightbox data-type='image'>";
											$html[] = "<span class='avatar w-100 mb-3' style='height:340px !important; background-image: url(".$data['attachment'].")'></span>";
										$html[] = "</a>";
									$html[] = "</div>";
									$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
										$html[] = "<div class='row g-2'>";
											for($i=0; $i<count($data['images']); $i++) {
												$html[] = "<div class='col-lg-6 col-md-6 col-sm-6 col-6'>";
													$html[] = "<a href='".$data['images'][$i]['url']."' data-fslightbox data-type='image'>";
														$html[] = "<span class='avatar avatar-xxl w-100' style='background-image: url(".$data['images'][$i]['url'].")'></span>";
													$html[] = "</a>";
												$html[] = "</div>";
											}
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";

								if($data['listing']['video'] != "") {
									$video_id = str_replace("https://www.youtube.com/watch?v=", "", $data['listing']['video']);
									$html[] = "<div><a data-fslightbox href='".$data['listing']['video']."' id='youtube_video'>";
										$html[] = "<div class='avatar avatar-xl p-2 bg-white-lt' style='background-image: url(http://img.youtube.com/vi/$video_id/sddefault.jpg)'><i class='ti ti-brand-youtube me-1 fs-36'></i></div>";
									$html[] = "</a></div>";
								}
								
							$html[] = "</div>";

						$html[] = "</div>";

					$html[] = "</div>";

				$html[] = "</div>";
				$html[] = "<div class='col-md-4 col-12'>";

					$html[] = "<div class='sticky-top mt-5'>";
						$html[] = "<div class='sidebar d-none d-md-block d-print-none'>";
							$html[] = "<div class='card'>";
								$html[] = "<div class='card-body agent-form'>";

									$html[] = "<div class='inquiry-form-container'>";
										$html[] = "<h2 class='card-title text-center'><i class='ti ti-message'></i> Send Message</h2>";

										if($data['account']['logo'] != "") { $logo = $data['account']['logo'];
										}else { $logo = CDN."images/blank-profile.png"; }

										$html[] = "<div class='row justify-content-center'>";
											$html[] = "<div class='col-lg-12 col-md-12 col-sm-12'>";
												$html[] = "<a href='".url("AccountsController@profile", ["id" => $data['account']['account_id'], "name" => sanitize($data['account']['account_name']['firstname']."-".$data['account']['account_name']['lastname']) ])."' class='text-decoration-none'>";
													$html[] = "<div class='d-flex py-1 mb-4 align-items-center'>";
														$html[] = "<span class='avatar avatar-xl me-3 rounded-circle' style='background-image: url(".$logo.")'></span>";
														$html[] = "<div class='flex-fill'>";
															$html[] = "<div class='font-weight-medium'>";
																$html[] = $data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix'];
															$html[] = "</div>";
															$html[] = "<div class='text-muted'>".$data['account']['profession']."</div>";
															if($data['account']['company_name'] != "") { $html[] = "<div class='text-muted'>".$data['account']['company_name']."</div>"; }
															$html[] = "<div class='text-muted'>Member Since ".date("Y", $data['account']['registered_at'])."</div>";
														$html[] = "</div>";
													$html[] = "</div>";
												$html[] = "</a>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='loader-container text-center d-none'>";
											$html[] = "<div class='d-flex gap-3 align-items-center justify-content-center'>";
												$html[] = "<span class='loader'></span>";
												$html[] = "<p class='p-0 m-0'>Sending message, please wait...</p>";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<form id='inquiry-form' action='".url("ListingsController@sendMessage", ["id" => $data['listing_id']])."' method='POST'>";

											$html[] = "<input type='hidden' name='title' value='".$data['listing']['title']."' />";
											$html[] = "<input type='hidden' name='account_email' value='".$data['account']['email']."' />";
											$html[] = "<input type='hidden' name='account_id' value='".$data['account_id']."' />";
											$html[] = "<input type='hidden' name='listing_id' value='".$data['listing_id']."' />";
											$html[] = "<input type='hidden' name='listing_name' value='".$data['listing']['name']."' />";
											$html[] = "<input type='hidden' name='preferences[type]' value='".$data['listing']['type']."' />";
											$html[] = "<input type='hidden' name='preferences[bedroom]' value='".$data['listing']['bedroom']."' />";
											$html[] = "<input type='hidden' name='preferences[bathroom]' value='".$data['listing']['bathroom']."' />";
											$html[] = "<input type='hidden' name='preferences[parking]' value='".$data['listing']['parking']."' />";
											$html[] = "<input type='hidden' name='preferences[lot_area]' value='".$data['listing']['lot_area']."' />";
											$html[] = "<input type='hidden' name='preferences[category]' value='".$data['listing']['category']."' />";
											$html[] = "<input type='hidden' name='preferences[price]' value='".$data['listing']['price']."' />";
											$html[] = "<input type='hidden' name='preferences[address][barangay]' value='".$data['listing']['address']['barangay']."' />";
											$html[] = "<input type='hidden' name='preferences[address][municipality]' value='".$data['listing']['address']['municipality']."' />";
											$html[] = "<input type='hidden' name='preferences[address][province]' value='".$data['listing']['address']['province']."' />";
											$html[] = "<input type='hidden' name='preferences[address][region]' value='".$data['listing']['address']['region']."' />";
											$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
											
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
														$html[] = "<p class='m-0 p-0'>Enter security code: <span class='fw-bold valid-security-code'>".$security_code."</span></p>";
													$html[] = "</div>";

													$html[] = "<input type='hidden' name='security_code' id='security_code' value='".$security_code."' />";

													$html[] = "<div class='form-floating mb-3'>";
														$html[] = "<input type='text' name='input_security_code' id='input_security_code' value='' class='form-control' placeholder='Enter security code' />";
														$html[] = "<label class='input_security_code'>Security Code</label>";
													$html[] = "</div>";
												$html[] = "</div>";

											$html[] = "</div>";

											$html[] = "<div class='response'>";
												$html[] = getMsg();
											$html[] = "</div>";			

											$html[] = "<p class='mt-4 text-muted fs-12'>By clicking send message, you accept ".CONFIG['site_name']." <a href='".url("PagesController@terms")."'>Terms and Condition</a> and <a href='".url("PagesController@privacy")."'>Privacy Policy</a> page.</p>";
											$html[] = "<span class='mb-3 btn btn-primary btn-send-message w-100'><i class='ti ti-send me-1'></i> Send Message</span>";
											

										$html[] = "</form>";
										
									$html[] = "</div>";

								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";


						/*** ADS CONTAINER */
						$html[] = "<div class='d-none px-2 ARTICLE_VIEW_SIDEBAR'>";
							$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
								$html[] = "<div class='card bg-dark-lt mt-2 rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:280px;'>";
									$html[] = "<div class='loader'></div>";
									$html[] = "<p>Loading Ads</p>";
								$html[] = "</div>";
							$html[] = "</a>";
						$html[] = "</div>";
						/*** END ADS CONTAINER */
					$html[] = "</div>";

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