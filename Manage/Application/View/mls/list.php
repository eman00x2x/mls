<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Multi-Listing Services System</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href=''><i class='ti ti-user-plus me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark filter-btn' href=''><i class='ti ti-filter me-2'></i> Filter Result</span>";
						
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

			$html[] = "<div class='col-md-3 col-sm-4'>";
				$html[] = "<div class='box-container mb-3'>";
					
					$html[] = "<div class=''>";

						$html[] = "<h3><i class='ti ti-filter me-2'></i> Filter Form</h3>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Address</label>";
							$html[] = $model->addresses->addressSelection();
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted mb-2'>Foreclosure Property</label>";
							$html[] = "<div class='form-group'>";
								$html[] = "<label class='form-check form-switch cursor-pointer'>";
									$html[] = "<input class='form-check-input' type='checkbox' name='foreclosed' value='1' id='foreclosure'  />";
									$html[] = "<span class='form-check-label' for='foreclosure'>Include foreclosure property?</span>";
								$html[] = "</label>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Offer</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-tags'></i></span>";
								$html[] = "<select class='form-control' name='offer' id='offer'>";
									$offer_type = array("For Sale","For Rent");
									foreach($offer_type as $key => $val) {
										$html[] = "<option value='".strtolower($val)."'>$val</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Property Type</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-building-estate'></i></span>";
								$html[] = "<select class='form-control' name='type' id='type'>";
									$offer_type = array("Residential","Commercial");
									foreach($offer_type as $key => $val) {
										$html[] = "<option value='".$val."'>$val</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Category</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-building-store'></i></span>";
								$html[] = $model->categorySelection();
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

					    $html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Bedroom</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-bed-flat'></i></span>";
								$html[] = "<select class='form-select' name='bedroom' id='bedroom'>";
									$html[] = "<option value=''>N/A</option>";
									$html[] = "<option value='Studio'>Studio</option>";
									for($i=1; $i<11; $i++) {
										$html[] = "<option value='$i'>$i Bedroom</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Bathroom</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-bath'></i></span>";
								$html[] = "<select class='form-select' name='bathroom' id='bathroom'>";
									for($i=0; $i<11; $i++) {
										$html[] = "<option value='$i'>".($i == 0 ? "No" : $i)." Bathroom</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='form-group mb-3'>";
							$html[] = "<label class='form-label text-muted'>Car Garage</label>";
							$html[] = "<div class='input-icon mb-3'>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-car-garage'></i></span>";
								$html[] = "<select class='form-select' name='parking' id='parking'>";
									for($i=0; $i<11; $i++) {
										$html[] = "<option value='$i'>".($i == 0 ? "No Garage" : $i." car slot")."</option>";
									}
								$html[] = "</select>";
								$html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
							$html[] = "</div>";
						$html[] = "</div>";

						$html[] = "<div class='text-end'>";
							$html[] = "<span class='btn btn-primary filter-result-btn'>View Result</span>";
						$html[] = "</div>";

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-md-9 col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search' data-url='".url("MlsController@index")."' />";
						$html[] = "<a href='".url("MlsController@index")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

					if($data['listings']) { $c=$model->page['starting_number'];

						for($i=0; $i<count($data['listings']); $i++) { $c++;
							$html[] = "<div class='listing-wrap my-2'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-3'>";
										$html[] = "<div class='avatar avatar-xxxl' style='background-image: url(".$data['listings'][$i]['thumb_img'].")'></div>";
									$html[] = "</div>";
									$html[] = "<div class='col-8'>";
										$html[] = "<h2 class='p-0'>".$data['listings'][$i]['title']."<small class='d-block fw-normal'>".ucwords($data['listings'][$i]['offer'])." ".$data['listings'][$i]['category']." in ".$data['listings'][$i]['address']['municipality'].", ".$data['listings'][$i]['address']['province']."</small></h2>";

										$html[] = "<div class='mb-3'>";
											$html[] = "<div class='d-flex'>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Floor Area</label>".number_format($data['listings'][$i]['floor_area'],0)." sqm</span>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Lot Area</label>".number_format($data['listings'][$i]['lot_area'],0)." sqm</span>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Unit Area</label>".number_format($data['listings'][$i]['unit_area'],0)." sqm</span>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Bedroom</label>".$data['listings'][$i]['bedroom']."</span>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Bathroom</label>".$data['listings'][$i]['bathroom']."</span>";
												$html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Car Garage</label>".$data['listings'][$i]['parking']."</span>";
											$html[] = "</div>";
										$html[] = "</div>";

									$html[] = "</div>";
								$html[] = "</div>";
								
							$html[] = "</div>";
						}


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
									$html[] = "<th class='text-center'><i class='icon-settings'></i></th>";
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
									$html[] = "<td class='align-middle'><a href='".url("MlsController@view",["id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['title']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("MlsController@view",["id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['type']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("MlsController@view",["id" => $data['listings'][$i]['listing_id']])."'>".$data['listings'][$i]['category']."</a></td>";
									$html[] = "<td class='align-middle'><a href='".url("MlsController@view",["id" => $data['listings'][$i]['listing_id']])."'>".(implode(" ",$address))."</a></td>";
									$html[] = "<td class='align-middle text-end'><a href='".url("MlsController@view",["id" => $data['listings'][$i]['listing_id']])."'>".convertMillions($data['listings'][$i]['price'])."</a></td>";
									$html[] = "<td class='align-middle'>".($availability[$data['listings'][$i]['status']])."</td>";
									
									$html[] = "<td class='text-center'>";
									
										$html[] = "<div class='item-action dropdown'>";
										
											$html[] = "<span class='btn btn-outline-primary btn-md' data-bs-toggle='dropdown'><i class='ti ti-dots-vertical'></i></span>";
											
											$html[] = "<div class='dropdown-menu dropdown-menu-right'>";
												$html[] = "<a class='ajax dropdown-item' href='".url("MlsController@handshake",["id" => $data['listings'][$i]['listing_id']])."'><i class='ti ti-edit me-2'></i> Request Handshake</a>";
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