<?php

$html[] = "<div class=''>";

	$html[] = "<div class='hero-image bg-white border-bottom'>";
		$html[] = "<div class='container-xl'>";

			/* $html[] = "<div class='bg-big' style='background-image: url(".CDN."images/website/Colliers_Viewpoint_hero_image_v1.jpg);'>"; */
			$html[] = "<div class='bg-big'>";
				$html[] = "<div class='row justify-content-center'>";
					$html[] = "<div class='col-md-8 col-auto'>";

						$html[] = "<div class='search-filter'>";
							
								$html[] = "<div class=''>";
									$html[] = "<div class='btn-group'>";
										$html[] = "<input type='radio' class='btn-check' name='btn-radio-basic' id='btn-radio-basic-1' autocomplete='off' checked >";
										$html[] = "<label for='btn-radio-basic-1' type='button' class='btn border-0 rounded-0' style='width:150px;'>Buy</label>";
										$html[] = "<input type='radio' class='btn-check' name='btn-radio-basic' id='btn-radio-basic-2' autocomplete='off'  >";
										$html[] = "<label for='btn-radio-basic-2' type='button' class='btn border-0 rounded-0' style='width:150px;'>Rent</label>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='bg-white'>";

									$html[] = "<div class='row justify-content-center'>";
										$html[] = "<div class='col-md-3 col-auto'>";
											$html[] = "<div class='form-floating'>";
												$html[] = "<select name='' id='category' class='form-select border-0'>";
													$html[] = "<option value=''>Residential Land</option>";
													$html[] = "<option value=''>House and Lot</option>";
												$html[] = "</select>";
												$html[] = "<label for='category'>Category</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-md-9 col-sm-auto'>";
											$html[] = "<div class='input-group'>";
												$html[] = "<div class='form-floating'>";
													$html[] = "<input type='text' name='address' id='location' value='' placeholder='Select desired location' class='form-control border-0' />";
													$html[] = "<label for='category'>Select Location</label>";
												$html[] = "</div>";
												$html[] = "<span class='btn btn-primary border-0' type='button'><i class='ti ti-search me-2'></i> Search</span>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

								$html[] = "</div>";
							
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='p-featured m-3 p-5'>";
			$html[] = "<h2>Featured Properties</h2>";
			$html[] = "<div class='row row-deck row-cards'>";
				if($data['listings']) {
					for($i=0; $i<count($data['listings']); $i++) {
						$html[] = "<div class='col-md-3 col-auto '>";
							$html[] = "<div class='card property-container' title='".$data['listings'][$i]['title']."'>";
								$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data['listings'][$i]['thumb_img'].");'></div>";
								$html[] = "<div class='card-body mb-0 pb-2'>";
									$html[] = "<div class='p-description'>";
										$html[] = "<h3 class='p-title card-title mb-1' title=''>".nicetrim($data['listings'][$i]['title'], 55)."</h3>";
										$html[] = "<p class='p-location mb-2 p-0'><i class='ti ti-map-pin'></i> ".$data['listings'][$i]['address']['municipality']." ".$data['listings'][$i]['address']['province']."</p>";
										$html[] = "<div class='p-tech-details '>";
											$html[] = "<div class='d-flex gap-3 text-muted mb-2'>";
												$html[] = "<span class='d-block '><i class='ti ti-maximize me-1'></i>".$data['listings'][$i]['lot_area']." sq.m <span class='small d-block p-tech-label'>Land Area</span></span>";
												$html[] = "<span class='d-block '><i class='ti ti-bed me-1'></i>".$data['listings'][$i]['bedroom']." <span class='small d-block p-tech-label'>Room</span></span>";
												$html[] = "<span class='d-block '><i class='ti ti-car-garage me-1'></i>".$data['listings'][$i]['parking']." <span class='small d-block p-tech-label'>Car Garage</span></span>";
											$html[] = "</div>";
											$html[] = "<div class='p-price fw-bold '>&#8369; ".number_format($data['listings'][$i]['price'],0)."</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
									$html[] = "<a href='".url("ListingsController@view", ["name" => $data['listings'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>View Details</a>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					}
				}
			$html[] = "</div>";
		$html[] = "</div>";
	

		$html[] = "<div class='p-featured m-3 p-5'>";
			$html[] = "<h2>Articles</h2>";
			$html[] = "<div class='row row-deck row-cards'>";
				if($data['articles']) {
					for($i=0; $i<count($data['articles']); $i++) {
						$html[] = "<div class='col-md-3 col-auto '>";
							$html[] = "<div class='card property-container' title='".$data['articles'][$i]['title']."'>";
								$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data['articles'][$i]['banner'].");'></div>";
								$html[] = "<div class='card-body mb-0 pb-2'>";
									$html[] = "<div class='p-description' style='height:130px;'>";
										$html[] = "<h3 class='p-title card-title mb-1' title=''>".nicetrim($data['articles'][$i]['title'], 55)."</h3>";
										$html[] = "<div class='p-tech-details'>";
											$html[] = "<p>".nicetrim(strip_tags($data['articles'][$i]['content']),100)."</p>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
									$html[] = "<a href='".url("ArticlesController@view", ["name" => $data['articles'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>Read</a>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					}
				}
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";