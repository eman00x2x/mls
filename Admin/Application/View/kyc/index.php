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
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Account Name' data-url='".url("KYCController@index")."' />";
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
									$html[] = "<th>KYC Status</th>";
									$html[] = "<th>Verified By</th>";
									$html[] = "<th>Verified at</th>";
									$html[] = "<th>Created at</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;
								
								$html[] = "<tr>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle text-center'><a href='".url("KYCController@verify",["id" => $data[$i]['account_id']])."'>".$data[$i]['account_id']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("KYCController@verify",["id" => $data[$i]['account_id']])."' class='ajax text-inherit'>".$data[$i]['firstname']." ".$data[$i]['lastname']."</a></td>";
									
									$html[] = "<td class='align-middle'>".
										($data[$i]['kyc_status'] == 1 ? "<span class='text-success '>Active</span>" : "<span class='text-warning'>Pending</span>")."</td>";
										$html[] = "<td class='align-middle'><a href='".url("KYCController@verify",["id" => $data[$i]['account_id']])."'>".$data[$i]['verified_by']."</a></td>";
									$html[] = "<td class='align-middle'>".($data[$i]['verified_at'] > 0 ? date("F d, Y", $data[$i]['verified_at']) : '')."</td>";
									$html[] = "<td class='align-middle'>".date("F d, Y", $data[$i]['created_at'])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary btn-md' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("KYCController@verify",["id" => $data[$i]['kyc_id']])."'><i class='ti ti-edit me-2'></i> Verify</a>";
											$html[] = "</div>";
											
										$html[] = "</div>";
									
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<p class='mt-3'>You do not have Users.</p>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";