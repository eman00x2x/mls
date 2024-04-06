<?php

$total_featured = 0;

/* $html[] = "<h3><i class='ti ti-building'></i> Related Properties</h3>"; */
$html[] = "<div class='row row-cards'>";
	$html[] = "<div class='space-y'>";

		if($data) {

			if(isset($model->app['featured_post']) && $model->app['featured_post']) {
				$total_featured = count($model->app['featured_post']);
			}
			
			$c = 0;
			for($i=0; $i<count($data); $i++) { 

				/** Featured ads */
				if(isset($model->app['featured_post']) && $model->app['featured_post']) {
					if ($i % 2 == 0) { 
						$html[] = "<div class='featured-post px-3 pb-3 pt-2 border'>";
							$html[] = "<span class='text-muted fst-italic fs-10 mb-1 d-block'>Sponsored</span>";
							$html[] = properties($model->app['featured_post'][$c], $model);
						$html[] = "</div>";

						if($c < $total_featured) {
							$c++;
						}
					}
				}
				/** End Featured ads */

				$html[] = properties($data[$i], $model);
			}

		}else {
			$html[] = "<p>No results found.</p>";
		}

	$html[] = "</div>";
$html[] = "</div>";

function properties($data, $model) {

	$html[] = "<div class='card row_listings_".$data['listing_id']."'>";
		$html[] = "<div class='row g-0'>";
			$html[] = "<div class='col-sm-4 col-md-5 col-lg-4'>";

				$html[] = "<a href='".
					url(
						$model->app['url_path']['class_hint'], [
							$model->app['url_path']['path'] => $data[ $model->app['url_path']['value'] ] 
						]
					)."'>";

					$html[] = "<div class='avatar avatar-xxxl w-100 rounded-0 border-0' style='background-image: url(".$data['thumb_img'].")'>";
						
						$html[] = "<div class='black-gradient'>";
						
							if($data['total_images'] > 0) {
								$html[] = "<div class='bottom-right text-white'>";
									$html[] = "<span class=''><i class='ti ti-photo '></i> ".$data['total_images']."</span>";
								$html[] = "</div>";
							}

							$html[] = "<div class='bottom-left text-white'>";
								$html[] = "<span class='d-block fw-normal'><i class='ti ti-map-pin me-1'></i> ".$data['address']['municipality'].", ".$data['address']['province']."</span>";
							$html[] = "</div>";

						$html[] = "</div>";

					$html[] = "</div>";
					
				$html[] = "</a>";
			$html[] = "</div>";
			$html[] = "<div class='col-sm-8 col-md-7 col-lg-8'>";
				$html[] = "<div class='card-body'>";
					$html[] = "<div class='row'>";
						$html[] = "<div class='col-sm-8 col-md-12 col-lg-8'>";
							$html[] = "<a href='".url("ListingsController@view", ["name" => $data['name']])."' style='text-decoration: none;' class='text-dark'><h3 class='mb-2 card-title'>".$data['title']."</h3></a>";
						$html[] = "</div>";
						
						$html[] = "<div class='col-sm-4 col-md-12 col-lg-4 text-lg-end'>";
							$html[] = "<span class='fs-18 text-highlight fw-bold'>&#8369;".number_format($data['price'],0)."</span>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='row'>";
						$html[] = "<div class='col-sm-12 col-md-12 col-lg-auto'>";
							$html[] = "<div class='d-flex flex-wrap gap-3 text-muted mt-2'>";
                                if($data['lot_area'] > 0) {     $html[] = "<div class=''>		<span class='d-block mb-1 fs-10 text-muted'>Land Area</span> <i class='ti ti-maximize me-1'></i> ".number_format($data['lot_area'],0)." sqm</div>"; }
								if($data['floor_area'] > 0) {   $html[] = "<div class=''>	    <span class='d-block mb-1 fs-10 text-muted'>Floor Area</span> <i class='ti ti-ruler me-1'></i> ".number_format($data['floor_area'],0)." sqm</div>"; }
								if($data['parking'] > 0) {      $html[] = "<div class=''>		<span class='d-block mb-1 fs-10 text-muted'>Garage</span> <i class='ti ti-car-garage me-1'></i> ".$data['parking']."</div>"; }
                                if($data['bedroom'] > 0) {      $html[] = "<div class=''>		<span class='d-block mb-1 fs-10 text-muted'>Bedroom</span> <i class='ti ti-bed me-1'></i> ".$data['bedroom']."</div>"; }
								if($data['bathroom'] > 0) {     $html[] = "<div class=''>		<span class='d-block mb-1 fs-10 text-muted'>Bathroom</span> <i class='ti ti-bath me-1'></i> ".$data['bathroom']."</div>"; }
							$html[] = "</div>";

						$html[] = "</div>";

						if($data['tags']) {
							$html[] = "<div class='col-sm-12 col-md-12 col-lg-auto '>";
								$html[] = "<div class='mt-3 badges '>";
									foreach($data['tags'] as $tag) {
										$html[] = "<span class='badge badge-outline text-secondary fw-normal badge-pill mx-1'>$tag</span>";
									}
								$html[] = "</div>";
							$html[] = "</div>";
						}
					$html[] = "</div>";

					if($model->app['handshaked'] && $model->app['comparative']) {
						$html[] = "<div class='mt-4 '>";
							$html[] = "<div class='btn-list'>";
								
								if($model->app['handshaked']) {
									$html[] = "<span class='btn btn-md btn-primary btn-requestHandshake btn-requestHandshake_".$data['listing_id']."' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing_id']])."'><i class='ti ti-mail-fast me-2'></i> Request Handshake</span>";
								}

								if($model->app['comparative']) {
									if(!in_array($data['listing_id'],(isset($_SESSION['compare']['listings']) ? array_keys($_SESSION['compare']['listings']) : []))) {
										$html[] = "<span class='btn btn-md btn-light btn-add-to-compare btn-add-to-compare_".$data['listing_id']."' data-url='".url("MlsController@addToCompare")."' data-id='".$data['listing_id']."' data-csrf='".csrf_token()."'><i class='ti ti-layers-difference me-2'></i> Compare</span>";
									}
								}
							$html[] = "</div>";
						$html[] = "</div>";
					}

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

	return implode("", $html);
}