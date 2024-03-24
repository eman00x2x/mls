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
				$html[] = "<div class='page-pretitle'>Manage Property Listing of ".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> Property Listings</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class=''>";
					$html[] = "<div class='btn-list'>";
						
						if($_SESSION['user_logged']['account_type'] == "Administrator") {
							$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account_id']])."'>";
								$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
								$html[] = $data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']." account";
							$html[] = "</a>";
							$html[] = "<a class='ajax btn btn-dark' href='".url("ListingsController@add", ["id" => $data['account_id']])."'><i class='ti ti-user-plus me-2'></i> New Listing</a>";
						}else {
							$html[] = "<a class='ajax btn btn-dark' href='".url("ListingsController@addListing")."'><i class='ti ti-user-plus me-2'></i> New Listing</a>";
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
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box d-print-none'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("ListingsController@index", ["id" => $data['account_id']])."' />";
						$html[] = "<a href='".url("ListingsController@index", ["id" => $data['account_id']])."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['listings']) { $c=$model->page['starting_number'];

						$html[] = "<div class='table-responsive'>";
							
							$html[] = "<table class='table table-hover table-outline'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='text-center w-1'>#</th>";
									$html[] = "<th class='w-1'></th>";
									$html[] = "<th>Title</th>";
									$html[] = "<th>Type</th>";
									$html[] = "<th>Category</th>";
									$html[] = "<th>Address</th>";
									$html[] = "<th class='text-end'>Price</th>";
									$html[] = "<th>Status</th>";
									$html[] = "<th class='text-center'></th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tbody>";
							for($i=0; $i<count($data['listings']); $i++) { $c++;

								$availability = array(
									1 => "<span class='text-success '>Available</span>",
									2 => "<span class='text-danger'>Sold</span>",
									3 => "<span class='text-muted'>Sold</span>"
								);

								$address = $data['listings'][$i]['address'];
								unset($address['region']);
								
								$html[] = "<tr class='row_listings_".$data['listings'][$i]['listing_id']."'>";
									$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
									$html[] = "<td class='align-middle'><div class='avatar' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['title']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['type']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['category']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'>".(implode(" ",$address))."</a></td>";
									$html[] = "<td class='align-middle text-end'><a href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'>".convertMillions($data['listings'][$i]['price'])."</a></td>";
									$html[] = "<td class='align-middle'>".($availability[$data['listings'][$i]['status']])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary btn-md' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("ListingsController@edit",["id" => $data['listings'][$i]['account_id'], "listing_id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-edit me-2'></i> Update Listing</a>";
												if($_SESSION['user_logged']['account_type'] == "Administrator" || $_SESSION['user_logged']['permissions']['properties'] == true) {
													$html[] = "<span class='dropdown-item text-light bg-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("ListingsController@delete",["id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-trash me-2'></i> Delete</span>";
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
						$html[] = "<p class='mt-3'>You do not have property listing.</p>";
					}
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";