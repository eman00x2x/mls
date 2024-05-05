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
					$html[] = "<span class='btn btn-dark btn-view-profile' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountsController@profilePreview", ["id" => $data['account_id']])."'><i class='ti ti-list me-2'></i> Preview Profile</span>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
/** START PAGE BODY */
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<form id='form' action='' method='POST'>";

			$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

			$html[] = "<div class='row row-deck row-cards'>";

				$html[] = "<div class='col-sm-12 col-lg-6 col-md-12'>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>About You</h3>";
						$html[] = "</div>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class='form-floating mb-3'>";
								$html[] = "<textarea name='about_me' id='about_me' class='form-control' style='height:150px; width:100%'>".$data['profile']['about_me']."</textarea>";
								$html[] = "<label for='about_me'>Share information about yourself</label>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='col-sm-12 col-lg-6 col-md-12 d-flex gap-3 flex-wrap'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Social Media Profiles</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='socials'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body socials-container'>";

							if(!isset($data['profile']['socials'])) {
								$data['profile']['socials'] = [""];
							}

							$count = count($data['profile']['socials']) > 0 ? count($data['profile']['socials']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='mb-2 socials-container-$i'>";
									$html[] = "<div class='input-group input-group-flat'>";
										$html[] = "<div class='form-floating'>";
											$html[] = "<input type='text' name='socials[]' id='socials-$i' class='form-control' value='".$data['profile']['socials'][$i]."' />";
											$html[] = "<label for='socials-$i' class='fs-12'>Social Media Profiles</label>";
										$html[] = "</div>";
										$html[] = "<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.socials-container-$i'><i class='ti ti-trash fs-16'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='socials-fields-count' value='$i' />";
					$html[] = "</div>";

				$html[] = "</div>";

				$html[] = "<div class='col-sm-12 col-lg-12 col-md-12 d-flex gap-3 flex-wrap'>";

					$html[] = "<div class='card  mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Certifications</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='certification'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body certification-container'>";
								
							$count = count($data['profile']['certification']) > 0 ? count($data['profile']['certification']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='mb-2 certification-container-$i'>";
									$html[] = "<div class='input-group input-group-flat'>";
										$html[] = "<div class='form-floating'>";
											$html[] = "<input type='text' name='certification[]' id='certification-$i' class='form-control' value='".$data['profile']['certification'][$i]."' />";
											$html[] = "<label for='certification-$i' class='fs-12'>Certification</label>";
										$html[] = "</div>";
										$html[] = "<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.certification-container-$i'><i class='ti ti-trash fs-16'></i></span>";
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
							$count = count($data['profile']['skills']) > 0 ? count($data['profile']['skills']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='mb-2 skills-container-$i'>";
									$html[] = "<div class='input-group input-group-flat'>";
										$html[] = "<div class='form-floating'>";
											$html[] = "<input type='text' name='skills[]' id='skills-$i' class='form-control' value='".$data['profile']['skills'][$i]."' />";
											$html[] = "<label for='skills-$i' class='fs-12'>Skill</label>";
										$html[] = "</div>";
										$html[] = "<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.skills-container-$i'><i class='ti ti-trash fs-16'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='hobbies-fields-count' value='$i' />";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Hobbies</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='hobbies'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body hobbies-container'>";

							if(!isset($data['profile']['hobbies'])) {
								$data['profile']['hobbies'] = [""];
							}

							$count = count($data['profile']['hobbies']) > 0 ? count($data['profile']['hobbies']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='mb-2 hobbies-container-$i'>";
									$html[] = "<div class='input-group input-group-flat'>";
										$html[] = "<div class='form-floating'>";
											$html[] = "<input type='text' name='hobbies[]' id='hobbies-$i' class='form-control' value='".$data['profile']['hobbies'][$i]."' />";
											$html[] = "<label for='hobbies-$i' class='fs-12'>Hobbies</label>";
										$html[] = "</div>";
										$html[] = "<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.hobbies-container-$i'><i class='ti ti-trash fs-16'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='hobbies-fields-count' value='$i' />";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Websites</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='websites'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body websites-container'>";

							if(!isset($data['profile']['websites'])) {
								$data['profile']['websites'] = [""];
							}

							$count = count($data['profile']['websites']) > 0 ? count($data['profile']['websites']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='mb-2 websites-container-$i'>";
									$html[] = "<div class='input-group input-group-flat'>";
										$html[] = "<div class='form-floating'>";
											$html[] = "<input type='text' name='websites[]' id='websites-$i' class='form-control' value='".$data['profile']['websites'][$i]."' />";
											$html[] = "<label for='websites-$i' class='fs-12'>Websites</label>";
										$html[] = "</div>";
										$html[] = "<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.websites-container-$i'><i class='ti ti-trash fs-16'></i></span>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='websites-fields-count' value='$i' />";
					$html[] = "</div>";

				$html[] = "</div>";

				$html[] = "<div class='col-sm-12 col-lg-6 col-md-12'>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Your Affiliation</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='affiliation'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body affiliation-container'>";
								
							$count = count($data['profile']['affiliation']) > 0 ? count($data['profile']['affiliation']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='".($i==0 ? "" : "mb-4 border-bottom")." affiliation-container-$i'>";

									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='affiliation[$i][organization]' id='affiliation-organization-$i' class='form-control' value='".$data['profile']['affiliation'][$i]['organization']."' />";
										$html[] = "<label for='affiliation-organization-$i'>Organization Name</label>";
									$html[] = "</div>";
									
									$html[] = "<div class='row'>";
										$html[] = "<div class='col-lg-6 col-md-12 col-sm-12'>";
											$html[] = "<div class='form-floating mb-3 w-100'>";
												$html[] = "<input type='text' name='affiliation[$i][title]' id='affiliation-title-$i' class='form-control' value='".$data['profile']['affiliation'][$i]['title']."' />";
												$html[] = "<label for='affiliation-title-$i'>Title</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-lg-6 col-md-12 col-sm-12'>";
											$html[] = "<div class='d-flex gap-3 justify-content-between'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='affiliation[$i][date][from]' id='affiliation-date-$i' class='form-control' style='width:130px;' value='".$data['profile']['affiliation'][$i]['date']['from']."' />";
													$html[] = "<label for='affiliation-date-$i'>From</label>";
												$html[] = "</div>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='affiliation[$i][date][to]' id='affiliation-date-$i' class='form-control' style='width:130px;' value='".$data['profile']['affiliation'][$i]['date']['to']."' />";
													$html[] = "<label for='affiliation-date-$i'>To</label>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
									$html[] = "<div class='form-floating mb-3'>";
										$html[] = "<textarea name='affiliation[$i][description]' id='affiliation-description-$i' class='form-control' style='height:150px; width:100%'>".$data['profile']['affiliation'][$i]['description']."</textarea>";
										$html[] = "<label for='affiliation-description-$i'>Summary of your professional role and responsibilities</label>";
									$html[] = "</div>";

									$html[] = "<p class='fs-12 text-end'>";
										$html[] = "<span class='btn btn-sm btn-secondary btn-remove' data-container='.affiliation-container-$i'><i class='ti ti-trash fs-14 me-1'></i> remove</span>";
									$html[] = "</p>";
								$html[] = "</div>";
							}
						$html[] = "</div>";
						$html[] = "<input type='hidden' id='affiliation-fields-count' value='$i' />";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<div class='col-sm-12 col-lg-6 col-md-12'>";
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title'>Education</h3>";
							$html[] = "<div class='card-actions'>";
								$html[] = "<span class='btn btn-primary btn-more' data-container='education'>add more</span>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-body education-container'>";

							$count = count($data['profile']['education']) > 0 ? count($data['profile']['education']) : 1;
							for($i=0; $i<$count; $i++) {
								$html[] = "<div class='".($i==0 ? "" : "mb-4 border-bottom")." education-container-$i'>";
									$html[] = "<div class='form-floating mb-3 w-100'>";
										$html[] = "<input type='text' name='education[$i][school]' id='education-school-$i' class='form-control' value='".$data['profile']['education'][$i]['school']."' />";
										$html[] = "<label for='education-school-$i'>School Name</label>";
									$html[] = "</div>";

									$html[] = "<div class='row'>";
										$html[] = "<div class='col-lg-6 col-md-12 col-sm-12'>";
											$html[] = "<div class='form-floating mb-3 w-100'>";
												$html[] = "<input type='text' name='education[$i][degree]' id='education-degree-$i' class='form-control' value='".$data['profile']['education'][$i]['degree']."' />";
												$html[] = "<label for='education-degree-$i'>Degree</label>";
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='col-lg-6 col-md-12 col-sm-12'>";
											$html[] = "<div class='d-flex gap-3 justify-content-between'>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='education[$i][date][from]' id='education-date-$i' class='form-control' style='width:130px;' value='".$data['profile']['education'][$i]['date']['from']."' />";
													$html[] = "<label for='education-date-$i'>From</label>";
												$html[] = "</div>";
												$html[] = "<div class='form-floating mb-3'>";
													$html[] = "<input type='date' name='education[$i][date][to]' id='education-date-$i' class='form-control' style='width:130px;' value='".$data['profile']['education'][$i]['date']['to']."' />";
													$html[] = "<label for='education-date-$i'>To</label>";
												$html[] = "</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";

									$html[] = "<p class='fs-12 text-end'>";
										$html[] = "<span class='btn btn-sm btn-secondary btn-remove' data-container='.education-container-$i'><i class='ti ti-trash fs-14 me-1'></i> remove</span>";
									$html[] = "</p>";

								$html[] = "</div>";
							}
						$html[] = "</div>";

						$html[] = "<input type='hidden' id='education-fields-count' value='$i' />";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";

			$html[] = "<div class='mt-5 pt-5'></div>";
					
		$html[] = "</form>";
		
	$html[] = "</div>";
$html[] = "</div>";
/** END PAGE */


$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row g-0 justify-content-center'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='d-flex justify-content-between'>";
					$html[] = "<span class='btn btn-outline-primary btn-view-profile' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("AccountsController@profilePreview", ["id" => $data['account_id']])."'><i class='ti ti-list me-2'></i> Preview Profile</span>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Profile</span>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
