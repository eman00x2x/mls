<?php

function currentUrl(object $model, array $param = [], array $uri = []) {
	return url("AccountsController@memberDirectory", $param, $uri);
}

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-4 justify-content-center'>";
			$html[] = "<div class='col-md-3 col-lg-3 d-none d-lg-block'>";
				$html[] = "<div class='sidebar bg-white p-4 border'>";

					$html[] = "<div class='filter-box'>";

						$html[] = "<div class='d-flex justify-content-between align-items-center'>";
					    	$html[] = "<h3>Filter Results</h3>";
							$html[] = "<a href='".url("AccountsController@memberDirectory")."' class='text-decoration-none'><i class='ti ti-trash'></i> Clear filter</a>";
						$html[] = "</div>";

						$html[] = "<form id='filter-form' action='' method='POST'>";

							$html[] = "<div class='form-label'>Search By Last Name</div>";
							$html[] = "<div class='mb-4'>";
									$html[] = "<input type='text' name='lastname' id='lastname' value='".(isset($_GET['lastname']) ? $_GET['lastname'] : "" )."' class='form-control' />";
							$html[] = "</div>";

							$html[] = "<div class='form-label'>Search By License #</div>";
							$html[] = "<div class='mb-4'>";
									$html[] = "<input type='text' name='real_estate_license_number' id='real_estate_license_number' value='".(isset($_GET['real_estate_license_number']) ? $_GET['real_estate_license_number'] : "" )."' class='form-control' />";
							$html[] = "</div>";

							if(isset($data['services']) && count($data['services']) > 0) {
								$html[] = "<div class='form-label'>Limit By Services</div>";
								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
										foreach($data['services'] as $services) {
											$checked = isset($model->page['uri']['services']) && in_array($services, $model->page['uri']['services']) ? "checked" : "";										
											$html[] = "<label class='form-check cursor-pointer $checked'>";
												$html[] = "<input type='checkbox' class='form-check-input' name='services[]' value='$services' $checked />";
												$html[] = "<span class='form-check-label'>$services</span>";
											$html[] = "</label>";
										}
									$html[] = "</div>";
								$html[] = "</div>";
							}
							
							$html[] = "<div class='form-label'>Limit By Boards</div>";
							$html[] = "<div class='mb-4'>";
								$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
									foreach(LOCAL_BOARDS as $local_board_name) {
										$checked = isset($model->page['uri']['local_board_name']) && in_array($local_board_name, $model->page['uri']['local_board_name']) ? "checked" : "";										
										$html[] = "<label class='form-check cursor-pointer $checked'>";
											$html[] = "<input type='checkbox' class='form-check-input' name='local_board_name[]' value='$local_board_name' $checked />";
											$html[] = "<span class='form-check-label'>$local_board_name</span>";
										$html[] = "</label>";
									}
								$html[] = "</div>";
							$html[] = "</div>";

							if(isset($data['certifications']) && count($data['certifications']) > 0) {
								$html[] = "<div class='form-label'>Limit By Certifications</div>";
								$html[] = "<div class='mb-4'>";
									$html[] = "<div class='overflow-auto border p-3 bg-white' style='min-height:100px; max-height:200px;'>";
										foreach($data['certifications'] as $certifications) {
											$checked = isset($model->page['uri']['certifications']) && in_array($certifications, $model->page['uri']['certifications']) ? "checked" : "";										
											$html[] = "<label class='form-check cursor-pointer $checked'>";
												$html[] = "<input type='checkbox' class='form-check-input' name='certifications[]' value='$certifications' $checked />";
												$html[] = "<span class='form-check-label'>$certifications</span>";
											$html[] = "</label>";
										}
									$html[] = "</div>";
								$html[] = "</div>";
							}

						$html[] = "</form>";

						$html[] = "<div class='btn-filter-container mt-5 sticky-bottom'>";
							$html[] = "<div class='pb-4' style='background-color: #FFF; margin-bottom: -15px !important;'>";
								$html[] = "<span class='btn btn-primary w-100 btn-filter'><i class='ti ti-filter me-1'></i> Filter Result</span>";
							$html[] = "</div>";
						$html[] = "</div>";

					$html[] = "</div>";
				
        		$html[] = "</div>";
        	$html[] = "</div>";

			$html[] = "<div class='col-md-10 col-lg-9'>";

				$html[] = "<div class='px-2'>";
					/** PAGE ADS */
					$html[] = "<div class='mb-4'>";
						$html[] = "<div class='d-none PROPERTY_LIST_TOP'>";
							$html[] = "<a href='#' target='_blank'>";
								$html[] = "<div class='card bg-dark-lt rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:250px;'>";
									$html[] = "<div class='loader'></div>";
									$html[] = "<p>Loading Ads</p>";
								$html[] = "</div>";
							$html[] = "</a>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='mb-2 d-flex align-items-baseline justify-content-between'>";

						$html[] = "<div class=''>";
							$html[] = "<h1 class='m-0'>".CONFIG['site_name']." Members Directory</h1>";
							$html[] = "<p>There are a total of (".$model->rows.") results</p>";
						$html[] = "</div>";
						
						$html[] = "<div class='btn-group'>";
							$html[] = "<div class='btn-group dropstart'>";
								$html[] = "<span class='btn btn-outline-secondary dropdown-toggle' id='btn-sort' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-sort-descending me-1'></i> Sort</span>";
								$html[] = "<ul class='dropdown-menu' aria-labelledby='btn-sort'>";

									$uri = function(array $uri) use ($model) {
										$r = $model->page['uri'];
										unset($r['offer']);

										foreach($uri as $k => $v) {
											$r[$k] = $v;
										}
										
										return $r;
									};

									$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "local_board_name", "order" => (isset($_GET['order']) ? ($_GET['order'] == "ASC" ? "DESC" : "ASC") : "ASC")]) )."' class='dropdown-item'>Board Name ".(isset($_GET['order']) ? ($_GET['order'] == "ASC" ? "DESC" : "ASC") : "ASC")."</a></li>";
									$html[] = "<li><a href='".currentUrl($model, [], $uri(["sort" => "lastname", "order" => (isset($_GET['order']) ? ($_GET['order'] == "ASC" ? "DESC" : "ASC") : "ASC")]) )."' class='dropdown-item'>Last Name ".(isset($_GET['order']) ? ($_GET['order'] == "ASC" ? "DESC" : "ASC") : "ASC")."</a></li>";
								$html[] = "</ul>";
							$html[] = "</div>";

							$html[] = "<span class='btn btn-outline-secondary btn-filter-toggle d-md-block d-lg-none' data-bs-toggle='offcanvas' href='#offcanvasEnd' role='button' aria-controls='offcanvasEnd'><i class='ti ti-filter me-1'></i> Filter</span>";
						$html[] = "</div>";

					$html[] = "</div>";

					/** MEMBER LIST */
					$html[] = "<div class='row row-deck row-cards'>";
						if($data['accounts']) {
							for($i=0; $i<count($data['accounts']); $i++) {
								$html[] = "<div class='col-md-6 col-lg-3'>";
									$html[] = "<div class='card'>";
										$html[] = "<div class='card-body p-4 text-center'>";
											$html[] = "<span class='avatar avatar-xl mb-3 rounded' style='background-image: url(".CDN."/images/accounts/".$data['accounts'][$i]['logo'].")'></span>";
											$html[] = "<h3 class='m-0 mb-1'>";
												$html[] = "<a href='".url("AccountsController@profile", ["id" => $data['accounts'][$i]['account_id'], "name" => sanitize($data['accounts'][$i]['account_name']['firstname']."-".$data['accounts'][$i]['account_name']['lastname'])])."' class='stretched-link text-decoration-none'>".$data['accounts'][$i]['account_name']['firstname']." ".$data['accounts'][$i]['account_name']['middlename']." ".$data['accounts'][$i]['account_name']['lastname']." ".$data['accounts'][$i]['account_name']['suffix']."</a>";
											$html[] = "</h3>";
											$html[] = "<span class='d-block'>".$data['accounts'][$i]['profession']."</span>";
											$html[] = "<span class='d-block fs-12 text-muted'>PRC License #".$data['accounts'][$i]['real_estate_license_number']."</span>";
											
											$html[] = "<div class='mt-3'>";
												$html[] = "<span class=' bg-purple-lt fs-12'>".$data['accounts'][$i]['local_board_name']."</span>";
												/* $html[] = "<span class='d-block fs-12'>".$data['accounts'][$i]['board_region']['region']."</span>"; */
											$html[] = "</div>";

										$html[] = "</div>";
										$html[] = "<div class='d-flex'>";
											$html[] = "<a href='mailto:".$data['accounts'][$i]['email']."' class='card-btn'><svg xmlns='http://www.w3.org/2000/svg' class='icon me-2 text-muted' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z'></path><path d='M3 7l9 6l9 -6'></path></svg> Email</a>";
											$html[] = "<a href='viber://chat/?number=".str_replace("+","%2B", (!is_null($data['accounts'][$i]['mobile_number']) ? $data['accounts'][$i]['mobile_number'] : ""))."' class='card-btn'><svg xmlns='http://www.w3.org/2000/svg' class='icon me-2 text-muted' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2'></path></svg> Call</a>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						}
					$html[] = "</div>";

					if(!empty($model)) {
						$html[] = "<div class='mt-4'>";
							$html[] = $model->pagination;
						$html[] = "</div>";
					}
				$html[] = "</div>";

        	$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";