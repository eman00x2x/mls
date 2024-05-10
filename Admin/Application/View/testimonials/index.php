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
				$html[] = "<h1 class='page-title '><i class='ti ti-speakerphone me-2'></i> Testimonials</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto '>";
				$html[] = "<div class='btn-list text-end'>";
					$html[] = "<a class='ajax btn btn-dark' href='".url("TestimonialsController@add")."'><i class='ti ti-speakerphone me-2'></i> New Testimonial</a>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
	
		$html[] = "<div class='box-container mb-3'>";
		
			$html[] = "<div class='search-box mb-3'>";
				$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Testimonials' data-url='".url("TestimonialsController@index")."' />";
				$html[] = "<a href='".url("TestimonialsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
			$html[] = "</div>";
			if($data) { $c=0;
				$html[] = "<div class='table-responsive'>";
					
					$html[] = "<table class='table table-hover table-outline'>";
					$html[] = "<thead>";
						$html[] = "<tr>";
							$html[] = "<th class='text-center w-1'>#</th>";
							$html[] = "<th>Name</th>";
							$html[] = "<th>Content</th>";
							$html[] = "<th>Created At</th>";
							$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
						$html[] = "</tr>";
					$html[] = "</thead>";
					
					$html[] = "<tbody>";
					for($i=0; $i<count($data); $i++) { $c++;
						
						$html[] = "<tr class='row_article_".$data[$i]['testimonial_id']."'>";
							$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
							$html[] = "<td class='align-middle'><a href='".url("TestimonialsController@edit",["id" => $data[$i]['testimonial_id']])."' class='ajax text-inherit' title='".$data[$i]['name']."'>".$data[$i]['name']."</a></td>";
							$html[] = "<td class='align-middle'><a href='".url("TestimonialsController@edit",["id" => $data[$i]['testimonial_id']])."' class='ajax text-inherit' title='".$data[$i]['content']."'>".nicetrim($data[$i]['content'], 80)."</a></td>";
							$html[] = "<td class='align-middle'>".date("F d, Y",$data[$i]['created_at'])."</td>";
							
							$html[] = "<td class='text-center'>";
							
								$html[] = "<div class='item-action dropdown'>";
								
									$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
									
									$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
										$html[] = "<a class='ajax dropdown-item' href='".url("TestimonialsController@edit",["id" => $data[$i]['testimonial_id']])."'><i class='ti ti-edit me-2'></i> Edit Testimonial</a>";
										$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("TestimonialsController@delete",["id" => $data[$i]['testimonial_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
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