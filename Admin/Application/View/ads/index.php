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
				$html[] = "<h1 class='page-title '><i class='ti ti-ad me-2'></i> Page Ads</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto '>";
				$html[] = "<div class='btn-list text-end'>";
					$html[] = "<a class='ajax btn btn-dark' href='".url("PageAdsController@add")."'><i class='ti ti-ad me-2'></i> New Page Ads</a>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
	
		$html[] = "<div class='box-container mb-3'>";
		
			if($data) { $c=0;
				$html[] = "<div class='table-responsive'>";
					
					$html[] = "<table class='table table-hover table-outline'>";
					$html[] = "<thead>";
						$html[] = "<tr>";
							$html[] = "<th class='text-center w-1'>#</th>";
							$html[] = "<th>Placement</th>";
							$html[] = "<th>Visibility</th>";
							$html[] = "<th>Start At</th>";
							$html[] = "<th>End At</th>";
							$html[] = "<th>Created At</th>";
							$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
						$html[] = "</tr>";
					$html[] = "</thead>";
					
					$html[] = "<tbody>";
					for($i=0; $i<count($data); $i++) { $c++;
						
						$html[] = "<tr class='row_page_ads_".$data[$i]['page_ads_id']."'>";
							$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
							$html[] = "<td class='align-middle'><a href='".url("PageAdsController@edit",["id" => $data[$i]['page_ads_id']])."' class='text-decoration-none'>".$data[$i]['placement']."</a></td>";
							$html[] = "<td class='align-middle'><a href='".url("PageAdsController@edit",["id" => $data[$i]['page_ads_id']])."' class='text-decoration-none'>".ucwords($data[$i]['visibility'])."</a></td>";
							$html[] = "<td class='align-middle'>".date("F d, Y g:i a", $data[$i]['started_at'])."</td>";
							$html[] = "<td class='align-middle'>".date("F d, Y g:i a", $data[$i]['ended_at'])."</td>";
							$html[] = "<td class='align-middle'>".date("F d, Y", $data[$i]['created_at'])."</td>";
							
							$html[] = "<td class='text-center'>";
							
								$html[] = "<div class='item-action dropdown'>";
								
									$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
									
									$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
										$html[] = "<a class='ajax dropdown-item' href='".url("PageAdsController@edit",["id" => $data[$i]['page_ads_id']])."' ><i class='ti ti-edit me-2'></i> Update Page Ads Settings</a>";
										$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("PageAdsController@delete",["id" => $data[$i]['page_ads_id']])."'><i class='ti ti-trash me-2'></i> Delete Page Ads</span>";
									$html[] = "</div>";
									
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