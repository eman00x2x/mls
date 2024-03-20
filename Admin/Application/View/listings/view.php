<?php

$buttons = function() use (&$data) {
    
    if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {
		$html[] = "<span class='btn btn-md btn-danger ms-1 mb-2 btn-cancel-handshake row_listings_".$data['listing']['listing_id']."' data-row='row_listings_".$data['listing']['listing_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
    }else {
        $html[] = "<span class='btn btn-md btn-primary me-1 btn-requestHandshake row_listings_".$data['listing']['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
    }  

    return implode("",$html);

};

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
						$html[] = "<a class='ajax btn btn-dark' href='".url("MlsController@downloadPDFFormat", ["id" => $data['listing']['listing_id']])."'><i class='ti ti-download me-2'></i> Download</a>";
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row'>";

			$html[] = "<div class='col-md-9 col-12'>";
                $html[] = "<div class='box-container mb-3'>";

                    $html[] = "<h2 class='mt-0'>[Id: ".$data['listing']['listing_id']."] ".$data['listing']['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listing']['address']['municipality'].", ".$data['listing']['address']['province']."</small></h2>";

					$html[] = "<div class='my-3 p-2'>";
						$html[] = "<div class='row gap-2 justify-content-center'>";
							$html[] = "<div class='col-md-8 col-12'>";

								$html[] = "<div class=''>";
									$html[] = "<a data-fslightbox data-type='image' href='".$data['listing']['thumb_img']."'>";
										$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-image: url(".$data['listing']['thumb_img'].")'>";
											$html[] = "<span style='position: absolute; top:-1px; left: -1px;' class='fw-bold bg-white text-dark p-2'><i class='ti ti-photo'></i> +".count($data['listing']['images'])."</span>";
										$html[] = "</div>";
									$html[] = "</a>";

									$html[] = "<div class='mb-3'>";
										if($data['listing']['images']) {
											$html[] = "<div class='d-flex gap-2 justify-content-center overflow-auto'>";
											for($i=0; $i<count($data['listing']['images']); $i++) {
												if($i <= 8) {
													if($data['listing']['thumb_img'] != $data['listing']['images'][$i]['url']) {
														$html[] = "<a data-fslightbox data-type='image' href='".$data['listing']['images'][$i]['url']."'>";
															$html[] = "<div class='avatar avatar-xl' style='position:relative; background-image: url(".$data['listing']['images'][$i]['url'].")'>";
																
																if($i == 5) {
																	$html[] = "<div class='overlay d-md-none d-sm-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
																		$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".(count($data['listing']['images']) - 5)."</span>";
																	$html[] = "</div>";
																}
															
																if($i == 6) {
																	$html[] = "<div class='overlay d-none d-md-block' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'>";
																		$html[] = "<span class='text-white d-block mt-4' style='z-index: 2;'>+".(count($data['listing']['images']) - 6)."</span>";
																	$html[] = "</div>";
																}

															$html[] = "</div>";
														$html[] = "</a>";
													}
												}else {
													$html[] = "<a data-fslightbox data-type='image' class='d-none' href='".$data['listing']['images'][$i]['url']."'></a>";
												}
											}
											$html[] = "</div>";
										}
									$html[] = "</div>";
								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

                    $html[] = "<div class='mb-3'>";
                        $html[] = "<div class='row'>";
                            $html[] = "<div class='col-4'>";
                                $html[] = "<table>";
                                $html[] = "<tr><td colspan='2'>".$data['listing']['category']."</td></tr>";
								if($data['listing']['floor_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Floor Area</td>	<td><i class='ti ti-maximize me-2'></i> ".number_format($data['listing']['floor_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['lot_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Lot Area</td>		<td><i class='ti ti-maximize me-2'></i> ".number_format($data['listing']['lot_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['unit_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Unit Area</td>		<td><i class='ti ti-maximize me-2'></i> ".number_format($data['listing']['unit_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['bedroom'] != "" && $data['listing']['bedroom'] != 0) { $html[] = "<tr><td style='width:120px;'>Bedroom</td>		<td><i class='ti ti-bed me-2'></i> ".$data['listing']['bedroom']."</td></tr>"; }
                                if($data['listing']['bathroom'] != "" && $data['listing']['bathroom'] != 0) { $html[] = "<tr><td style='width:120px;'>Bathroom</td>		<td><i class='ti ti-bath me-2'></i> ".$data['listing']['bathroom']."</td></tr>"; }
                                if($data['listing']['parking'] > 0) { $html[] = "<tr><td style='width:120px;'>Car Garage</td>		<td><i class='ti ti-car-garage me-2'></i> ".($data['listing']['parking'] > 0 ? $data['listing']['parking'] : "No Parking")."</td></tr>"; }
                                $html[] = "</table>";
                            $html[] = "</div>";

							$html[] = "<div class='col-8'>";
								$html[] = "<h3 class='mb-0'><i class='ti ti-home-shield me-2'></i> Amenities</h3>";
                    			$html[] = "<p class='mb-2'>".str_replace(",",", ", ucwords($data['listing']['amenities']))."</p>";
								$html[] = "<p class=''><i class='ti ti-tags me-2'></i> Tags: ".implode(", ",$data['listing']['tags'])."</p>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<span class='text-muted d-block'>Selling Price</span>";
									$html[] = "<p class='p-0 m-0 fw-bold fs-30'><img src='".CDN."images/icons/currency-peso.png' style='width:32px;' />".number_format($data['listing']['price'],0)."</p>";
								$html[] = "</div>";

                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";

					/** AMENITIES */
						$html[] = "<div class='amenities mt-5'>";
							$html[] = "<h3><i class='ti ti-home-shield me-1'></i> Amenities</h3>";
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
							$html[] = "<h3><i class='ti ti-wallet me-1'></i> Payment Details</h3>";
							$html[] = "<table class='table'>";
							$html[] = "<tr>";
								$html[] = "<td>Selling Price</td>";
								$html[] = "<td>&#8369;".number_format($data['listing']['price'],0)."</td>";
							$html[] = "</tr>";
							$html[] = "<tr>";
								$html[] = "<td>Reservation Fee / Option Money</td>";
								$html[] = "<td>&#8369;".number_format($data['listing']['reservation'],0)."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Option Money Duration</td>";
								$html[] = "<td>".$data['listing']['payment_details']['option_money_duration']." days</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Mode of Payment</td>";
								$html[] = "<td>".$data['listing']['payment_details']['payment_mode']."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Allocation of Taxes</td>";
								$html[] = "<td>".$data['listing']['payment_details']['tax_allocation']."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Eligible for Bank Loan</td>";
								$html[] = "<td>".($data['listing']['payment_details']['bank_loan'] == 1 ? "Yes" : "No")."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Eligible for Pag-Ibig Housing Loan</td>";
								$html[] = "<td>".($data['listing']['payment_details']['pagibig_loan'] == 1 ? "Yes" : "No")."</td>";
							$html[] = "</tr>";

							$html[] = "<tr>";
								$html[] = "<td>Assume Balance</td>";
								$html[] = "<td>".($data['listing']['payment_details']['assume_balance'] == 1 ? "Yes" : "No")."</td>";
							$html[] = "</tr>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						/** PAYMENT DETAILS END */

                    $html[] = "<div class='mb-5 pb-5'>";
                        $html[] = "<h3 class='mt-3 mb-2'>Description</h3>";
                        $html[] = "<div class='mt-2'>";
                            $html[] = $data['listing']['long_desc'];
                        $html[] = "</div>";
                    $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

			$html[] = "<div class='col-md-3 col-12 mls-sidebar'>";

				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body text-center'>";
						$html[] = "<div class='mb-3'>";
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
						
						if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {
							if($data['handshake']['handshake_status'] == "accepted") {
								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-certificate me-1'></i> Authority:</span> <strong>".$data['listing']['other_details']['authority_type']."</strong></div>";
								$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-license me-1'></i> Commission Share:</span> <strong>".$data['listing']['other_details']['com_share']."%</strong></div>";
							}
						}

						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-status-change me-1'></i> Status:</span> <strong>".$status[$data['listing']['status']]."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Posted since:</span> <strong>".date("F d, Y", $data['listing']['date_added'])."</strong></div>";
						$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Modified at:</span> <strong>".date("F d, Y", $data['listing']['last_modified'])."</strong></div>";
					$html[] = "</div>";
				$html[] = "</div>";

				if($data['handshake'] && in_array($_SESSION['user_logged']['account_id'], [$data['handshake']['requestor_account_id'], $data['handshake']['requestee_account_id']])) {
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";
							
							$html[] = "<div class='card-title'>Requestor</div>";
							$html[] = "<div class='mb-3'>";
								$html[] = "<div class='d-flex lh-1 text-reset p-0'>";
									$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['handshake']['requestor_details']['logo'].")'></span>";
									$html[] = "<div class='ms-2'>";
										$html[] = "<div class='fw-bold'>".$data['handshake']['requestor_details']['account']['prefix']." ".$data['handshake']['requestor_details']['account']['firstname']." ".$data['handshake']['requestor_details']['account']['lastname']." ".$data['handshake']['requestor_details']['account']['suffix']."</div>";
										$html[] = "<div class='mt-1 small'>".$data['handshake']['requestor_details']['profession']."</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-device-mobile me-1'></i> Mobile:</span> <strong>".$data['handshake']['requestor_details']['mobile_number']."</strong></div>";
							$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-mail me-1'></i> Email:</span> <strong>".$data['handshake']['requestor_details']['email']."</strong></div>";
							
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='card-title'>Handshake Details</div>";
							$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-status-change me-1'></i> Status:</span> <strong>".strtoupper($data['handshake']['handshake_status'])."</strong></div>";
							$html[] = "<div class='mb-2'><span class='text-muted me-1'><i class='ti ti-clock me-1'></i> Status Date:</span> <strong>".date("F d, Y", $data['handshake']['handshake_status_date'])."</strong></div>";
						$html[] = "</div>";
					$html[] = "</div>";
				}

				$html[] = "<div class='text-center mb-4 d-md-block d-none'>";
					$html[] = $buttons();
				$html[] = "</div>";
			
            $html[] = "</div>";

        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='btn-wrap fixed-bottom d-sm-block d-md-none'>";
	$html[] = "<div class='text-center '>";
		$html[] = $buttons();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";