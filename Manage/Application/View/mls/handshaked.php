<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

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
						
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='box-container mb-3'>";
		
			$html[] = "<div class='search-box'>";
				$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MlsController@index")."' />";
				$html[] = "<a href='".url("MlsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
			$html[] = "</div>";

			if($data) { $c=$model->page['starting_number'];

				$html[] = "<div class='table-responsive'>";
				$html[] = "<table class='table mt-3'>";
				
				for($i=0; $i<count($data); $i++) { $c++;

					if($data[$i]['requestee_account_id'] != $_SESSION['user_logged']['account_id']) {
						/** Requestee account */

						$n = $data[$i]['requestee_account']['account_name']['firstname'];
						if(isset($data[$i]['requestee_account']['account_name']['nickname']) && $data[$i]['requestee_account']['account_name']['nickname'] != "") {
							$n = $data[$i]['requestee_account']['account_name']['nickname'];
						}

						$name = "<span class='d-block text-muted fs-12'>Requestee</span>".$n. " " .$data[$i]['requestee_account']['account_name']['lastname'];
						$profession = $data[$i]['requestee_account']['profession'];
						$license = $data[$i]['requestee_account']['real_estate_license_number'];
						$mobile_number = $data[$i]['requestee_account']['mobile_number'];
						$email = $data[$i]['requestee_account']['email'];
						$registered_at = $data[$i]['requestee_account']['registered_at'];

					}else {
						/** Requestor account */

						$n = $data[$i]['requestor_details']['account_name']['firstname'];
						if(isset($data[$i]['requestor_details']['account_name']['nickname']) && $data[$i]['requestor_details']['account_name']['nickname'] != "") {
							$n = $data[$i]['requestor_details']['account_name']['nickname'];
						}

						$name = "<span class='d-block text-muted fs-12'>Requestor</span>".$n." ".$data[$i]['requestor_details']['account_name']['lastname'];
						$profession = $data[$i]['requestor_details']['profession'];
						$license = $data[$i]['requestor_details']['real_estate_license_number'];
						$mobile_number = $data[$i]['requestor_details']['mobile_number'];
						$email = $data[$i]['requestor_details']['email'];
						$registered_at = $data[$i]['requestor_details']['registered_at'];

					}



					$html[] = "<tr class='row_listings_".$data[$i]['handshake_id']."'>";
						$html[] = "<td class='align-middle w-1 bg-dark text-white'>";
							$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-white text-decoration-none'><span class='avatar avatar-lg' style='background-image: url(".$data[$i]['listing']['thumb_img'].")'></span></a>";
					    $html[] = "</td>";
						$html[] = "<td class='align-middle bg-dark text-white' style='width:300px;'>";
					        $html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-white text-decoration-none'><span class='d-block text-muted fs-12'>Listing ID: ".$data[$i]['listing']['listing_id']."</span> ".$data[$i]['listing']['title']."</a>";
					    $html[] = "</td>";
						$html[] = "<td class='align-middle bg-dark text-white'>";
					        $html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-white text-decoration-none'><span class='d-block text-muted fs-12'>Commission Sharing</span> <span>".$data[$i]['listing']['other_details']['com_share']."%</span></a>";
					    $html[] = "</td>";
						
					    $html[] = "<td class='align-middle'>";
							$html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-dark text-decoration-none'>".$name." <span class='d-block text-muted fs-11'>".$profession." - ".$license."</span></a>";
					    $html[] = "</td>";
					    $html[] = "<td class='align-middle'>";
					        $html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-dark text-decoration-none'><span class='d-block text-muted fs-12'>Mobile Number</span> ".$mobile_number."</a>";
					    $html[] = "</td>";
					    $html[] = "<td class='align-middle'>";
					        $html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-dark text-decoration-none'><span class='d-block text-muted fs-12'>Email</span> ".$email."</a>";
					    $html[] = "</td>";
					    $html[] = "<td class='align-middle'>";
					        $html[] = "<a href='".url("MlsController@viewListing", ["id" => $data[$i]['listing']['listing_id']])."' class='text-dark text-decoration-none'><span class='d-block text-muted fs-12'>Registered Since</span> ".date("F d, Y", $registered_at)."</a>";
					    $html[] = "</td>";
					$html[] = "</tr>";
					$html[] = "<tr class='row_listings_".$data[$i]['handshake_id']."'>";
						$html[] = "<td class='align-middle' colspan='7'>";
							$html[] = "<div class='btn-list'>";
							if($data[$i]['requestor_account_id'] == $_SESSION['user_logged']['account_id']) {
                                switch($data[$i]['handshake_status']) {
                                    case 'pending':
                                        $html[] = "<span class='btn btn-secondary '><i class='ti ti-hourglass-empty me-2'></i> ".ucwords($data[$i]['handshake_status'])."</span>";
											/* $html[] = "<span class='btn btn-md btn-danger btn-cancel-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data[$i]['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>"; */
                                        break;
                                    case 'active':
                                        $html[] = "<span class='btn btn-light '>Active since: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
										$html[] = "<span class='btn btn-success btn-done-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@doneHandshake", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-discount-check-filled me-2'></i> Done Handshake</span>";
											/* $html[] = "<span class='btn btn-md btn-danger btn-cancel-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@cancelHandshake",["listing_id" => $data[$i]['listing_id']])."'><i class='ti ti-circle-letter-x me-2'></i> Cancel Handshake</span>"; */
                                        break;
									case 'done':
                                        $html[] = "<span class='btn btn-light '>Done since: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
                                        break;
									case 'denied':
                                        $html[] = "<span class='btn btn-light '>Denied at: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
                                        break;
                                }
                            }

                            if($data[$i]['requestee_account_id'] == $_SESSION['user_logged']['account_id']) {
                                switch($data[$i]['handshake_status']) {
                                    case 'pending':
                                        $html[] = "<span class='btn btn-success btn-accept-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@acceptRequest", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-circle-check me-2'></i> Accept Request</span>";
                                        $html[] = "<span class='btn btn-danger btn-denied-handshake' data-row='row_listings_".$data[$i]['handshake_id']."' data-url='".url("MlsController@deniedRequest", ["id" => $data[$i]['handshake_id']])."'><i class='ti ti-ban me-2'></i> Denied</span>";
                                        break;
                                    case 'active':
                                        $html[] = "<span class='btn btn-light '>Active since: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
                                        break;
									case 'done':
                                        $html[] = "<span class='btn btn-light '>Done since: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
                                        break;
									case 'denied':
                                        $html[] = "<span class='btn btn-light '>Denied at: ".date("F d, Y",$data[$i]['handshake_status_at'])."</span>";
                                        break;
                                }
                            }
							$html[] = "</div>";
						$html[] = "</td>";
					$html[] = "</tr>";
				}

				$html[] = "</table>";
				$html[] = "</div>";

			}else {
				$html[] = "<p class='mt-3'>Does not have handshaked listing yet.</p>";
			}
			
		$html[] = "</div>";
			
		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";