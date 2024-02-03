<?php

$html[] = "<input type='hidden' id='save_url' value='".url("UsersController@saveNew",["id" => $data['account_id']])."' />";

$html[] = "<form id='form' action='' method='POST'>";

	$html[] = "<input type='hidden' name='_method' id='_method' value='post' />";
	$html[] = "<input type='hidden' name='account_id' id='account_id' value='".$data['account_id']."' />";
	$html[] = "<input type='hidden' name='user_level' id='user_level' value='2' />";
	$html[] = "<input type='hidden' name='date_added' id='date_added' value='".DATE_NOW."' />";

	$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-12 m-auto '>";

			$html[] = "<div class='page-header d-print-none text-white'>";
				$html[] = "<div class='container-xl'>";
					$html[] = "<div class='row g-2 '>";
						$html[] = "<div class='col'>";
							$html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> New User Info</h1>";
						$html[] = "</div>";
						$html[] = "<div class='col-auto ms-auto d-print-none'>";
							$html[] = "<div class='btn-list text-end'>";
								if($data['account_type'] == "Administrator") {
									$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account_id']])."'>";
										$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
										$html[] = $data['firstname']." ".$data['lastname']." account";
									$html[] = "</a>";
								}
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
			
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-status bg-green'></div>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-user me-2'></i> User Info</h3>";
						$html[] = "</div>";
					
						$html[] = "<div class='card-body'>";

							$fields = array("name","email","password");
							
							foreach($fields as $field) {
								$html[] = "<div class='mb-3'>";
									$html[] = "<div class='row'>";
										$html[] = "<div class='col-3'>";
											$html[] = "<label class='text-muted form-label mt-2 text-end'>".ucwords($field)."</label>";
										$html[] = "</div>";
										$html[] = "<div class='col-9'>";
											$html[] = "<input type='".($field == "password" ? "password" : ($field == "email" ? "email" : "text"))."' name='$field' id='$field' value='' class='form-control' autocomplete='off' />";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
							
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue'><i class='ti ti-gear me-2'></i> User Permissions</h3>";
						$html[] = "</div>";
						
						$html[] = "<div class='card-body'>";
							
							$html[] = "<ul class='list-group list-group-flush'>";
							foreach(USER_PERMISSIONS as $app => $arr) {
								$html[] = "<li class='list-group-item'>";
								$html[] = "<h3>".ucwords(str_replace("_"," ",$app))." <span class='small text-muted d-block'></span></h3>";
								foreach($arr as $access => $val) {
									$html[] = "<div class='form-check form-switch'>";
										$html[] = "<input class='form-check-input' type='checkbox' name='permissions[$app][$access]' value='true' id='flexSwitchCheckDefault_".$app."_".$access."' ".(isset(USER_PERMISSIONS[$app][$access]) && USER_PERMISSIONS[$app][$access] == true ? "checked" : "").">";
										$html[] = "<label class='form-check-label' for='flexSwitchCheckDefault_".$app."_".$access."'>".(isset(DEFINITION[$app][$access]) ? DEFINITION[$app][$access] : $access)."</label>";
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
$html[] = "</form>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save User</span>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";