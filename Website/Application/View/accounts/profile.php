<?php

$html[] = "<div class='bg-blue' style='height:150px;'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row justify-content-end'>";
			$html[] = "<div class='col-lg-4 col-md-6'>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-8 col-md-6'>";
				$html[] = "<div class='pt-3 d-none d-md-block '>";
					
					/*** ADS CONTAINER */
					$html[] = "<div class='d-none px-2 PROFILE_TOP'>";
						$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
							$html[] = "<div class='card bg-dark-lt mt-2 mx-auto rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:120px; width:700px;'>";
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

$html[] = "<div class='page-body mt-0 bg-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class=''>";
			$html[] = "<div class='row justify-content-between'>";
				$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

					/** START PROFILE */
					$html[] = "<div class='card mb-3 border-0'>";
						$html[] = "<div class='card-body' style='margin-top: -130px;'>";

							if($data['logo'] != "") { $logo = $data['logo'];
							}else { $logo = CDN."images/blank-profile.png"; }

							$html[] = "<div class='d-flex justify-content-between align-items-center'>";
								$html[] = "<span class='avatar avatar-xxl mb-1 mb-3 rounded-circle' style='border:3px solid #fff; background-image: url(".$logo.")'></span>";
								$html[] = "<div class=''>";
									$html[] = "<div class='mt-4 pt-3'></div>";
									$html[] = "<div class='mt-5 pt-5'></div>";
									
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<h3 class='card-title m-0'>".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['middlename']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</h3>";
							$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
								if(!empty($data['profile']['certification'])) {
									for($i=0; $i<count($data['profile']['certification']); $i++) {
										$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['certification'][$i]."</li>";
									}
								}
							$html[] = "</ul>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>About</h3>";
							$html[] = "<p class='px-2 py-2 border-3 border-0 border-start border-azure'>".$data['profile']['about_me']."</p>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Affiliations</h3>";
							$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
								
								if(!empty($data['profile']['affiliation'])) {
									for($i=0; $i<count($data['profile']['affiliation']); $i++) {
										if($data['profile']['affiliation'][$i]['organization'] != "") {
											$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
												$html[] = "<div class='fw-bold'>".$data['profile']['affiliation'][$i]['organization']."</div>";
												$html[] = "<div class='d-flex justify-content-between mb-1 mt-2'>";
													$html[] = "<span class='fw-bold'>".$data['profile']['affiliation'][$i]['title']."</span>";
													$html[] = "<span class='text-muted fs-12'>Date ".date("d F Y", strtotime($data['profile']['affiliation'][$i]['date']['from']))."</span>";
												$html[] = "</div>";
												$html[] = "<p class='m-0' >".$data['profile']['affiliation'][$i]['description']."</p>";
											$html[] = "</li>";
										}
									}
								}

							$html[] = "</ul>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Education</h3>";
							$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
								if(!empty($data['profile']['education'])) {
									for($i=0; $i<count($data['profile']['education']); $i++) {
										if($data['profile']['education'][$i]['school'] != "") {
											$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
												$html[] = "<div class='d-flex gap-2 justify-content-start flex-wrap'>";
													$html[] = "<div class='flex-grow-1 fw-bold'>".$data['profile']['education'][$i]['school']."</div>";
													$html[] = "<div class='text-muted fs-12'>".date("d F Y", strtotime($data['profile']['education'][$i]['date']['from']))."</div>";
												$html[] = "</div>";
												$html[] = "<p class='m-0'>".$data['profile']['education'][$i]['degree']."</p>";
											$html[] = "</li>";
										}
									}
								}
							$html[] = "</ul>";

						$html[] = "</div>";
					$html[] = "</div>";
					/** END PROFILE */

				$html[] = "</div>";
				$html[] = "<div class='col-lg-3 col-md-4 col-sm-12 col-12'>";
						
					$html[] = "<div class='py-4 px-2'>";

						if(!empty($data['profile']['skills']) && is_array($data['profile']['skills'])) {

							if($data['profile']['skills'][0] != "") {
								$html[] = "<h3 class='card-title mb-1 text-muted'>Skills</h3>";

								$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
									$html[] = "<ul class='list-group list-group-flush'>";
									for($i=0; $i<count($data['profile']['skills']); $i++) {
										$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['skills'][$i]."</li>";							
									}
									$html[] = "</ul>";
								$html[] = "</div>";
							}
							

						}

						/*** ADS CONTAINER */
						$html[] = "<div class='d-none px-2 mt-4 PROFILE_SIDEBAR_TOP'>";
							$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
								$html[] = "<div class='card bg-dark-lt mt-2 mx-auto rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='width:300px; min-height:300px;'>";
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

		$html[] = "<div class='pb-5 my-5 px-2'>";
			$html[] = "<h2 class='pb-0 mb-0'>Featured Properties</h2>";
			$html[] = "<p class='p-0 text-muted'>Posted by ".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['middlename']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</p>";
			$html[] = "<div class='p-featured '>";
				$html[] = "<div class='row row-deck row-cards listings-table'>";
					if($data['listings']) {
						for($i=0; $i<count($data['listings']); $i++) {
							$html[] = "<div class='col-md-5 col-lg-3 col-12 '>";
								$html[] = "<div class='card property-container mb-3' title='".$data['listings'][$i]['title']."'>";
									$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' data-thumb-image='".$data['listings'][$i]['thumb_img']."'>";
									
										$html[] = "<div class='black-gradient'>";
							
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
											
										$html[] = "<div class=''>";
											$html[] = "<span class='small fs-11 text-muted'>Last Update <span class='fs-12 text-dark'><i class='ti ti-calendar fs-14'></i> ".date("d M Y", $data['listings'][$i]['modified_at'])."</span></span>";
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

	$html[] = "</div>";
$html[] = "</div>";
