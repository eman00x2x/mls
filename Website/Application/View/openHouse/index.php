<?php

$html[] = "<div class='page-body'>";
    $html[] = "<div class='container-xl'>";

		$html[] = "<div class='px-2'>";
			$html[] = "<div class='row g-2'>";
				$html[] = "<div class='col-lg-9 col-md-8 col-sm-12 col-12 order-lg-1 order-sm-2'>";

					if($data) {
						$html[] = "<div class=''>";
							$html[] = "<h2>Open House Announcement</h2>";
							$html[] = "<div class='row'>";
							
								for($i=0; $i<count($data); $i++) {
									$html[] = "<div class='col-lg-4 col-md-6 col-sm-12 col-12'>";
										$html[] = "<div class='card mb-3' title='".$data[$i]['subject']."'>";
											$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top bg-blue' style='height:150px; background-image: url(".$data[$i]['attachment'].");'></div>";
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
						$html[] = "</div>";
						
						if(!empty($model)) {
							$html[] = $model->pagination;
						}
					}else {
						$html[] = "<div class=''>";
							$html[] = "<div class='empty'>";
								$html[] = "<div class='empty-image mb-4'>";
									$html[] = "<img src='".CDN."images/undraw_quitting_time_dm8t.svg' height='128' />";
								$html[] = "</div>";
								$html[] = "<p class='empty-title'>No results found</p>";
								$html[] = "<p class='empty-subtitle text-secondary'>Try adjusting your search or filter to find what you're looking for.</p>";
							$html[] = "</div>";
						$html[] = "</div>";
					}
				
				$html[] = "</div>";
				$html[] = "<div class='col-lg-3 col-md-4 col-sm-12 col-12 order-lg-2 order-sm-1'>";
					
					/*** ADS CONTAINER */
					$html[] = "<div class='d-none ARTICLE_LIST_SIDEBAR'>";
						$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
							$html[] = "<div class='card bg-dark-lt mt-2 rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:280px;'>";
								$html[] = "<div class='loader'></div>";
								$html[] = "<p>Loading Ads</p>";
							$html[] = "</div>";
						$html[] = "</a>";
					$html[] = "</div>";
					/*** END ADS CONTAINER */					

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";