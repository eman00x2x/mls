<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0'>";
	$html[] = "<div class='col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'>A list of Premium that the general public can subscribe to.</div>";
						$html[] = "<h1 class='page-title '><i class='ti ti-layers-union me-2'></i> Premiums</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='btn-list text-end'>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("PremiumsController@add")."'><i class='ti ti-plus me-2'></i> New Premium</a>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box mb-3'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Premiums' data-url='".url("PremiumsController@index")."' />";
						$html[] = "<a href='".url("PremiumsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data) { $c=0;
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th>Name</th>";
									$html[] = "<th class='text-center'>Subscribers</th>";
									$html[] = "<th>Type</th>";
									$html[] = "<th class='text-center'>Days Duration</th>";
									$html[] = "<th class='text-end'>Cost <span class='fs-10'>per 30 days</span></th>";
									$html[] = "<th class='text-center'>Publish</th>";
									$html[] = "<th>Date Added</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;
								
								$html[] = "<tr>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><a href='".url("PremiumsController@view",["id" => $data[$i]['premium_id']])."' class='ajax text-inherit'>".$data[$i]['name']."</a></td>";
									$html[] = "<td class='align-middle w-1 text-center'>".$data[$i]['subscribers']."</td>";
									$html[] = "<td class='align-middle'>".(ucwords(str_replace("_"," ",$data[$i]['type'])))."</td>";
									$html[] = "<td class='align-middle text-center'>".implode(", ", $data[$i]['duration'])."</td>";
									$html[] = "<td class='align-middle text-end'>".number_format($data[$i]['cost'],0)."</td>";
									$html[] = "<td class='align-middle text-center'>".($data[$i]['visibility'] == 1 ? "Yes" : "")."</td>";
									$html[] = "<td class='align-middle'>".date("F d, Y",$data[$i]['date_added'])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("PremiumsController@edit",["id" => $data[$i]['premium_id']])."'><i class='ti ti-edit me-2'></i> Edit Premium</a>";
												if($_SESSION['user_logged']['user_level'] == 1) {
													$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("PremiumsController@delete",["id" => $data[$i]['premium_id']])."'><i class='ti ti-trash me-2'></i> Delete Premium</span>";
												}
											$html[] = "</div>";
											
										$html[] = "</div>";
									
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<p class='mt-3'>No premiums found.</p>";
					}
					
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";

if(!empty($model)) {
	$html[] = $model->pagination;
}