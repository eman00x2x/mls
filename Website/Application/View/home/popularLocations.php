<?php

$html[] = "<div class='pb-5 my-5'>";
	$html[] = "<h2>Popular Locations</h2>";
	$html[] = "<div class='p-featured'>";

		if($data) {
			$html[] = "<div class='d-flex flex-wrap gap-3 justify-content-center'>";
			for($i=0; $i<count($data); $i++) {
				$html[] = "<div class='card' title='".$data[$i]['city']."'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<span class='fw-bold'>".$data[$i]['city']."</span>";
						/* $html[] = "<span class='d-block text-muted'>".$data[$i]['region']."</span>"; */
						$html[] = "<span class='d-block text-muted fs-12 mt-1'>".$data[$i]['total']." listings</span>";
						$html[] = "<a href='".url("ListingsController@buy", null, [
							"address[barangay]" => "",
							"address[municipality]" => $data[$i]['city'],
							"address[province]" => $data[$i]['province'],
							"address[region]" => $data[$i]['region']
						])."' class='stretched-link full-link'></a>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
			$html[] = "</div>";
		}

	$html[] = "</div>";
$html[] = "</div>";