<?php

$html[] = "<div class='overflow-y-auto'>";

	$html[] = "<div class='card mb-3 border-0'>";
		$html[] = "<div class='card-body'>";

			$html[] = "<div class='bg-white'>";
				if($data['logo'] != "") {$html[] = "<span class='avatar avatar-xxl mb-1 mb-3 rounded-circle border-white' style='background-image: url(".$data['logo'].")'></span>";
				}else {$html[] = "<span class='avatar avatar-xxl mb-1 mb-3 rounded-circle border-white' style='background-image: url(".CDN."images/blank-profile.png)'></span>"; }
			$html[] = "</div>";

			$html[] = "<h3 class='card-title m-0'>".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['middlename']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['certification'])) {
					for($i=0; $i<count($data['profile']['certification']); $i++) {
						$html[] = "<li class='list-group-item p-0 m-0 border-0'>".$data['profile']['certification'][$i]."</li>";
					}
				}
			$html[] = "</ul>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>About</h3>";
			$html[] = "<p class='px-2 py-2 border-3 border-0 border-start border-azure'>".$data['profile']['about_me']."</p>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Affiliations</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['affiliation'])) {
					for($i=0; $i<count($data['profile']['affiliation']); $i++) {
						$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
							$html[] = "<div class='fw-bold'>".$data['profile']['affiliation'][$i]['organization']."</div>";
							$html[] = "<div class='d-flex justify-content-between mb-1 mt-2'>";
								$html[] = "<span class='fw-bold'>".$data['profile']['affiliation'][$i]['title']."</span>";
								$html[] = "<span class='text-muted fs-12'>Date ".date("d F Y", strtotime($data['profile']['affiliation'][$i]['date']['from']))."</span>";
							$html[] = "</div>";
							$html[] = "<p class='m-0' style='text-align: justify;'>".$data['profile']['affiliation'][$i]['description']."</p>";
						$html[] = "</li>";
					}
				}
			$html[] = "</ul>";

			$html[] = "<h3 class='card-title mt-4 mb-1 text-muted'>Education</h3>";
			$html[] = "<ul class='list-group list-group-flush m-0 p-0'>";
				if(!empty($data['profile']['education'])) {
					for($i=0; $i<count($data['profile']['education']); $i++) {
						$html[] = "<li class='list-group-item ps-2 py-3 border-3 border-0 border-start border-azure'>";
							$html[] = "<div class='d-flex gap-2 justify-content-start flex-wrap'>";
								$html[] = "<div class='flex-grow-1 fw-bold'>".$data['profile']['education'][$i]['school']."</div>";
								$html[] = "<div class='text-muted fs-12'>".date("d F Y", strtotime($data['profile']['education'][$i]['date']['from']))."</div>";
							$html[] = "</div>";
							$html[] = "<p class='m-0'>".$data['profile']['education'][$i]['degree']."</p>";
						$html[] = "</li>";
					}
				}
			$html[] = "</ul>";

		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";