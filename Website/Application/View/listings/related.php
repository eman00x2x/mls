<?php

$html[] = "<h3><i class='ti ti-building'></i> Related Properties</h3>";
$html[] = "<div class='row row-cards'>";
	$html[] = "<div class='space-y'>";

		if($data) {
		
			$c = 0;
			for($i=0; $i<count($data); $i++) { $c++;
				$html[] = "<div class='card row_listings_".$data[$i]['listing_id']."'>";
					$html[] = "<div class='row g-0'>";
						$html[] = "<div class='col-sm-4 col-md-4'>";
							$html[] = "<div class='card-body'>";
								$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."'>";
									$html[] = "<div class='avatar avatar-xxxl w-100' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
								$html[] = "</a>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='col-sm-8 col-md-8'>";
							$html[] = "<div class='card-body'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-sm-8 col-md-8 '>";
										$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' style='text-decoration: none;' class='text-dark'><h3 class='mb-0'>".$data['listings'][$i]['title']." <small class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3></a>";
									$html[] = "</div>";
									
									$html[] = "<div class='col-sm-4 col-md-4 text-sm-end'>";
										$html[] = "<span class='fs-18 text-green fw-bold'><i class='ti ti-tag'></i> &#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='row'>";
									$html[] = "<div class='col-md'>";
										$html[] = "<div class='mt-3 list list-inline mb-0 text-secondary '>";
											if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bedroom</span> <i class='ti ti-bed me-1'></i> ".$data['listings'][$i]['bedroom']."</div>"; }
											if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Bathroom</span> <i class='ti ti-bath me-1'></i> ".$data['listings'][$i]['bathroom']."</div>"; }
											if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>	<span class='d-block mb-1 fs-10 text-muted'>Floor Area</span> <i class='ti ti-ruler me-1'></i> ".number_format($data['listings'][$i]['floor_area'],0)." sqm</div>"; }
											if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Land Area</span> <i class='ti ti-maximize me-1'></i> ".number_format($data['listings'][$i]['lot_area'],0)." sqm</div>"; }
											if($data['listings'][$i]['parking'] > 0) { $html[] = "<div class='list-inline-item me-4'>		<span class='d-block mb-1 fs-10 text-muted'>Garage</span> <i class='ti ti-car-garage me-1'></i> ".$data['listings'][$i]['parking']."</div>"; }
										$html[] = "</div>";

									$html[] = "</div>";

									if($data['listings'][$i]['tags']) {
										$html[] = "<div class='col-md-auto'>";
											$html[] = "<div class='mt-3 badges'>";
												foreach($data['listings'][$i]['tags'] as $tag) {
													$html[] = "<span class='badge badge-outline text-secondary fw-normal badge-pill mx-1'>$tag</span>";
												}
											$html[] = "</div>";
										$html[] = "</div>";
									}
								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}

		}else {
			$html[] = "<p>No related properties</p>";
		}

	$html[] = "</div>";
$html[] = "</div>";
