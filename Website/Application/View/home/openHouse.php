<?php

if($data) {
	$html[] = "<div class='pb-5 my-5'>";

		$html[] = "<div class='text-center pb-3'>";
			$html[] = "<h2 class='mb-0 display-5 text-highlight'>Open House</h2>";
			$html[] = "<p>Exploring Homes: Inside Open House</p>";
		$html[] = "</div>";

		$html[] = "<div class='mt-3'>";
			
			$html[] = "<div class='row'>";
			for($i=0; $i<count($data); $i++) {
				$html[] = "<div class='col-lg-3 col-md-3 col-sm-12 '>";
					$html[] = "<div class='card mb-4' title='".$data[$i]['subject']."'>";
						$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top bg-highlight' style='height:150px; background-image: url(".$data[$i]['attachment'].");'></div>";
						$html[] = "<div class='card-body mb-0 pb-2'>";
							
							$html[] = "<h3 class='mb-0'>".$data[$i]['subject']."</h3>";
							$html[] = "<p class='fs-12 '>".$data[$i]['listing_title']."</p>";
							$html[] = "<ul class='list-group list-group-flush'>";
								$html[] = "<li class='list-group-item p-2'><i class='ti ti-map-pin fs-14'></i> ".$data[$i]['content']['address']."</li>";
								
								if($data[$i]['content']['details'] != "") {
									$html[] = "<li class='list-group-item p-2'><i class='ti ti-file-info fs-14'></i> ".$data[$i]['content']['details']."</li>";
								}

								$html[] = "<li class='list-group-item p-2'><i class='ti ti-calendar fs-14'></i> ".date("d M Y h:iA", strtotime($data[$i]['content']['date']))."</li>";
							$html[] = "</ul>";

						$html[] = "</div>";
						$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
							$html[] = "<a href='".url("OpenHouseAnnouncementsController@view", ["id" => $data[$i]['announcement_id']])."' class='stretched-link w-100'></a>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
			$html[] = "</div>";
			
			$html[] = "<div class='text-center mt-4'>";
				$html[] = "<a href='".url("OpenHouseAnnouncementsController@index")."' class='btn btn-primary'>View all Open Houses</a>";
			$html[] = "</div>";
			
		$html[] = "</div>";
	$html[] = "</div>";
}