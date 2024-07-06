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

						if(isset($_GET['id']) && $_GET['id'] != 0) {
							$html[] = "<span class='btn btn-danger btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadGroupsController@delete", ["id" => $_GET['id']])."' data-content=''><i class='ti ti-trash me-2'></i> Delete Group</span>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("LeadGroupsController@edit", ["id" => $_GET['id']])."'><i class='ti ti-edit me-2'></i> Update Group Details</a>";
						}

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
				$html[] = "<div class='sidebar-list-group bg-white rounded d-md-block d-none'>";
					$html[] = "<img src='".CDN."images/loader.gif' /> loading groups...";
				$html[] = "</div>";
			$html[] = "</div>";
			$html[] = "<div class='col-sm-12 col-md-9 col-lg-9'>";
				$html[] = "<div class='box-container mb-3'>";
				
					/* $html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("LeadsController@index", ["id" => $data['account_id']])."' />";
						$html[] = "<a href='".url("LeadsController@index", ["id" => $data['account_id']])."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>"; */

					if($data['leads']) { $c=$model->page['starting_number'];

						for($i=0; $i<count($data['leads']); $i++) { $c++;
							$html[] = "<div class='row row_leads_".$data['leads'][$i]['lead_id']." justify-content-center my-3 '>";
								$html[] = "<div class='col-md-3 col-lg-3 mb-2'>";
									$html[] = "<label class='text-muted fs-12 d-block'>Name</label>";
									$html[] = "<a href='".url("LeadsController@view", ["id" => $data['leads'][$i]['lead_id']])."' class='text-decoration-none text-dark'>";
										$html[] = "<span class='name-container'><img src='".CDN."images/loader.gif' /> decrypting</span>";
									$html[] = "</a>";
								$html[] = "</div>";

								$html[] = "<div class='col-md-3 col-lg-3 mb-2'>";
									$html[] = "<label class='text-muted fs-12 d-block'>Contact Info</label>";
									$html[] = "<span class='d-block email-container'><img src='".CDN."images/loader.gif' /> decrypting</span>";
									$html[] = "<span class='d-block mobile-number-container'><img src='".CDN."images/loader.gif' /> decrypting</span>";
								$html[] = "</div>";

								$html[] = "<div class='col-md-3 col-lg-3 mb-2'>";
									$html[] = "<label class='text-muted fs-12 d-block'>Preferences</label>";
									$html[] = "<div class=''>".$data['leads'][$i]['preferences']['type']."</div>";
									$html[] = "<div class=''>".$data['leads'][$i]['preferences']['category']."</div>";
									$html[] = "<div class=''>".$data['leads'][$i]['preferences']['lot_area']."</div>";
									$html[] = "<div class=''>".implode(" ", $data['leads'][$i]['preferences']['address'])."</div>";
								$html[] = "</div>";

								$html[] = "<div class='col-md-3 col-lg-3 mb-2'>";
									$html[] = "<a class='btn btn-primary me-2' href='".url("LeadsController@view",["id" => $data['leads'][$i]['lead_id']])."'>View</a>";
									if($_SESSION['user_logged']['permissions']['leads']['delete']) {
										$html[] = "<span class='btn btn-danger btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadsController@delete",["id" => $data['leads'][$i]['lead_id']])."' data-content=''><i class='ti ti-trash me-2'></i> Delete</span>";
									}
								$html[] = "</div>";
							$html[] = "</div>";
						}

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

$html[] = "<div class='btn-save-container fixed-bottom bg-white border-top d-block d-md-none'>";
    $html[] = "<div class='btn-delete text-center cursor-pointer bg-primary py-3 text-white' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadGroupsController@index")."' data-content=''>";
		$html[] = "<span class='fw-bold'>Lead Groups <i class='ti ti-caret-up'></i></span>";
    $html[] = "</div>";

	$html[] = "<div class='list-group-bottom bg-white rounded' style='height:0;'>";
		$html[] = "<img src='".CDN."images/loader.gif' /> loading groups...";
	$html[] = "</div>";
$html[] = "</div>";