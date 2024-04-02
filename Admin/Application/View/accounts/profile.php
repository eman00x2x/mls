<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveUpdate",["id" => $data['account_id']])."' />";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<h1 class='page-title'><i class='ti ti-file-certificate me-2'></i> Profile </h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list text-end'>";
					$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@index")."' title='Accounts'><i class='ti ti-list me-2'></i> Accounts</a>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
/** START PAGE BODY */
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<form id='form' action='' method='POST'>";
			$html[] = "<div class='d-flex flex-wrap gap-2'>";
				$html[] = "<div class=''>";
				
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>About You</h3>";
						$html[] = "</div>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='form-floating mb-3'>";
								$html[] = "<textarea name='about_me' id='about_me' class='form-control' style='height:150px; width:100%'></textarea>";
								$html[] = "<label for='about_me'>Tell about your self</label>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Education</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='education'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body education-container'>";
							for($i=0; $i<1; $i++) {
								$html[] = "<div class='mb-4 border-bottom'>";
									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='education[$i][school]' id='education-school-$i' class='form-control' value='' />";
										$html[] = "<label for='education-school-$i'>School Name</label>";
									$html[] = "</div>";

									$html[] = "<div class='row'>";
										$html[] = "<div class='col-lg-5 col-md-12 col-sm-12'>";
											$html[] = "<div class='form-floating mb-3 w-100'>";
												$html[] = "<input type='text' name='education[$i][degree]' id='education-degree-$i' class='form-control' value='' />";
												$html[] = "<label for='education-degree-$i'>Degree</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-lg-7 col-md-12 col-sm-12'>";
											$html[] = "<div class='d-flex gap-3 justify-content-end'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='education[$i][date][from]' id='education-date-$i' class='form-control' style='width:130px;' value='' />";
													$html[] = "<label for='education-date-$i'>From</label>";
												$html[] = "</div>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='education[$i][date][to]' id='education-date-$i' class='form-control' style='width:130px;' value='' />";
													$html[] = "<label for='education-date-$i'>To</label>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";

						$html[] = "<input type='hidden' id='education-fields-count' value='$i' />";

					$html[] = "</div>";
				$html[] = "</div>";
				$html[] = "<div class=''>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Affiliation</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='affiliation'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body affiliation-container'>";
								
							for($i=0; $i<1; $i++) {
								$html[] = "<div class='mb-4 border-bottom'>";
									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='affiliation[$i][organization]' id='affiliation-organization-$i' class='form-control' value='' />";
										$html[] = "<label for='affiliation-organization-$i'>Organization Name</label>";
									$html[] = "</div>";
									
									$html[] = "<div class='row'>";
										$html[] = "<div class='col-lg-5 col-md-12 col-sm-12'>";
											$html[] = "<div class='form-floating mb-3 w-100'>";
												$html[] = "<input type='text' name='affiliation[$i][title]' id='affiliation-title-$i' class='form-control' value='' />";
												$html[] = "<label for='affiliation-title-$i'>Position</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-lg-7 col-md-12 col-sm-12'>";
											$html[] = "<div class='d-flex gap-3 justify-content-end'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='affiliation[$i][date][from]' id='affiliation-date-$i' class='form-control' style='width:130px;' value='' />";
													$html[] = "<label for='affiliation-date-$i'>From</label>";
												$html[] = "</div>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='affiliation[$i][date][to]' id='affiliation-date-$i' class='form-control' style='width:130px;' value='' />";
													$html[] = "<label for='affiliation-date-$i'>To</label>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
									$html[] = "<div class='form-floating mb-3'>";
										$html[] = "<textarea name='affiliation[$i][description]' id='affiliation-description-$i' class='form-control' style='height:150px; width:100%'></textarea>";
										$html[] = "<label for='affiliation-description-$i'>Short description of what you do</label>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='affiliation-fields-count' value='$i' />";
					$html[] = "</div>";

					$html[] = "<div class='card  mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Certifications</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='certification'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body certification-container'>";
								
							for($i=0; $i<1; $i++) {
								$html[] = "<div class='mb-4 border-bottom'>";
									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='certification[$i]' id='certification-$i' class='form-control' value='' />";
										$html[] = "<label for='certification-$i'>Certification</label>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='certification-fields-count' value='$i' />";
					$html[] = "</div>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Skills</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='skills'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body skills-container'>";
							for($i=0; $i<1; $i++) {
								$html[] = "<div class='mb-4 border-bottom'>";
									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='skills[$i]' id='skills-$i' class='form-control' value='' />";
										$html[] = "<label for='skills-$i'>Skills</label>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='skills-fields-count' value='$i' />";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
					
		$html[] = "</form>";
		
	$html[] = "</div>";
$html[] = "</div>";
/** END PAGE */


$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Profile</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";