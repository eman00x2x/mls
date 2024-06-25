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
				$html[] = "<div class='page-pretitle'>Manage Leads of ".$data['account_name']['firstname']." ".$data['account_name']['lastname']."</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> Leads</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class=''>";
					$html[] = "<div class='btn-list'>";

						$html[] = "<a class='ajax btn btn-dark' href='".url("LeadsController@add")."'><i class='ti ti-user-plus me-2'></i> New Leads</a>";
						
						if($_SESSION['user_logged']['account_type'] == "Administrator") {
							$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account_id']])."'>";
								$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
								$html[] = $data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']." account";
							$html[] = "</a>";
						}

					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-md-3 col-lg-3 col-3'>";

			$html[] = "</div>";
			$html[] = "<div class='col-sm-12 col-md-9 col-lg-9 col-9'>";
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
									$html[] = "<th>Lead Name</th>";
									$html[] = "<th>Email Address</th>";
									$html[] = "<th>Mobile Number</th>";
									$html[] = "<th>Preference Type</th>";
									$html[] = "<th>Preference Category</th>";
									$html[] = "<th>Preference Lot Area</th>";
									$html[] = "<th>Preference Location</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['leads']); $i++) { $c++;

								$html[] = "<tr class='row_leads_".$data['leads'][$i]['lead_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									/* $html[] = "<td class='align-middle'>";
										$html[] = "<div class='d-flex'>";
											$html[] = "<div class='avatar' style='background-image: url(".$data['leads'][$i]['listing']['thumb_img'].")'></div>";
											$html[] = "<div class='ps-2'>";
												if($data['leads'][$i]['listing']['listing_id'] > 0) {
													$html[] = "<span class='d-block'>Listing ID: ".$data['leads'][$i]['listing']['listing_id']."</span>";
												}
												$html[] = "<span class='d-block'>".$data['leads'][$i]['listing']['title']."</span>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</td>"; */
									$html[] = "<td class='align-middle'><span class='name-container'><img src='".CDN."images/loader.gif' /> decrypting...</span></td>";
									$html[] = "<td class='align-middle'><span class='email-container'><img src='".CDN."images/loader.gif' /> decrypting...</span></td>";
									$html[] = "<td class='align-middle'><span class='mobile-number-container'><img src='".CDN."images/loader.gif' /> decrypting...</span></td>";
									$html[] = "<td class='align-middle'><span class=''>".$data['leads'][$i]['preferences']['type']."</span></td>";
									$html[] = "<td class='align-middle'><span class=''>".$data['leads'][$i]['preferences']['category']."</span></td>";
									$html[] = "<td class='align-middle'><span class=''>".$data['leads'][$i]['preferences']['lot_area']."</span></td>";
									$html[] = "<td class='align-middle'><span class=''>".implode(" ", $data['leads'][$i]['preferences']['address'])."</span></td>";
									$html[] = "<td class='text-center'>";
										$html[] = "<a class='btn btn-primary me-2' href='".url("LeadsController@view",["id" => $data['leads'][$i]['lead_id']])."'>View</a>";
										if($_SESSION['user_logged']['permissions']['leads']['delete']) {
											$html[] = "<span class='btn btn-danger btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadsController@delete",["id" => $data['leads'][$i]['lead_id']])."' data-content=''><i class='ti ti-trash me-2'></i> Delete</span>";
										}
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