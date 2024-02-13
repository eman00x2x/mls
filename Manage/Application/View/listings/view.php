<?php

$buttons = function() use (&$data) {
    
    if($data['handshake'] && $data['handshake']['requestee_account_id'] == $_SESSION['account_id']) {
		$html[] = "<span class='btn btn-md btn-danger ms-1 btn-cancel-handshake row_listings_".$data['listing']['listing_id']."' data-row='row_listings_".$data['listing']['listing_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
    }else {
        $html[] = "<span class='btn btn-md btn-primary me-1 btn-requestHandshake row_listings_".$data['listing']['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing']['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
    }  

    return implode("",$html);

};

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
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

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$html[] = "<div class='row'>";

            $html[] = "<div class='col-md-3 col-12 mls-sidebar'>";
                $html[] = "<div class='box-container mb-3'>";
                    $html[] = "<h3 class=''>Broker Details</h3>";
                    $html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['account']['logo'].")'></div>";

                    $html[] = "<table class='table table-sm mt-3'>";
                    $html[] = "<tr>";
                        $html[] = "<td>Name</td>";
                        $html[] = "<td>".$data['account']['firstname']." ".$data['account']['lastname']."</td>";
                    $html[] = "</tr>";
					$html[] = "<tr>";
                        $html[] = "<td>Registration Date</td>";
                        $html[] = "<td>".date("F d, Y",$data['account']['registration_date'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

                    $status[1] = "Available";
                    $status[2] = "Sold";

                    $html[] = "<h3 class='mt-3 mb-0'>Posting Details</h3>";
                    $html[] = "<table class='table table-sm mt-2'>";
                    $html[] = "<tr>";
                        $html[] = "<td>Status</td>";
                        $html[] = "<td>".$status[$data['listing']['status']]."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>Last Modified</td>";
                        $html[] = "<td>".date("F d, Y",$data['listing']['last_modified'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

					$html[] = "<div class='btn-wrap text-center d-none d-md-block'>";
						$html[] = "<div class='btn-list'>";
                            if($data['account']['account_id'] != $_SESSION['account_id']) {
                                $html[] = $buttons();
                                $html[] = "<a class='btn btn-outline-primary' href='".url("MessagesController@conversation", ["participants" => base64_encode(json_encode(array($data['listing']['account_id'],$_SESSION['account_id'])))], ["listing_id" => $data['listing']['listing_id'], "name" => $data['listing']['title']])."'><i class='ti ti-send me-2'></i> Send Message</a>";
                            }
						$html[] = "</div>";
	                $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

			$html[] = "<div class='col-md-9 col-12'>";
                $html[] = "<div class='box-container mb-3'>";

                    $html[] = "<h2 class='mt-0'>[Id: ".$data['listing']['listing_id']."] ".$data['listing']['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listing']['address']['municipality'].", ".$data['listing']['address']['province']."</small></h2>";

                    $html[] = "<div class='slider'>";
                        if($data['listing']['images']) {
                            for($i=0; $i<count($data['listing']['images']); $i++) {
                                $html[] = "<div><img src='".$data['listing']['images'][$i]['url']."' /></div>";
                            }
                        }
                    $html[] = "</div>";

                    $html[] = "<div class='mb-3'>";
                        $html[] = "<div class='row'>";
                            $html[] = "<div class='col-4'>";
                                $html[] = "<table>";
                                $html[] = "<tr><td colspan='2'>".$data['listing']['category']."</td></tr>";
								if($data['listing']['floor_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Floor Area</td>	<td><i class='ti ti-ruler me-2'></i> ".number_format($data['listing']['floor_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['lot_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Lot Area</td>		<td><i class='ti ti-ruler me-2'></i> ".number_format($data['listing']['lot_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['unit_area'] > 0) { $html[] = "<tr><td style='width:120px;'>Unit Area</td>		<td><i class='ti ti-ruler-measure me-2'></i> ".number_format($data['listing']['unit_area'],0)." sqm</td></tr>"; }
                                if($data['listing']['bedroom'] != "") { $html[] = "<tr><td style='width:120px;'>Bedroom</td>		<td><i class='ti ti-bed me-2'></i> ".$data['listing']['bedroom']."</td></tr>"; }
                                if($data['listing']['bathroom'] != "") { $html[] = "<tr><td style='width:120px;'>Bathroom</td>		<td><i class='ti ti-bath me-2'></i> ".$data['listing']['bathroom']."</td></tr>"; }
								$html[] = "<tr><td style='width:120px;'>Car Garage</td>       										<td><i class='ti ti-car-garage me-2'></i> ".($data['listing']['parking'] > 0 ? $data['listing']['parking'] : "No Parking")."</td></tr>";
                                $html[] = "</table>";
                            $html[] = "</div>";

							$html[] = "<div class='col-8'>";
								$html[] = "<h3 class='mb-0'><i class='ti ti-key me-2'></i> Amenities</h3>";
                    			$html[] = "<p class='mb-2'>".str_replace(",",", ", ucwords($data['listing']['amenities']))."</p>";
								$html[] = "<p class=''><i class='ti ti-tags me-2'></i> Tags: ".implode(", ",$data['listing']['tags'])."</p>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<span class='text-muted d-block'>Selling Price</span>";
									$html[] = "<p class='p-0 m-0 fw-bold fs-30'><img src='".CDN."images/icons/currency-peso.png' style='width:32px;' />".number_format($data['listing']['price'],0)."</p>";
								$html[] = "</div>";

                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<div class='mb-3'>";
                        $html[] = "<h3 class='mt-3 mb-2'>Description</h3>";
                        $html[] = "<div class='mt-2'>";
                            $html[] = $data['listing']['long_desc'];
                        $html[] = "</div>";
                    $html[] = "</div>";

                    if($data['handshake'] && $data['handshake']['requestee_account_id'] == $_SESSION['account_id']) {
                        $html[] = "<div class='mb-3 border p-2'>";
                            $html[] = "<h3 class='mt-3 mb-0'>Handshake Details</h3>";
                            $html[] = "<table class='table table-borderless mb-0'>";
							$html[] = "<tr>";
								$html[] = "<td class='align-middle'>";
							        $html[] = "<p><span class='d-block text-muted fs-12'>Status</span> ".strtoupper($data['handshake']['handshake_status'])." <span class='d-block text-muted fs-11'> Since: ".date("F d, Y", $data['handshake']['handshake_status_date'])."</span></p>";
							    $html[] = "</td>";
							    $html[] = "<td class='align-middle'>";
							        $html[] = "<p><span class='d-block text-muted fs-12'>Requestor</span> ".$data['handshake']['requestor_details']['firstname']." ".$data['handshake']['requestor_details']['lastname']." <span class='d-block text-muted fs-11'>".$data['handshake']['requestor_details']['profession']." - ".$data['handshake']['requestor_details']['real_estate_license_number']."</span></p>";
							    $html[] = "</td>";
							    $html[] = "<td class='align-middle'>";
							        $html[] = "<p><span class='d-block text-muted fs-12'>Mobile Number</span> ".$data['handshake']['requestor_details']['mobile_number']."</p>";
							    $html[] = "</td>";
							    $html[] = "<td class='align-middle'>";
							        $html[] = "<p><span class='d-block text-muted fs-12'>Email</span> ".$data['handshake']['requestor_details']['email']."</p>";
							    $html[] = "</td>";
							    $html[] = "<td class='align-middle'>";
							        $html[] = "<p><span class='d-block text-muted fs-12'>Registered Since</span> ".date("F d, Y", $data['handshake']['requestor_details']['registration_date'])."</p>";
							    $html[] = "</td>";
							$html[] = "</tr>";

                            /* $html[] = "<tr>";
                                $html[] = "<td class='align-middle'>";
                                    $html[] = "<p><span class='d-block text-muted fs-12'>Requestor</span> ".$data['handshake']['firstname']." ".$data['handshake']['lastname']." <span class='d-block text-muted fs-11'>".$data['handshake']['profession']." - ".$data['handshake']['real_estate_license_number']."</span></p>";
                                $html[] = "</td>";
                            $html[] = "</tr>"; */
							
                            $html[] = "</table>";
                        $html[] = "</div>";
                    }

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