<?php

$html[] = "<div class='bg-blue' style='height:150px;'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row justify-content-end'>";
			$html[] = "<div class='col-lg-4 col-md-6'>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-8 col-md-6'>";
				$html[] = "<div class='pt-3 d-none d-md-block '>";
					
					/*** ADS CONTAINER */
					$html[] = "<div class='d-none px-2 PROFILE_TOP'>";
						$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
							$html[] = "<div class='card bg-dark-lt mt-2 mx-auto rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:120px; width:700px;'>";
								$html[] = "<div class='loader'></div>";
								$html[] = "<p>Loading Ads</p>";
							$html[] = "</div>";
						$html[] = "</a>";
					$html[] = "</div>";
					/*** END ADS CONTAINER */

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body mt-0 bg-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class=''>";
			$html[] = "<div class='row justify-content-between'>";
				$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

					/** START PROFILE */
					$html[] = "<div class='card mb-3 border-0'>";
						$html[] = "<div class='card-body' style='margin-top: -130px;'>";

							if($data['logo'] != "") { $logo = $data['logo'];
							}else { $logo = CDN."images/blank-profile.png"; }

							$html[] = "<div class='d-flex justify-content-between align-items-center'>";
								$html[] = "<span class='avatar avatar-xxl mb-1 mb-3 rounded-circle' style='border:3px solid #fff; background-image: url(".$logo.")'></span>";
								$html[] = "<div class=''>";
									$html[] = "<div class='mt-4 pt-3'></div>";
									$html[] = "<div class='mt-5 pt-5'></div>";
									
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row justify-content-center'>";
								$html[] = "<div class='col-md-4 col-lg-4 col-sm-12'>";
									$html[] = "<div class='mb-3'>";
										$html[] = "<h3 class='card-title m-0'>".($data['account_name']['nickname'] ?? $data['account_name']['firstname'])." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</h3>";
										$html[] = "<p class='fs-12'>";
											$html[] = ($data['account_name']['titles'] ?? $data['profession']);
											$html[] = "<br/> PRC Real Estate Broker License #".$data['real_estate_license_number']."<br/>".$data['local_board_name']."";
										$html[] = "</p>";

										$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
											$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
												$html[] = "<li class='list-group-item p-0 pb-1 m-0 border-0'>Viber: <a href='viber://chat/?number=".$data['mobile_number']."'>Viber Me</a></li>";
												$html[] = "<li class='list-group-item p-0 pb-1 m-0 border-0'><i class='ti ti-mail fs-14 me-1'></i><a href='mailto:".$data['email']."'>Send me an email</a></li>";
											$html[] = "</ul>";
										$html[] = "</div>";

									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='col-md-4 col-lg-4 col-sm-12'>";
									$html[] = "<div class='mb-3 text-center'>";
										$html[] = "<a href='".url("AccountsController@accountListings", ["id" => $data['account_id'], "name" => sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname'])])."' class='btn btn-primary'>View my Property Listings</a>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='col-md-4 col-lg-4 col-sm-12'>";
									$html[] = "<div class='mb-3 float-lg-end'>";
										$html[] = $data['social_media_buttons'];
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";

							if(isset($data['broker']) && !empty($data['broker'])) {
								$html[] = "<h3 class='card-title mb-1 text-muted'>Real Estate Broker</h3>";
								$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
									$html[] = "<p>".($data['broker']['account_name']['nickname'] ?? $data['broker']['account_name']['firstname'])." ".$data['broker']['account_name']['lastname']." ".$data['broker']['account_name']['suffix']."
									<br/>PRC Real Estate Broker License #".$data['broker']['real_estate_license_number']."</p>";
								$html[] = "</div>";
							}

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Certificates</h3>";
							$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
								$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
									if(!empty($data['profile']['certification'])) {
										for($i=0; $i<count($data['profile']['certification']); $i++) {
											$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['certification'][$i]."</li>";
										}
									}
								$html[] = "</ul>";
							$html[] = "</div>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>About</h3>";
							$html[] = "<p class='px-2 py-2 border-3 border-0 border-start border-azure'>".$data['profile']['about_me']."</p>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Areas of Expertise</h3>";
							$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
								$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
									if(!empty($data['profile']['areas'])) {
										for($i=0; $i<count($data['profile']['areas']); $i++) {
											$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['areas'][$i]."</li>";
										}
									}
								$html[] = "</ul>";
							$html[] = "</div>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Services Offered</h3>";
							$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
								$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
									if(!empty($data['profile']['services'])) {
										for($i=0; $i<count($data['profile']['services']); $i++) {
											$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['services'][$i]."</li>";
										}
									}
								$html[] = "</ul>";
							$html[] = "</div>";

							if(!empty($data['profile']['skills']) && is_array($data['profile']['skills'])) {

								if($data['profile']['skills'][0] != "") {
									$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Skills</h3>";

									$html[] = "<div class='border-3 border-0 border-start border-azure ps-2'>";
										$html[] = "<ul class='list-group list-group-flush'>";
										for($i=0; $i<count($data['profile']['skills']); $i++) {
											$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['skills'][$i]."</li>";							
										}
										$html[] = "</ul>";
									$html[] = "</div>";
								}
								
							}
							
							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Affiliations</h3>";
							$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
								
								if(!empty($data['profile']['affiliation'])) {
									for($i=0; $i<count($data['profile']['affiliation']); $i++) {
										if($data['profile']['affiliation'][$i]['organization'] != "") {
											$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
												$html[] = "<div class='fw-bold'>".$data['profile']['affiliation'][$i]['organization']."</div>";
												$html[] = "<div class='d-flex justify-content-between mb-1 mt-2'>";
													$html[] = "<span class='fw-bold'>".$data['profile']['affiliation'][$i]['title']."</span>";
													$html[] = "<span class='text-muted fs-12'>Date ".date("d F Y", strtotime($data['profile']['affiliation'][$i]['date']['from']))."</span>";
												$html[] = "</div>";
												$html[] = "<p class='m-0' >".$data['profile']['affiliation'][$i]['description']."</p>";
											$html[] = "</li>";
										}
									}
								}

							$html[] = "</ul>";

							$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Education</h3>";
							$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
								if(!empty($data['profile']['education'])) {
									for($i=0; $i<count($data['profile']['education']); $i++) {
										if($data['profile']['education'][$i]['school'] != "") {
											$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
												$html[] = "<div class='d-flex gap-2 justify-content-start flex-wrap'>";
													$html[] = "<div class='flex-grow-1 fw-bold'>".$data['profile']['education'][$i]['school']."</div>";
													$html[] = "<div class='text-muted fs-12'>".date("d F Y", strtotime($data['profile']['education'][$i]['date']['from']))."</div>";
												$html[] = "</div>";
												$html[] = "<p class='m-0'>".$data['profile']['education'][$i]['degree']."</p>";
											$html[] = "</li>";
										}
									}
								}
							$html[] = "</ul>";

						$html[] = "</div>";
					$html[] = "</div>";
					/** END PROFILE */

				$html[] = "</div>";
				$html[] = "<div class='col-lg-3 col-md-4 col-sm-12 col-12'>";
						
					$html[] = "<div class='py-4 px-2'>";

						$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>My Links</h3>";
						$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
							if(!empty($data['profile']['socials'])) {
								for($i=0; $i<count($data['profile']['socials']); $i++) {
									$html[] = "<li class='list-group-item p-0 m-0 border-0'><a href='//".str_replace("https://", "", $data['profile']['socials'][$i])."' target='_blank'><i class='ti ti-link'></i> ".$data['profile']['socials'][$i]."</a></li>";
								}
							}
						$html[] = "</ul>";

						/*** ADS CONTAINER */
						$html[] = "<div class='d-none px-2 mt-4 PROFILE_SIDEBAR_TOP'>";
							$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
								$html[] = "<div class='card bg-dark-lt mt-2 mx-auto rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='width:300px; min-height:300px;'>";
									$html[] = "<div class='loader'></div>";
									$html[] = "<p>Loading Ads</p>";
								$html[] = "</div>";
							$html[] = "</a>";
						$html[] = "</div>";
						/*** END ADS CONTAINER */

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class=''>";
			if($data['testimonials']) {
				$html[] = "<h3>Testimonials</h3>";
				for($i=0; $i<count($data['testimonials']); $i++) {
					$html[] = "<figure>";
						$html[] = "<blockquote class='blockquote'>";
							$html[] = "<p class='mb-0'>".$data['testimonials'][$i]['content']."</p>";
						$html[] = "</blockquote>";
						$html[] = "<figcaption class='blockquote-footer'>";
							$html[] = "<span>".$data['testimonials'][$i]['name']."</span>";
						$html[] = "</figcaption>";
					$html[] = "</figure>";
				}
			}
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
