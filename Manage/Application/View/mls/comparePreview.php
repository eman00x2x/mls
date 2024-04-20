<?php

$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Compare Table List</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

    $html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";

            $html[] = "<div class='table-responsive'>";
                $html[] = "<table class='table'>";
    			if($data['listings']) {
					foreach($data['listings'] as $key => $arr) {
						$html[] = "<tr class='compare_row_".$arr['listing_id']."'>";
							$html[] = "<td><span class='avatar avatar-xxl' style='background-image: url(".CDN."images/listings_thumb/".basename($arr['thumb_img']).")'></span></td>";
							$html[] = "<td>";
								$html[] = "<div class=''>";
									$html[] = "<div class='float-end'>";
										$html[] = "<span class='cursor-pointer btn-remove-from-compare btn-remove-from-compare_".$arr['listing_id']."' data-url='".url("MlsController@removeFromCompare")."' data-id='".$arr['listing_id']."' data-csrf='".csrf_token()."' title='Remove from compare'><i class='ti ti-x me-2'></i></span>";
									$html[] = "</div>";
									$html[] = "<span class='fs-18'>".$arr['title']."</span>";
								$html[] = "</div>";
								$html[] = "<span>".ucwords($arr['offer'])." ".$arr['category']." in ".(isset($arr['address']['city']) ? $arr['address']['city'] : null)." ".(isset($arr['address']['province']) ? $arr['address']['province'] : null)."</span>";
							$html[] = "</td>";
						$html[] = "</tr>";
					}
    			}
    			$html[] = "</table>";
			$html[] = "</div>";

        $html[] = "</div>";
    $html[] = "</div>";

	$html[] = "<div class='bottom-wrap fixed-bottom sticky-top mt-3'>";
		$html[] = "<div class='text-center bg-light py-3 border-top'>";
			if($data['count'] > 1) {
		    	$html[] = "<a href='".url("MlsController@compareListings")."' class='btn btn-primary'><i class='ti ti-layers-difference me-2'></i> (<b>".$data['count']."</b>) Listings, Compare Now</a>";
			}else {
				$html[] = "<span class='fs-12'>Nothing to compare!, Select 2 or more listing to compare.</span>";
			}
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";