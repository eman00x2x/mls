<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0'>";
	$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12 m-auto '>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<h1 class='page-title'><span class='stamp stamp-md me-1'><i class='ti ti-users me-2'></i></span> User Info</h1>";
					$html[] = "</div>";
					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='btn-list text-end'>";
							
							if($_SESSION['user_logged']['permissions']['users']['access']) {
								$html[] = "<a class='ajax btn btn-dark' href='".url("UsersController@edit",["id" => $data['account_id'], "user_id" => $data['user_id']])."' ><i class='ti ti-edit me-2'></i> Update User</a>";
							}

							if($data['user_level'] != 1 && $_SESSION['user_logged']['permissions']['users']['delete']) {
								$html[] = "<span class='btn btn-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("UsersController@delete",["id" => $data['user_id']])."'><i class='ti ti-trash me-2'></i> Delete User</span>";
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
						$html[] = "<h3 class='card-title text-blue'><i class='ti ti-user me-2'></i> User Details</h3>";
					$html[] = "</div>";
					
					$html[] = "<div class='card-body'>";

						$fields = array("name","email");
							
						foreach($fields as $field) {
							$html[] = "<div class=''>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-3'>";
										$html[] = "<label class='text-muted form-label mt-2 text-end'>".ucwords($field)."</label>";
									$html[] = "</div>";
									$html[] = "<div class='col-9'>";
										$html[] = "<input type='".($field == "password" ? "password" : ($field == "email" ? "email" : "text"))."' value='".$data[$field]."' class='form-control-plaintext' readonly autocomplete='off' />";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						}

						$html[] = "<div class=''>";
							$html[] = "<div class='row'>";
								$html[] = "<div class='col-3'>";
									$html[] = "<label class='text-muted form-label mt-2 text-end'>Date Registered</label>";
								$html[] = "</div>";
								$html[] = "<div class='col-9'>";
									$html[] = "<input type='text' value='".date("F d, Y g:ia",$data['date_added'])."' class='form-control-plaintext' readonly autocomplete='off' />";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
						
					$html[] = "</div>";
					
				$html[] = "</div>";

				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-header'>";
						$html[] = "<h3 class='card-title text-blue'><i class='ti ti-settings me-2'></i> User Permissions</h3>";
					$html[] = "</div>";
					
					$html[] = "<div class='card-body'>";

						if($data['account_type'] == "Administrator") {
							$permissions = ADMIN_PERMISSIONS;
						}else if($data['account_type'] == "Customer Service") {
							$permissions = CS_PERMISSIONS;
						}else if($data['account_type'] == "Web Admin") {
							$permissions = WEBADMIN_PERMISSIONS;
						}else {
							$permissions = USER_PERMISSIONS;
						}
						
						$html[] = "<ul class='list-group list-group-flush'>";
						foreach($permissions as $app => $arr) {
							$html[] = "<li class='list-group-item'>";
							$html[] = "<h3>".ucwords(str_replace("_"," ",$app))."</h3>";
							foreach($arr as $access => $val) {
								$html[] = "<div class=''>";

									if($data['account_type'] == "Real Estate Practitioner") {
										$html[] = "<label class='form-label'>";
											if((isset($data['permissions'][$app][$access]) && $data['permissions'][$app][$access] == "true")) {
												$html[] = "<i class='ti ti-check me-1 text-success'></i>";
												$html[] = (isset(DEFINITION[$app][$access]) ? str_replace("Allow this user","This user is allowed", DEFINITION[$app][$access]) : $access);
											}else {
												$html[] = "<i class='ti ti-ban me-1 text-danger'></i>"; 
												$html[] = (isset(DEFINITION[$app][$access]) ? str_replace("Allow this user","This user is not allowed", DEFINITION[$app][$access]) : $access);
											}	
										$html[] = "</label>";
									}else {
										$html[] = "<label class='form-label'>";
										if(isset($data['permissions'][$app][$access]) && $data['permissions'][$app][$access] == "true") {
											$html[] = "<i class='ti ti-check me-1 text-success'></i> ";
											$html[] = "".(isset(DEFINITION['ADMIN'][$app][$access]) ? str_replace("Allow this user","This user is allowed",DEFINITION['ADMIN'][$app][$access]) : $access)."";
										}else {
											$html[] = "<i class='ti ti-ban me-1 text-danger'></i> ";
											$html[] = "".(isset(DEFINITION['ADMIN'][$app][$access]) ? str_replace("Allow this user","This user is not allowed",DEFINITION['ADMIN'][$app][$access]) : $access)."";
										}
										$html[] = "</label>";
									}

								$html[] = "</div>";
							}
							$html[] = "</li>";
						}
						$html[] = "</ul>";

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";