<?php

$html[] = "<h2>Featured Properties</h2>";
$html[] = "<div class='p-featured'>";
	$html[] = "<div class='row row-deck row-cards flex-nowrap'>";
		if($data['listings']) {
			for($i=0; $i<count($data['listings']); $i++) {
				$html[] = "<div class='col-md-5 col-lg-3 col-auto '>";
					$html[] = "<div class='card property-container' title='".$data['listings'][$i]['title']."'>";
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
								
							$html[] = "<div class='d-flex gap-2 align-items-center justify-content-between'>";
								$html[] = "<div class='d-flex gap-2 align-items-center small'>";
									$html[] = "<span class='avatar avatar-sm rounded-circle' style='background-image: url(".$data['listings'][$i]['logo'].")'></span>";
									$html[] = "<div class=''>";
										$html[] = "<span class='d-block'>".$data['listings'][$i]['firstname']." ".$data['listings'][$i]['lastname']."</span>";
										$html[] = "<span class='d-block text-muted'>".$data['listings'][$i]['profession']."</span>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class=''>";
									$html[] = "<span class='small fs-11 text-muted'>Last Update<span class='d-block fs-12 text-dark'><i class='ti ti-calendar fs-14'></i> ".date("d M Y", $data['listings'][$i]['last_modified'])."</span></span>";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' class='stretched-link'></a>";
							/* $html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>View Details</a>"; */
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
		}
	$html[] = "</div>";
$html[] = "</div>";