<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System - Handshakes</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
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

			if($data) { $c=$model->page['starting_number'];

				for($i=0; $i<count($data); $i++) { $c++;
					$html[] = "<div class='row_listings_".$data[$i]['handshake_id']." listing-wrap my-2'>";
						$html[] = "<div class='row'>";
							$html[] = "<div class='col-12 col-md-3'>";
								$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-decoration-none'>";
									$html[] = "<div class='avatar avatar-xxxl mb-2' style='background-image: url(".$data[$i]['listing']['thumb_img'].")'></div>";
								$html[] = "</a>";
							$html[] = "</div>";
							$html[] = "<div class='col-12 col-md-9'>";
								$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-decoration-none'>";
									$html[] = "<h3 class='p-0'>".$data[$i]['listing']['title']."<small class='d-block fw-normal'>".ucwords($data[$i]['listing']['offer'])." ".$data[$i]['listing']['category']." in ".$data[$i]['listing']['address']['municipality'].", ".$data[$i]['listing']['address']['province']."</small></h3>";
								$html[] = "</a>";

								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='d-flex'>";
										$html[] = "<span class='d-block border me-2 p-2 text-center fw-bold fs-20'><label class='text-start d-block text-muted small fs-10 fw-normal'>Price</label>&#8369;".number_format($data[$i]['listing']['price'],0)."</span>";
										if($data[$i]['listing']['floor_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Floor Area</label>".number_format($data[$i]['listing']['floor_area'],0)." sqm</span>"; }
										if($data[$i]['listing']['lot_area'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Lot Area</label>".number_format($data[$i]['listing']['lot_area'],0)." sqm</span>"; }
										if($data[$i]['listing']['bedroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bedroom</label>".$data[$i]['listing']['bedroom']."</span>"; }
										if($data[$i]['listing']['bathroom'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bathroom</label>".$data[$i]['listing']['bathroom']."</span>"; }
										if($data[$i]['listing']['parking'] > 0) { $html[] = "<span class='d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Car Garage</label>".$data[$i]['listing']['parking']."</span>"; }
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='btn-list'>";
									
                                    if($data[$i]['requestor_account_id'] == $_SESSION['account_id']) {
                                        switch($data[$i]['handshake_status']) {
                                            case 'pending':
                                                $html[] = "<span class='btn btn-secondary '><i class='ti ti-hourglass-empty me-2'></i> ".ucwords($data[$i]['handshake_status'])."</span>";
												$html[] = "<span class='btn btn-md btn-danger btn-cancel-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data[$i]['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
                                                break;
                                            case 'active':
                                                $html[] = "<span class='btn btn-light '>Active since: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
												$html[] = "<span class='btn btn-success btn-done-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@doneHandshake", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-discount-check-filled me-2'></i> Done Handshake</span>";
												$html[] = "<span class='btn btn-md btn-danger btn-cancel-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data[$i]['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>";
                                                break;
											case 'done':
                                                $html[] = "<span class='btn btn-light '>Done since: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
                                                break;
											case 'denied':
                                                $html[] = "<span class='btn btn-light '>Deined at: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
                                                break;
                                        }
                                    }

                                    if($data[$i]['requestee_account_id'] == $_SESSION['account_id']) {
                                        switch($data[$i]['handshake_status']) {
                                            case 'pending':
                                                $html[] = "<span class='btn btn-success btn-accept-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@acceptRequest", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-circle-check me-2'></i> Accept Request</span>";
                                                $html[] = "<span class='btn btn-danger btn-denied-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@deniedRequest", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-ban me-2'></i> Denied</span>";
                                                break;
                                            case 'active':
                                                $html[] = "<span class='btn btn-light '>Active since: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
                                                break;
											case 'done':
                                                $html[] = "<span class='btn btn-light '>Done since: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
                                                break;
											case 'denied':
                                                $html[] = "<span class='btn btn-light '>Deined at: ".date("F d, Y",$data[$i]['handshake_status_date'])."</span>";
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