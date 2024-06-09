<?php

if($data) {
	$html[] = "<div class='pb-5 my-5'>";

		$html[] = "<div class='text-center pb-3'>";
			$html[] = "<h2 class='mb-0 display-5 text-blue'>Highly Demanded Real Estate Markets</h2>";
			$html[] = "<p>Discover Our Most Popular Locations</p>";
		$html[] = "</div>";

		$html[] = "<div class='p-featured mt-3'>";

			$c=0;
			$html[] = "<div class='d-flex flex-wrap gap-3 justify-content-center'>";
			for($i=0; $i<count($data); $i++) { $c++;
				$html[] = "<div class='card' title='".$data[$i]['city']."'>";
					$html[] = "<div class='card-body p-3'>";

						if(!file_exists(ROOT."/Cdn/images/popular-locations/popular-location-image-$c.jpg")) { 
							$image = CDN."images/popular-locations/popular-location-image-1.jpg";
						}else {
							$image = CDN."images/popular-locations/popular-location-image-$c.jpg";
						}

						$html[] = "<div class='d-flex gap-3'>";
							$html[] = "<div class='avatar bg-blue' style='background-image: url(".$image.")'></div>";

							$html[] = "<div class='text-start'>";
								$html[] = "<span class='fw-bold'>".$data[$i]['city']."</span>";
								$html[] = "<span class='d-block text-muted fs-12'>".$data[$i]['total']." listings</span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<a href='".url("ListingsController@buy", null, [
							"address[barangay]" => "",
							"address[municipality]" => str_replace(" ","+", $data[$i]['city']),
							"address[province]" => str_replace(" ","+", $data[$i]['province']),
							"address[region]" => str_replace(" ","+", $data[$i]['region']),
						])."' class='stretched-link full-link'></a>";
					$html[] = "</div>";
				$html[] = "</div>";

				
			}
			$html[] = "</div>";
			

		$html[] = "</div>";
	$html[] = "</div>";
}