<?php

$html[] = "<div class='overflow-y-auto'>";

	$html[] = "<div class='p-2' style='position: absolute; top:0; left:0; z-index:9999;' >";
			$html[] = "<button type='button' class='btn-close fs-14 text-white' data-bs-dismiss='offcanvas'></button> ";
		$html[] = "</div>";

	$html[] = "<div class='card mb-3 border-0'>";
	
		$html[] = "<div class='img-responsive img-responsive-21x9 bg-blue'></div>";
		$html[] = "<div class='card-img-top card-stamp'>";
			$html[] = "<div class='card-stamp-icon bg-white text-primary'>";
				$html[] = "<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z'></path></svg>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='card-body'  style='margin-top: -130px;'>";

			if($data['logo'] != "") { $logo = $data['logo'];
			}else { $logo = CDN."images/blank-profile.png"; }

			$html[] = "<div class='d-flex justify-content-between align-items-center'>";
				$html[] = "<span class='avatar avatar-xxl mb-1 mb-3 rounded-circle' style='border:3px solid #fff; background-image: url(".$logo.")'></span>";
				$html[] = "<div class=''>";
					$html[] = "<div class='mt-4 pt-3'></div>";
					$html[] = "<div class='mt-5 pt-5'></div>";
					/* $html[] = "<span class='btn btn-primary'><i class='ti ti-mail me-1'></i> Send Message</span>"; */
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<h3 class='card-title m-0'>".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['middlename']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</h3>";
			$html[] = "<p class='fs-12'>PRC Real Estate License #".$data['real_estate_license_number']."<br/>".$data['local_board_name']."</p>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Certificates</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['certification'])) {
					for($i=0; $i<count($data['profile']['certification']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['certification'][$i]."</li>";
					}
				}
			$html[] = "</ul>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Social Media Profiles</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['socials'])) {
					for($i=0; $i<count($data['profile']['socials']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>- <a href='https://".$data['profile']['socials'][$i]."' target='_blank'>".$data['profile']['socials'][$i]."</a></li>";
					}
				}
			$html[] = "</ul>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>About</h3>";
			$html[] = "<p class='px-2 py-2 border-3 border-0 border-start border-azure'>".$data['profile']['about_me']."</p>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Areas of Expertise</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['areas'])) {
					for($i=0; $i<count($data['profile']['areas']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['areas'][$i]."</li>";
					}
				}
			$html[] = "</ul>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Services Offered</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['services'])) {
					for($i=0; $i<count($data['profile']['services']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['services'][$i]."</li>";
					}
				}
			$html[] = "</ul>";
			
			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Skills</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['skills'])) {
					for($i=0; $i<count($data['profile']['skills']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>- ".$data['profile']['skills'][$i]."</li>";
					}
				}
			$html[] = "</ul>";

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
								$html[] = "<p class='m-0'>".$data['profile']['affiliation'][$i]['description']."</p>";
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

$html[] = "</div>";