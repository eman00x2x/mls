<?php

$html[] = "<style type=\"text/css\">
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
				$html[] = "<td style='width:150px;'><img src='".CDN."images/logo.png' style='width:150px' /></td>";
				$html[] = "<td>";
					$html[] = "<h1 style='padding:0; margin:0 0 0 15px;'>".CONFIG['site_name']."</h1>";
				$html[] = "</td>";
			$html[] = "</tr>";
			$html[] = "</table>";

			$html[] = "<div style='position:absolute; top:20px; right:20px;'>";
				$html[] = "<qrcode value='".url("ListingsController@view", ["name" => $data['listing']['name']], ["mls" => "1"])."' ec='Q' style='padding:1px; border: 1px solid #e1e1e1; width: 30mm;'></qrcode>";
				$html[] = "<br/><span style='font-size:10px; margin-top:5px;'>Scan QR to visit the page</span>";
			$html[] = "</div>";

		$html[] = "</div>";
		$html[] = "<span style=' margin-bottom:20px; color:#aaa; font-style: italic; font-size: 12px;'><img src='".CDN."images/icons/world.png' style='width:12px; color: #aaa;' /> ".url("ListingsController@mls", ["name" => $data['listing']['name']], ["mls" => "1"])."</span>";
		
		$html[] = "<h1 style='margin:0; padding:0; font-size:18px;'>[Id: ".$data['listing']['listing_id']."] ".$data['listing']['title']."</h1>";
		$html[] = "<p style='margin:0; padding:0;'><span><img src='".CDN."images/icons/map-pin.png' style='width:24px;' /> ".$data['listing']['address']['municipality'].", ".$data['listing']['address']['province']."</span></p>";
        
        $html[] = "<div style='margin:15px 0 0; padding:0 15px;'>";
	
			$html[] = "<table>";
			$html[] = "<tr>";
                $html[] = "<td>";
					$html[] = "<div class='images main-image' style='background-image: url(".$data['listing']['thumb_img'].");'></div>";
				$html[] = "</td>";
                $html[] = "<td>";

					$html[] = "<table style='margin:0; padding:0;'>";
					$html[] = "<tr>";

						for($i=0; $i<count($data['listing']['images']); $i++) {

							$html[] = "<td>";
								if($data['listing']['thumb_img'] != $data['listing']['images'][$i]['url']) {
									$html[] = "<div class='images sub-images' style='background-image: url(".$data['listing']['images'][$i]['url'].");'></div>";
								}
							$html[] = "</td>";

							if($i % 2 == 0) {}else {
								$html[] = "</tr>";
								$html[] = "<tr>";
							}

						}

					$html[] = "</tr>";
					$html[] = "</table>";

                $html[] = "</td>";
            $html[] = "</tr>";
            $html[] = "</table>";

        $html[] = "</div>";

		$html[] = "<div style='margin-bottom: 15px; font-size:14px;  padding:25px 15px;'>";

			$html[] = "<table style='width:700px;'>";
			$html[] = "<tr>";
				$html[] = "<td colspan='2' style='border-bottom:1px solid #e1e1e1; font-weight:bold;'>".$data['listing']['category']."</td>";
			$html[] = "</tr>";
			if($data['listing']['floor_area'] > 0) {
				$html[] = "<tr>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Floor Area</td>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/ruler.png' style='width:18px;' /> ".number_format($data['listing']['floor_area'],0)." sqm</td>";
				$html[] = "</tr>";
			}
			
			if($data['listing']['lot_area'] > 0) {
				$html[] = "<tr>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Lot Area</td>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/ruler.png' style='width:18px;' /> ".number_format($data['listing']['lot_area'],0)." sqm</td>";
				$html[] = "</tr>";
			}
			
			if($data['listing']['unit_area'] > 0) {
				$html[] = "<tr>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Unit Area</td>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/ruler-measure.png' style='width:18px;' /> ".number_format($data['listing']['unit_area'],0)." sqm</td>";
				$html[] = "</tr>";
			}

			if($data['listing']['bedroom'] != "") {
				$html[] = "<tr>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Bedroom</td>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/bed.png' style='width:18px;' /> ".$data['listing']['bedroom']."</td>";
				$html[] = "</tr>";
			}

			if($data['listing']['bathroom'] != "") {
				$html[] = "<tr>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Bathroom</td>";
					$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/bath.png' style='width:18px;' /> ".$data['listing']['bathroom']."</td>";
				$html[] = "</tr>";
			}

			$html[] = "<tr>";
				$html[] = "<td style='border-bottom:1px solid #e1e1e1; text-align: left; '>Car Garage</td>";
				$html[] = "<td style='border-bottom:1px solid #e1e1e1;'><img src='".CDN."images/icons/car-garage.png' style='width:18px;' /> ".($data['listing']['parking'] > 0 ? $data['listing']['parking'] : "No Parking")."</td>";
			$html[] = "</tr>";
			$html[] = "</table>";


			/** AMENITIES */
			$html[] = "<div style='font-size:14px; width:700px;'>";
				$html[] = "<h3 style='margin:0; padding:0;'>Amenities</h3>";
				
					$amenities = explode(",",$data['listing']['amenities']);
					foreach($amenities as $amenity) {
						$html[] = "<span>";
							$html[] = " <img src='".CDN."images/icons/checks.png' style='width:18px;' /> $amenity, ";
						$html[] = "</span>";
					}
						
			$html[] = "</div>";
			/** AMENITIES END */

		$html[] = "</div>";

		$html[] = "<div class='description' style=''>";
        	$html[] = "<h3 style='margin:0 0 10px; padding:0;'>Description</h3>";
            $html[] = $data['listing']['long_desc'];
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</page>";