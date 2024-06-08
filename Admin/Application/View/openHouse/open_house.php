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
				$html[] = "<h1 class='page-title '><i class='ti ti-speakerphone me-2'></i> Open House Announcements</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto '>";
				$html[] = "<div class='btn-list text-end'>";
					if(!in_array($_SESSION['user_logged']['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
						$html[] = "<a class='ajax btn btn-dark' href='".url("OpenHouseAnnouncementsController@add")."'><i class='ti ti-speakerphone me-2'></i> Create Announcement</a>";
					}
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
	
		$html[] = "<div class='box-container mb-3'>";
		
			$html[] = "<div class='search-box mb-3'>";
				$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Open House' data-url='".url("OpenHouseAnnouncementsController@index")."' />";
				$html[] = "<a href='".url("OpenHouseAnnouncementsController@index", null)."' class='clearFilter'>CLEAR FILTER</a>";
			$html[] = "</div>";
			if($data) { $c=0;
				
				$html[] = "<div class='row row-deck row-cards'>";
					for($i=0; $i<count($data); $i++) {
						$html[] = "<div class='col-sm-6 col-md-4 col-lg-3 col-12 row_open_house_".$data[$i]['announcement_id']."'>";
							$html[] = "<div class='card'>";

								$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data[$i]['attachment'].")'></div>";

								$html[] = "<div class='card-body'>";
									$html[] = "<h3 class='mb-0'>".$data[$i]['subject']."</h3>";
									$html[] = "<p class='fs-12 '>".$data[$i]['listing_title']."</p>";
									$html[] = "<ul class='list-group list-group-flush'>";
										$html[] = "<li class='list-group-item p-2'><i class='ti ti-map-pin fs-14'></i> ".$data[$i]['content']['address']."</li>";
										
										if($data[$i]['content']['details'] != "") {
											$html[] = "<li class='list-group-item p-2'><i class='ti ti-file-info fs-14'></i> ".$data[$i]['content']['details']."</li>";
										}

										$html[] = "<li class='list-group-item p-2'><i class='ti ti-calendar fs-14'></i> ".date("d M Y h:iA", strtotime($data[$i]['content']['date']))."</li>";
										$html[] = "<li class='list-group-item p-2'><i class='ti ti-calendar fs-14'></i> End at ".date("d M Y", $data[$i]['ended_at'])."</li>";
										$html[] = "<li class='list-group-item p-2'></li>";

										if(in_array($_SESSION['user_logged']['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
											$html[] = "<li class='list-group-item p-2'><i class='ti ti-speakerphone fs-14'></i> Announce by ".$data[$i]['account_name']['firstname']." ".$data[$i]['account_name']['middlename']." ".$data[$i]['account_name']['lastname']." ".$data[$i]['account_name']['suffix']."</li>";
										}

									$html[] = "</ul>";
								$html[] = "</div>";

								$html[] = "<div class='d-flex'>";
									$html[] = "<a href='".url("OpenHouseAnnouncementsController@edit", ["id" => $data[$i]['announcement_id']])."' class='card-btn btn-edit py-3'><i class='ti ti-edit me-2'></i> Edit</a>";
									$html[] = "<span class='card-btn btn-delete py-3 text-danger cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("OpenHouseAnnouncementsController@delete", ["id" => $data[$i]['announcement_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
								$html[] = "</div>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					}
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