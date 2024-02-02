<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Manage Leads of ".$data['firstname']." ".$data['lastname']."</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> Leads</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
						if($data['account_type'] != "Administrator") {
							$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account_id']])."'>";
								$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
								$html[] = $data['firstname']." ".$data['lastname']." account";
							$html[] = "</a>";
						}else {
							
						}
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

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("LeadsController@index", ["id" => $data['account_id']])."' />";
						$html[] = "<a href='".url("LeadsController@index", ["id" => $data['account_id']])."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['leads']) { $c=$model->page['starting_number'];
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th class='w-1'></th>";
									$html[] = "<th></th>";
									$html[] = "<th></th>";
									$html[] = "<th></th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['leads']); $i++) { $c++;

								$html[] = "<tr class='row_leads_".$data['leads'][$i]['lead_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><a href='".url("LeadsController@view",["id" => $data['leads'][$i]['lead_id']])."'>".$data['leads'][$i]['name']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("LeadsController@view",["id" => $data['leads'][$i]['lead_id']])."'>".$data['leads'][$i]['email']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("LeadsController@view",["id" => $data['leads'][$i]['lead_id']])."'>".$data['leads'][$i]['mobile_no']."</a></td>";
									$html[] = "<td class='align-middle'>";
										$html[] = "<div class='d-flex'>";
											$html[] = "<div class='avatar' style='background-image: url(".$data['leads'][$i]['listing']['thumb_img'].")'></div>";
											$html[] = "<div class='ps-2'>";
												$html[] = "<span class='d-block'>Listing ID: ".$data['leads'][$i]['listing']['listing_id']."</span>";
												$html[] = "<span class='d-block'>".$data['leads'][$i]['listing']['title']."</span>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</td>";
									$html[] = "<td class='text-center'>";
										$html[] = "<span class='btn btn-danger btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadsController@delete",["id" => $data['leads'][$i]['lead_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<p class='mt-3'>You do not have leads yet.</p>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";