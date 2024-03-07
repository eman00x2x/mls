<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveUpdate",["id" => $data['account_id']])."' />";

$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> Update Account </h1>";
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

					if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
						$html[] = "<div class='card mb-3'>";
							$html[] = "<div class='card-status bg-orange'></div>";
							$html[] = "<div class='card-header'>";
								$html[] = "<h3 class='card-title text-blue mb-0'>Company Details</h3>";
							$html[] = "</div>";
							
							$html[] = "<div class='card-body'>";
								$html[] = "<div class='row'>";
									$html[] = "<div class='col-lg-3 col-md-3 col-12'>";
										$html[] = "<div class='text-center mb-3 '>";
											$html[] = "<input type='hidden' name='logo' class='photo' id='logo' class='form-control' value='".$data['logo']."' />";
											if($data['logo'] != "") {
												$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".$data['logo'].")'></span>";
											}else {
												$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".CDN."images/blank-profile.png)'></span>";
											}
											
											/* $html[] = "<div class='photo-preview mb-1 w-100 bg-white'></div>"; */
											$html[] = "<small>Click to Upload Logo / Photo</small>";
											$html[] = "<span class='photo-upload-loader d-block'></span>";
										$html[] = "</div>";
									$html[] = "</div>";
									$html[] = "<div class='col-lg-9 col-md-9 col-12'>";
										
										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='text-muted form-label'>Company Name</label>";
											$html[] = "<input type='text' name='company_name' id='company_name' value='".$data['company_name']."' class='form-control'  />";
										$html[] = "</div>";
										
										$html[] = "<div class='mb-3'>";
											$html[] = "<label class='text-muted form-label'>Personal or Company TIN</label>";
											$html[] = "<input type='text' name='tin' id='tin' value='".$data['tin']."' class='form-control'  />";
										$html[] = "</div>";

									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					}

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Account Details</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							
							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Account Type</label>";
								$html[] = "<div class='col-sm-9'>";
								
									if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
										$html[] = "<select name='account_type' id='account_type' class='form-select'>";
										foreach(array("Administrator","Customer Service","Real Estate Practitioner", "Banks") as $label) {
											$sel = $data['account_type'] == $label ? "selected" : "";
											$html[] = "<option value='$label' $sel>".ucwords($label)."</option>";
										}
										$html[] = "</select>";
									}else {
										$html[] = "<input type='text' value='".$data['account_type']."' class='form-control-plaintext'  />";
									}
									
								$html[] = "</div>";
							$html[] = "</div>";
							

							if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Broker License Number</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='text' name='broker_prc_license_id' id='broker_prc_license_id' value='".$data['broker_prc_license_id']."' class='form-control'  />";
									$html[] = "</div>";
								$html[] = "</div>";
							}

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Email Address</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='email' name='email' id='email' value='".$data['email']."' class='form-control-plaintext'  />";
								$html[] = "</div>";
							$html[] = "</div>";

							if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Status</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<select name='status' id='status' class='form-select'>";
										foreach(array("active","banned") as $label) {
											$sel = $data['status'] == $label ? "selected" : "";
											$html[] = "<option value='$label' $sel>".ucwords($label)."</option>";
										}
										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";
							}

						$html[] = "</div>";
					$html[] = "</div>";
				
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Account Holder</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Profession</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<select name='profession' class='form-select' id='profession'>";
											$professions = explode(",","Real Estate Consultant,Real Estate Appraiser,Real Estate Broker,Real Estate Salesperson");
											foreach ($professions as $profession) {
												$sel = $data['profession'] == $profession ? "selected" : "";
												$html[] = "<option value='".$profession."' $sel>$profession</option>";
											}
										$html[] = "</select>";
									$html[] = "</div>";
								$html[] = "</div>";

								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>PRC License Number</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='text' name='real_estate_license_number' id='real_estate_license_number' value='".$data['real_estate_license_number']."' class='form-control' />";
									$html[] = "</div>";
								$html[] = "</div>";
							}

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>First Name</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='firstname' id='firstname' value='".$data['firstname']."' class='form-control'  />";
								$html[] = "</div>";
							$html[] = "</div>";
							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Last Name</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='lastname' id='lastname' value='".$data['lastname']."' class='form-control'  />";
								$html[] = "</div>";
							$html[] = "</div>";

							if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Birth Date</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='date' name='birthdate' id='birthdate' value='".$data['birthdate']."' class='form-control'  />";
									$html[] = "</div>";
								$html[] = "</div>";
							

								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Mobile Number</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<input type='text' name='mobile_number' id='mobile_number' value='".$data['mobile_number']."' class='form-control' autocomplete='off'  />";
									$html[] = "</div>";
								$html[] = "</div>";
							
								$html[] = "<div class='row mb-3'>";
									$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Address</label>";
									$html[] = "<div class='col-sm-9'>";
										$html[] = "<div class='row gy-2 gx-3 align-items-center'>";
											$html[] = "<div class='col-12'>";
												$html[] = "<label class='form-label text-muted'>Street</label>";
												$html[] = "<input type='text' name='street' id='street' value='".$data['street']."' class='form-control'  />";
											$html[] = "</div>";
										
											$html[] = "<div class='col-auto'>";
												$html[] = "<label class='form-label text-muted'>City</label>";
												$html[] = "<input type='text' name='city' id='city' value='".$data['city']."' class='form-control'  />";
											$html[] = "</div>";
										
											$html[] = "<div class='col-auto'>";
												$html[] = "<label class='form-label text-muted'>Province</label>";
												$html[] = "<input type='text' name='province' id='province' value='".$data['province']."' class='form-control'  />";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							}

						$html[] = "</div>";
					$html[] = "</div>";

					if(!in_array($data['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
						$html[] = "<div class='card mb-3'>";
							$html[] = "<div class='card-header'>";
								$html[] = "<h3 class='card-title text-blue mb-0'>Privileges</h3>";
							$html[] = "</div>";
							
							$html[] = "<div class='card-body'>";
								foreach(ACCOUNT_PRIVILEGES as $privilege => $val) {
									$html[] = "<div class='row mb-3'>";
										$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>".ucwords(str_replace("_"," ",$privilege))."</label>";
										if(in_array($privilege, ["leads_DB","properties_DB"])) {
											$html[] = "<div class='col-sm-9'>";
												$html[] = "<div class='form-check form-switch'>";
													$html[] = "<input class='form-check-input' type='checkbox' name='privileges[$privilege]' value='true' id='flexSwitchCheckDefault_".$privilege."' ".(isset($data['privileges'][$privilege]) && $data['privileges'][$privilege] == "true" ? "checked" : "").">";
													$html[] = "<label class='form-check-label' for='flexSwitchCheckDefault_".$privilege."'>".DEFINITION[$privilege]."</label>";
												$html[] = "</div>";
											$html[] = "</div>";
										}else {
											$html[] = "<div class='col-sm-9'>";
												$html[] = "<span class='mb-1 d-block text-muted small'>".DEFINITION[$privilege]."</span>";
												$html[] = "<input type='text' name='privileges[$privilege]' id='privileges[$privilege]' value='".$data['privileges'][$privilege]."' class='form-control'  />";
											$html[] = "</div>";
										}
									$html[] = "</div>";
								}
							$html[] = "</div>";
						$html[] = "</div>";
					}

				$html[] = "</form>";
				
			$html[] = "</div>";
		$html[] = "</div>";
		/** END PAGE */

	$html[] = "</div>";
$html[] = "</div>";


$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-6 col-md-6 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Account</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";