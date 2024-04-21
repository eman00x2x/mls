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
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> KYC Verification</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list'>";
					/* $html[] = "<span class='d-none d-sm-inline'>";
						$html[] = "<a class='ajax btn btn-dark' href='".url("KYCController@kycVerificationForm")."'><i class='ti ti-user-plus me-2'></i> New Verification</a>";
					$html[] = "</span>"; */
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search First Name or Last Name' data-url='".url("KYCController@index")."' />";
						$html[] = "<a href='".url("KYCController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data) { $c=$model->page['starting_number'];
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th class='text-center w-1'>Account ID</th>";
									$html[] = "<th>Name</th>";
									$html[] = "<th class=''>KYC Status</th>";
									$html[] = "<th>Verified By</th>";
									$html[] = "<th>Verified at</th>";
									$html[] = "<th>Created at</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;

								$kyc_status_description = [
									0 => "<span class='text-warning'>Pending Verification</span>",
									1 => "<span class='text-success'>Verified</span>",
									2 => "<span class='text-info fw-bold'>Denied</span>",
									3 => "<span class='text-danger fw-bold'>Expired</span>"
								];
								
								$html[] = "<tr class='row_article_".$data[$i]['kyc_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle text-center'><a class='text-decoration-none' href='".url("KYCController@view",["id" => $data[$i]['kyc_id']])."'>".$data[$i]['account_id']."</a></td>";
									$html[] = "<td class='align-middle'><a class='text-decoration-none' href='".url("KYCController@view",["id" => $data[$i]['kyc_id']])."' class='ajax text-inherit'>".$data[$i]['account_name']['prefix']." ".$data[$i]['account_name']['firstname']." ".$data[$i]['account_name']['middlename']." ".$data[$i]['account_name']['lastname']." ".$data[$i]['account_name']['suffix']."</a></td>";
									
									$html[] = "<td class='align-middle'>".$kyc_status_description[ $data[$i]['kyc_status'] ]." - ".$data[$i]['verification_details']."</td>";
									$html[] = "<td class='align-middle'><a class='text-decoration-none' href='".url("KYCController@view",["id" => $data[$i]['kyc_id']])."'>".$data[$i]['verified_by']."</a></td>";
									$html[] = "<td class='align-middle'>".($data[$i]['verified_at'] > 0 ? date("F d, Y", $data[$i]['verified_at']) : '')."</td>";
									$html[] = "<td class='align-middle'>".date("F d, Y", $data[$i]['created_at'])."</td>";
									
									$html[] = "<td class='text-center'>";
										$html[] = "<div class='btn-list'>";
											if($data[$i]['kyc_status'] == 0) {
												$html[] = "<a class='btn btn-primary ' href='".url("KYCController@view",["id" => $data[$i]['kyc_id']])."'><i class='ti ti-lock me-1'></i> Verify</a>";
											}
											$html[] = "<span class='btn btn-delete btn-danger' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("KycController@delete",["id" => $data[$i]['kyc_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
										$html[] = "</div>";
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
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
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";