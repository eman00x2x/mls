<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href=''><i class='ti ti-user-plus me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark filter-btn' href=''><i class='ti ti-filter me-2'></i> Filter Result</span>";
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		
		$html[] = "<div class='box-container mb-3'>";
		
			$html[] = "<div class='search-box'>";
				$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MlsController@index")."' />";
				$html[] = "<a href='".url("MlsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
			$html[] = "</div>";

			if($data['listings']) { $c=$model->page['starting_number'];

				for($i=0; $i<count($data['listings']); $i++) { $c++;
					$html[] = "<div class='row_listings_".$data['listings'][$i]['listing_id']." listing-wrap my-2'>";
						$html[] = "<div class='row'>";
							$html[] = "<div class='col-3'>";
								$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
							$html[] = "</div>";
							$html[] = "<div class='col-8'>";
								$html[] = "<h3 class='p-0'>".$data['listings'][$i]['title']."<small class='d-block fw-normal'>".ucwords($data['listings'][$i]['offer'])." ".$data['listings'][$i]['category']." in ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h3>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='d-flex'>";
										$html[] = "<span class='d-block border me-2 p-2 text-center fw-bold fs-20'><label class='text-start d-block text-muted small fs-10 fw-normal'>Price</label>&#8369;".number_format($data['listings'][$i]['price'],0)."</span>";
										if($data['listings'][$i]['floor_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Floor Area</label>".number_format($data['listings'][$i]['floor_area'],0)." sqm</span>"; }
										if($data['listings'][$i]['lot_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Lot Area</label>".number_format($data['listings'][$i]['lot_area'],0)." sqm</span>"; }
										if($data['listings'][$i]['bedroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bedroom</label>".$data['listings'][$i]['bedroom']."</span>"; }
										if($data['listings'][$i]['bathroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bathroom</label>".$data['listings'][$i]['bathroom']."</span>"; }
										if($data['listings'][$i]['parking'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Car Garage</label>".$data['listings'][$i]['parking']."</span>"; }
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='btn-list'>";
									
                                    if($data['listings'][$i]['requestor_account_id'] == $_SESSION['account_id']) {
                                        switch($data['listings'][$i]['handshake_status']) {
                                            case 'pending':
                                                $html[] = "<span class='btn btn-secondary '>".ucwords($data['listings'][$i]['handshake_status'])."</span>";
                                                break;
                                            case 'active':
                                                $html[] = "<span class='btn btn-secondary '>Active since: ".date("F d, Y",$data['listings'][$i]['handshake_status_date'])."</span>";
                                                break;
                                        }
                                    }

                                    if($data['listings'][$i]['requestee_account_id'] == $_SESSION['account_id']) {
                                        switch($data['listings'][$i]['handshake_status']) {
                                            case 'pending':
                                                $html[] = "<span class='btn btn-success '><i class='ti ti-check me-2'></i> Accept Request</span>";
                                                break;
                                            case 'active':
                                                $html[] = "<span class='btn btn-secondary '>Active since: ".date("F d, Y",$data['listings'][$i]['handshake_status_date'])."</span>";
                                                break;
                                        }
                                    }

								$html[] = "</div>";

							$html[] = "</div>";
						$html[] = "</div>";
						
					$html[] = "</div>";
				}

			}else {
				$html[] = "<p class='mt-3'>Does not have handshaked listing yet.</p>";
			}
			
		$html[] = "</div>";
			
		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";