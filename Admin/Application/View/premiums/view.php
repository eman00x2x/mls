<?php

$html[] = "<div class='response'>";
	$html[] = "<div class='container-xl'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

	$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-12 m-auto '>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				$html[] = "<div class='container-xl'>";
					$html[] = "<div class='row g-2 '>";
						$html[] = "<div class='col'>";
							$html[] = "<div class='page-pretitle'>A Premium that the general public can subscribe to.</div>";
							$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Premium</h1>";
						$html[] = "</div>";
						$html[] = "<div class='col-auto ms-auto d-print-none'>";
							$html[] = "<div class='btn-list text-end'>";
								$html[] = "<a class='ajax btn btn-dark' href='".url("PremiumsController@edit",["id" => $data['premium_id']])."'><i class='ti ti-edit me-2'></i> Update Premium</a>";
								if($_SESSION['user_logged']['user_level'] == 1) {
									$html[] = "<span class='ajax btn btn-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("PremiumsController@delete",["id" => $data['premium_id']])."'><i class='ti ti-trash me-2'></i> Delete Premium</span>";
								}
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='page-body'>";
				$html[] = "<div class='container-xl'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-layers-union me-2'></i> Subscription Info</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Subscription Name</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' readonly class='form-control-plaintext' value='".$data['name']."' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Details</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<textarea class='form-control-plaintext' readonly>".$data['details']."</textarea>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Cost</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<div class='input-icon'>";
										$html[] = "<span class='input-icon-addon'>&#8369;</span>";
										$html[] = "<input type='text' readonly value='".$data['cost']."' class='form-control-plaintext ps-5' />";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-settings me-2'></i> Settings</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Type</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' readonly class='form-control-plaintext' value='".ucwords(str_replace("_"," ",$data['type']))."' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Duration</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' readonly class='form-control-plaintext' value='".implode(" days, ", $data['duration'])." days' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row'>";
								$html[] = "<label class='col-sm-3 col-form-label  text-end'>Public Visibility</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' readonly class='form-control-plaintext' value='".($data['visibility'] == 1 ? "Show" : "Hide")."' />";
								$html[] = "</div>";
							$html[] = "</div>";
								
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-json me-2'></i> Script</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";
							
							foreach($data['script'] as $premium => $val) {
								$html[] = "<div class='row align-items-center'>";
									$html[] = "<label class='col-sm-3 col-form-label  text-end'>".ucwords(str_replace("_", " ", $premium))."</label>";
									$html[] = "<div class='col-sm-9'>";
										if(in_array($premium, ["mls_access", "chat_access", "comparative_analysis_access"])) {
											$html[] = "<div>".(isset($data['script'][$premium]) ? "Yes" : null)."</div>";
										}else {
											$html[] = "<div>".(isset($data['script'][$premium]) ? $data['script'][$premium] : null)."</div>";
										}
									$html[] = "</div>";
								$html[] = "</div>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
