<?php

$html[] = "<input type='hidden' id='save_url' value='".url("AccountsController@saveUpdate",["id" => $_SESSION['account_id']])."' />";

if(isset($_SESSION['permissions']['account']['access'])) {
	$html[] = "<input type='hidden' id='photo_uploader' value='accounts' />";
	$html[] = "<form action='".url("AccountsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
		$html[] = "<center>";
			$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
		$html[] = "</center>";
	$html[] = "</form>";
}

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'>Manage Your Account</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> My Account</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					
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

        $html[] = "<form id='form' action='' method='POST'>";
            $html[] = "<div class='row'>";
                $html[] = "<div class='col-md-12 col-12 mb-5'>";

                    $html[] = "<div class='card'>";
                        $html[] = "<div class='card-body py-5'>";

                            $html[] = "<div class='row g-5'>";
                                $html[] = "<div class='col-lg-3 col-md-3 col-12'>";

                                    $html[] = "<div class='list-group list-group-flush'>";
                                        $html[] = "<a class='list-group-item list-group-item-action' href='".url("AccountsController@index")."'><i class='ti ti-user-circle me-2'></i> My Account</a>";
										
										if(isset($_SESSION['permissions']['users']['access'])) {
											$html[] = "<a class='list-group-item list-group-item-action' href='".url("UsersController@index", [ "id" => $_SESSION['account_id'] ])."'><i class='ti ti-users me-2'></i> Manage Users</a>";
										}

                                        $html[] = "<a class='list-group-item list-group-item-action' href='".url("UsersController@changePassword",["id" => $_SESSION['user_id']])."'><i class='ti ti-key me-2'></i> Change Password</a>";
                                    $html[] = "</div>";
                                
                                $html[] = "</div>";

                                $html[] = "<div class='col-lg-9 col-md-9 col-12'>";

                                    $html[] = "<div class='text-center bg-white mb-3' style='width:200px;'>";
                                        $html[] = "<input type='hidden' name='logo' class='photo' id='logo' class='form-control' value='".$data['logo']."' />";
                                        $html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".$data['logo'].")'></span>";
                                        $html[] = "<small>Click to Upload Logo / Photo</small>";
										$html[] = "<span class='photo-upload-loader d-block'></span>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-3 pb-3 border-bottom'>";
                                        $html[] = "<h2 class='text-blue mb-1 fw-bold'>Account Holder</h6>";

                                        $html[] = "<div class='row g-3 align-items-center mb-3'>";
											$html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Profession</label></div>";
											$html[] = "<div class='col-md-9 col-6'>";
												$html[] = "<input type='text' name='profession' id='profession' value='".$data['profession']."' class='form-control-plaintext' />";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='row g-3 align-items-center mb-3'>";
											$html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>PRC License Number</label></div>";
											$html[] = "<div class='col-md-9 col-6'>";
												$html[] = "<input type='text' name='real_estate_license_number' id='real_estate_license_number' value='".$data['real_estate_license_number']."' class='form-control' />";
											$html[] = "</div>";
										$html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center mb-3'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Name</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>";
                                                $html[] = "<div class='row gy-2 gx-3 align-items-center'>";
                                                    $html[] = "<div class='col-auto'>";
                                                        $html[] = "<label class='form-label text-muted'>First Name</label>";
                                                        $html[] = "<input type='text' name='firstname' id='firstname' value='".$data['firstname']."' class='me-2 form-control' placeholder='First name' />";
                                                    $html[] = "</div>";
                                                    $html[] = "<div class='col-auto'>";
                                                        $html[] = "<label class='form-label text-muted'>Last Name</label>";
                                                        $html[] = "<input type='text' name='lastname' id='lastname' value='".$data['lastname']."' class='me-2 form-control' placeholder='Last name' />";
                                                    $html[] = "</div>";
                                                $html[] = "</div>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center mb-3'>";
											$html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Birth Date</label></div>";
											$html[] = "<div class='col-md-9 col-6'>";
												$html[] = "<input type='date' name='birthdate' id='birthdate' value='".$data['birthdate']."' class='form-control' />";
											$html[] = "</div>";
										$html[] = "</div>";

										$html[] = "<div class='row g-3 align-items-center mb-3'>";
											$html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Mobile Number</label></div>";
											$html[] = "<div class='col-md-9 col-6'>";
												$html[] = "<input type='text' name='mobile_number' id='mobile_number' value='".$data['mobile_number']."' class='form-control' />";
											$html[] = "</div>";
										$html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center mb-3 '>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Address</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>";
                                                $html[] = "<div class='row gy-2 gx-3 align-items-center'>";
                                                    $html[] = "<div class='col-auto'>";
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
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-3 pb-3 border-bottom'>";
                                        $html[] = "<h2 class='text-blue mb-1 fw-bold'>Company Details</h6>";
                                        $html[] = "<div class='row g-3 align-items-center mb-3'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Company Name</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>";
                                                $html[] = "<input type='text' name='company_name' id='company_name' value='".$data['company_name']."' class='form-control' />";
                                            $html[] = "</div>";
                                        $html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center mb-3'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>TIN</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>";
                                                $html[] = "<input type='text' name='tin' id='tin' value='".$data['tin']."' class='form-control' />";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-3 pb-3 border-bottom'>";
                                        $html[] = "<h2 class='text-blue mb-1 fw-bold'>Account Details</h6>";

                                        $html[] = "<div class='row g-3 align-items-center'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Broker License Number</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>".$data['broker_prc_license_id']."</div>";
                                        $html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Email</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'>".$data['email']."</div>";
                                        $html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Status</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'><span>".ucwords($data['status'])."</span></div>";
                                        $html[] = "</div>";

                                        $html[] = "<div class='row g-3 align-items-center'>";
                                            $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>Registration Date</label></div>";
                                            $html[] = "<div class='col-md-9 col-6'><span>".date("F d, Y",$data['registration_date'])."</span></div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='mb-3 pb-3 border-bottom'>";
                                        $html[] = "<h2 class='text-blue mb-1 fw-bold'>Account Privileges</h6>";

                                        foreach($data['privileges'] as $privilege => $val) {
                                            $html[] = "<div class='row g-3 align-items-center'>";
                                                $html[] = "<div class='col-md-3 col-6'><label class='col-form-label'>".ucwords(str_replace("_"," ",$privilege))."</label></div>";
                                                $html[] = "<div class='col-md-9 col-6'><span>".$val."</span></div>";
                                            $html[] = "</div>";
                                        }
                                    $html[] = "</div>";

                                $html[] = "</div>";
                            $html[] = "</div>";


                        $html[] = "</div>";
                    $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</form>";

	$html[] = "</div>";
$html[] = "</div>";


$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-12 col-md-12 col-sm-12 col-12'>";
			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					if((!isset($_SESSION['permissions']['account']['access']))) {
						$html[] = "<p class='text-info'>Permission is required to update account details</p>";
					}else {
						$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Account Details</span>";
					}
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";
