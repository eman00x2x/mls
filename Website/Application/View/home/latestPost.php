<?php

$html[] = "<div class='pb-5 my-5'>";

	$html[] = "<div class='text-center pb-3'>";
		$html[] = "<h2 class='mb-0 display-5 text-blue'>Latest Postings</h2>";
		$html[] = "<p>Stay Updated with Our Recent Properties</p>";
	$html[] = "</div>";

	$html[] = "<div class='p-featured mt-3'>";
		$html[] = "<div class='row row-deck row-cards'>";
			if($data['listings']) {

				for($i=0; $i<count($data['listings']); $i++) {
					$html[] = "<div class='col-md-5 col-lg-3 col-auto '>";
						$html[] = "<div class='card property-container mb-3' title='".$data['listings'][$i]['title']."'>";
							$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data['listings'][$i]['thumb_img'].");'>";
							
								$html[] = "<div class='black-gradient'>";
					
									if($data['listings'][$i]['total_images'] > 0) {
										$html[] = "<div class='bottom-right text-white'>";
											$html[] = "<span class=''><i class='ti ti-photo '></i> ".$data['listings'][$i]['total_images']."</span>";
										$html[] = "</div>";
									}
									$html[] = "<div class='bottom-left text-white'>";
										$html[] = "<span class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</span>";
									$html[] = "</div>";
								$html[] = "</div>";
							
							$html[] = "</div>";
							$html[] = "<div class='card-body mb-0 pb-2'>";
								$html[] = "<div class='p-description'>";
									$html[] = "<h3 class='p-title card-title mb-1' title=''>".nicetrim($data['listings'][$i]['title'], 55)."</h3>";
									$html[] = "<div class='p-tech-details '>";
										$html[] = "<div class='p-price text-highlight fw-bold mb-1'>&#8369; ".number_format($data['listings'][$i]['price'],0)."</div>";
										$html[] = "<div class='d-flex flex-wrap gap-2 text-muted mb-2'>";
											if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<span class='d-block '><i class='ti ti-maximize me-1'></i>".$data['listings'][$i]['lot_area']." sq.m <span class='small d-block p-tech-label'>Land Area</span></span>"; }
											if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<span class='d-block '><i class='ti ti-maximize me-1'></i>".$data['listings'][$i]['floor_area']." sq.m <span class='small d-block p-tech-label'>Floor Area</span></span>"; }
											if($data['listings'][$i]['parking'] > 0) {$html[] = "<span class='d-block '><i class='ti ti-car-garage me-1'></i>".$data['listings'][$i]['parking']." <span class='small d-block p-tech-label'>Car Garage</span></span>"; }
											if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<span class='d-block '><i class='ti ti-bed me-1'></i>".$data['listings'][$i]['bedroom']." <span class='small d-block p-tech-label'>Bedroom</span></span>"; }
											if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<span class='d-block '><i class='ti ti-bath me-1'></i>".$data['listings'][$i]['bathroom']." <span class='small d-block p-tech-label'>Bathroom</span></span>"; }
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='card-footer py-2 mt-0'>";

								if($data['listings'][$i]['logo'] != "") { $logo = $data['listings'][$i]['logo'];
								}else { $logo = CDN."images/blank-profile.png"; }
									
								$html[] = "<div class='d-flex gap-2 align-items-center justify-content-between'>";
									$html[] = "<div class='d-flex gap-2 align-items-center small'>";
										$html[] = "<span class='avatar avatar-sm rounded-circle' style='background-image: url(".$logo.")'></span>";
										$html[] = "<div class=''>";
											$html[] = "<span class='d-block'>".$data['listings'][$i]['account_name']['firstname']." ".$data['listings'][$i]['account_name']['lastname']." ".$data['listings'][$i]['account_name']['suffix']."</span>";
											$html[] = "<span class='d-block text-muted'>".$data['listings'][$i]['profession']."</span>";
										$html[] = "</div>";
									$html[] = "</div>";
									$html[] = "<div class=''>";
										$html[] = "<span class='small fs-11 text-muted'>Last Update<span class='d-block fs-12 text-dark'><i class='ti ti-calendar fs-14'></i> ".date("d M Y", $data['listings'][$i]['modified_at'])."</span></span>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' class='stretched-link full-link'></a>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				}
			}
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";