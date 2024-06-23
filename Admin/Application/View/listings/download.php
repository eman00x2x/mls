<?php

$html[] = "
<style type=\"text/css\">
.images {
	background-color: #999;
	background-position: center;
	background-repeat: no-repeat;
}

.main-image {
	width:400px;
	height:350px;
	background-size: cover;
}

.sub-images {
	width: 150px;
	height: 112px;
	background-size: 150px !important;
	background-color: #f5f5f5;
}

.description p {
	margin:0;
	padding:0;
	font-size: 12px;
}
</style>";

$html[] = "<page style=''>";
    $html[] = "<div style='line-height:1.5;'>";

		$html[] = "<div style='border-bottom:2px solid #e1e1e1; margin-bottom:5px; color:#aeaeae;'>";
			$html[] = "<table>";
			$html[] = "<tr>";
				$html[] = "<td style='width:50px;'><img src='".CDN."images/logo.png' style='width:50px' /></td>";
				$html[] = "<td>";
					$html[] = "<h1 style='padding:0; margin:0 0 0 15px;'>".CONFIG['site_name']."</h1>";
				$html[] = "</td>";
			$html[] = "</tr>";
			$html[] = "</table>";

			$html[] = "<div style='position:absolute; top:20px; right:20px;'>";
				$html[] = "<qrcode value='".WEBDOMAIN."p-".$data['listing']['name']."?mls=1' ec='Q' style='padding:1px; border: 1px solid #e1e1e1; width: 30mm;'></qrcode>";
				$html[] = "<br/><span style='font-size:10px; margin-top:5px;'>Scan QR to visit the page</span>";
			$html[] = "</div>";

		$html[] = "</div>";
		$html[] = "<span style=' margin-bottom:20px; color:#aaa; font-style: italic; font-size: 12px;'><img src='".CDN."images/icons/world.png' style='width:12px; color: #aaa;' /> ".WEBDOMAIN."p-".$data['listing']['name']."?mls=1</span>";
		
		$html[] = "<h1 style='margin:0; padding:0; font-size:18px;'>[Id: ".$data['listing']['listing_id']."] ".$data['listing']['title']."</h1>";
		$html[] = "<p style='margin:0; padding:0;'><span><img src='".CDN."images/icons/map-pin.png' style='width:24px;' /> ".$data['listing']['address']['municipality'].", ".$data['listing']['address']['province']."</span></p>";
        
        $html[] = "<div style='margin:15px 0 0; padding:5px 15px;'>";
	
			$html[] = "<table>";
			$html[] = "<tr>";
                $html[] = "<td>";
					$html[] = "<div class='images main-image' style='background-image: url(".$data['listing']['thumb_img'].");'></div>";
				$html[] = "</td>";
                $html[] = "<td>";

					$html[] = "<table style='margin:0; padding:0;'>";
					$html[] = "<tr>";

						if($data) {
							/* for($i=0; $i<count($data['listing']['images']); $i++) {

								$html[] = "<td>";
									if($data['listing']['thumb_img'] != $data['listing']['images'][$i]['url']) {
										$html[] = "<div class='images sub-images' style='background-image: url(".$data['listing']['images'][$i]['url'].");'></div>";
									}
								$html[] = "</td>";

								if($i % 2 == 0) {}else {
									$html[] = "</tr>";
									$html[] = "<tr>";
								}

							} */
						}

					$html[] = "</tr>";
					$html[] = "</table>";

                $html[] = "</td>";
            $html[] = "</tr>";
            $html[] = "</table>";

        $html[] = "</div>";

		$html[] = "<div style='margin-bottom: 15px; font-size:14px; padding:5px 15px;'>";
			$html[] = "<div style='font-size:14px; width:700px;'>";
			
				$html[] = "<h3 style='margin:20px 0 0 0; padding:0;'>Technical Details</h3>";
				$html[] = "<table style='margin:0 !important; padding:0 !important;'>";
				$html[] = "<tr>";
						
					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Category</div>";
						$html[] = $data['listing']['category'];
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Lot Area</div>";
						if($data['listing']['floor_area'] > 0) {
							$html[] = "<img src='".CDN."images/icons/maximize.png' style='width:18px;' /> ".number_format($data['listing']['lot_area'],0)." sqm";
						}else { $html[] = "<span style='color:#555;'>N/A</span>"; }
					$html[] = "</td>";
					
					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Floor Area</div>";
						if($data['listing']['floor_area'] > 0) {
							$html[] = "<img src='".CDN."images/icons/ruler.png' style='width:18px;' /> ".number_format($data['listing']['floor_area'],0)." sqm";
						}else { $html[] = "<span style='color:#555;'>N/A</span>"; }
					$html[] = "</td>";

				$html[] = "</tr>";
				
				$html[] = "<tr>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Bedroom</div>";
						if($data['listing']['bedroom'] > 0 && $data['listing']['bedroom'] != 'Studio') {
							$html[] = "<img src='".CDN."images/icons/bed.png' style='width:18px;' /> ".$data['listing']['bedroom']."";
						}else { $html[] = "<span style='color:#555;'>N/A</span>"; }
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Bathroom</div>";
						if($data['listing']['bathroom'] > 0) {
							$html[] = "<img src='".CDN."images/icons/bath.png' style='width:18px;' /> ".$data['listing']['bathroom']."";
						}else { $html[] = "<span style='color:#555;'>N/A</span>"; }
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:195px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Car Garage</div>";
						if($data['listing']['parking'] > 0) {
							$html[] = "<img src='".CDN."images/icons/car-garage.png' style='width:18px;' /> ".$data['listing']['parking']." Car slot";
						}else { $html[] = "<span style='color:#555;'>No Parkking Slot</span>"; }
					$html[] = "</td>";

				$html[] = "</tr>";
				$html[] = "</table>";

				/** PAYMENT DETAILS */
				$html[] = "<h3 style='margin:20px 0 0 0; padding:0;'>Payment Details</h3>";
				$html[] = "<table style=''>";
				$html[] = "<tr>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Selling Price</div>";
						$html[] = number_format($data['listing']['price'],0);
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Reservation / Option Money</div>";
						$html[] = number_format($data['listing']['reservation'],0);
					$html[] = "</td>";

				$html[] = "</tr>";
				$html[] = "<tr>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Eligible for Bank Loan?</div>";
						$html[] = ((isset($data['listing']['payment_details']['bank_loan']) ? $data['listing']['payment_details']['bank_loan'] : 0) == 1 ? "Yes" : "No");
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Eligible for Pag-Ibig Housing Loan?</div>";
						$html[] = ((isset($data['listing']['payment_details']['pagibig_loan']) ? $data['listing']['payment_details']['pagibig_loan'] : 0) == 1 ? "Yes" : "No");
					$html[] = "</td>";

				$html[] = "</tr>";


				$html[] = "<tr>";
					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'>";
						$html[] = "<div style='color:#555; margin-bottom:5px; font-size:12px;'>Assume Balance?</div>";
						$html[] = ((isset($data['listing']['payment_details']['assume_balance']) ? $data['listing']['payment_details']['assume_balance'] : 0) == 1 ? "Yes" : "No");
					$html[] = "</td>";

					$html[] = "<td style='padding:10px; border: 1px solid #e1e1e1; width:315px;'></td>";
				$html[] = "</tr>";
				$html[] = "</table>";
			/** PAYMENT DETAILS END */

			/** AMENITIES */
				$html[] = "<h3 style='margin:20px 0 0 0; padding:0;'>Amenities</h3>";
				$amenities = explode(",",$data['listing']['amenities']);
				foreach($amenities as $amenity) {
					$html[] = "<span>";
						$html[] = " <img src='".CDN."images/icons/checks.png' style='width:18px;' /> $amenity, ";
					$html[] = "</span>";
				}
				/** AMENITIES END */

			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div style='margin-bottom: 15px; font-size:14px; padding:5px 15px;'>";
			$html[] = "<div style='font-size:14px; width:700px;'>";

				$html[] = "<div style=''>";
					$html[] = "<h3 style='margin:20px 0 0 0; padding:0;'>Description</h3>";
					$html[] = $data['listing']['long_desc'];
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</page>";