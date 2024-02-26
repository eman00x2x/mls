<?php

$html[] = "<div class='row g-0'>";
	$html[] = "<div class='col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<h1 class='page-title '><i class='ti ti-users me-2'></i> Articles</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto '>";
						$html[] = "<div class='btn-list text-end'>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("ArticlesController@add")."'><i class='ti ti-user-plus me-2'></i> New Article</a>";
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

				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box mb-3'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Articles' data-url='".url("ArticlesController@index")."' />";
						$html[] = "<a href='".url("ArticlesController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data) { $c=0;
						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th>Title</th>";
									$html[] = "<th>Created By</th>";
									$html[] = "<th>Created At</th>";
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data); $i++) { $c++;
								
								$html[] = "<tr class='row_user_".$data[$i]['article_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><a href='".url("ArticlesController@edit",["id" => $data[$i]['article_id']])."' class='ajax text-inherit' title='".$data[$i]['title']."'>".$data[$i]['title']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ArticlesController@edit",["id" => $data[$i]['article_id']])."'>".$data[$i]['created_by']."</a></td>";
									$html[] = "<td class='align-middle'>".date("F d, Y",$data[$i]['created_at'])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("ArticlesController@edit",["id" => $data[$i]['article_id']])."' title='Update: ".$data[$i]['title']."'><i class='ti ti-edit me-2'></i> Edit Article</a>";
												$html[] = "<span class='ajax dropdown-item text-white bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ArticlesController@delete",["id" => $data[$i]['article_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
											$html[] = "</div>";
											
										$html[] = "</div>";
									
									$html[] = "</td>";
									
								$html[] = "</tr>";
								
							}
							$html[] = "</tbody>";
							$html[] = "</table>";
							
						$html[] = "</div>";
						
					}else {
						$html[] = "<p class='mt-3'>You do not have Articles.</p>";
					}
					
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";

if(!empty($model)) {
	$html[] = $model->pagination;
}