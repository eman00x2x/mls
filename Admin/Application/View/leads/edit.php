<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";

    $html[] = "<input type='hidden' id='save_url' value='".url("LeadsController@saveUpdate", ["id" => $data['lead_id']])."' />";

    $html[] = "<div class='row justify-content-center mb-5 pb-5'>";
        $html[] = "<div class='col-md-6 col-12'>";

            $html[] = "<div class='page-header d-print-none text-white'>";
                
                    $html[] = "<div class='row g-2 '>";
                        $html[] = "<div class='col'>";
                            $html[] = "<div class='page-pretitle'>Inquiries from website</div>";
                            $html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> Leads</h1>";
                        $html[] = "</div>";

                        $html[] = "<div class='col-auto ms-auto d-print-none'>";
                            $html[] = "<div class='d-none d-sm-inline'>";
                                $html[] = "<div class='btn-list'>";
                                    
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";

            $html[] = "</div>";

            $html[] = "<div class='page-body'>";
                
                    $html[] = "<form id='form' action='' method='POST'>";
                        $html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
                        $html[] = "<input name='lead_group_id' id='lead_group_id' type='hidden' value='".$data['lead_group_id']."' />";
                        $html[] = "<input name='content' id='content' type='hidden' value='' />";
                        $html[] = "<input name='iv' id='iv' type='hidden' value='' />";
                        $html[] = "<input name='message' id='message' type='hidden' value='' />";

                        $html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
                        
                        $html[] = "<div class='card mb-3'>";
                            $html[] = "<div class='card-header'>";
                                $html[] = "<h3 class='card-title text-blue mb-0'>Update Lead Information</h3>";
                            $html[] = "</div>";

                            $html[] = "<div class='card-body'>";

                                $html[] = "<div class='row mb-2'>";
                                    $html[] = "<label class='text-muted col-sm-3 col-form-label'>Group</label>";
                                    $html[] = "<div class='col-sm-9'>";
                                        $html[] = "<p class='btn-group-selection border rounded p-2 cursor-pointer btn-delete' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("LeadGroupsController@groupSelection")."'>".$data['groups']['name']."</p>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='row mb-3'>";
                                    $html[] = "<label class='text-muted col-sm-3 col-form-label'>Name</label>";
                                    $html[] = "<div class='col-sm-9'>";
                                        $html[] = "<input type='text' name='name' id='name' value='' class='form-control' placeholder='decrypting...' />";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='row mb-3'>";
                                    $html[] = "<label class='text-muted col-sm-3 col-form-label'>Mobile Number</label>";
                                    $html[] = "<div class='col-sm-9'>";
                                        $html[] = "<input type='text' name='mobile_no' id='mobile_no' value='' class='form-control' placeholder='decrypting...' />";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='row mb-3'>";
                                    $html[] = "<label class='text-muted col-sm-3 col-form-label'>Email Address</label>";
                                    $html[] = "<div class='col-sm-9'>";
                                        $html[] = "<input type='email' name='email' id='email' value='' class='form-control' placeholder='decrypting...' />";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                            
                        $html[] = "</div>";

                        $html[] = "<div class='card mb-3'>";
                            $html[] = "<div class='card-header'>";
                                $html[] = "<h3 class='card-title text-blue mb-0'>Lead Preferences</h3>";
                            $html[] = "</div>";

                            $html[] = "<div class='card-body'>";
                                
                            $html[] = "<div class='row'>";
                                    $html[] = "<div class='col-md-6 col-lg-6 col-12'>";
                                        $html[] = "<div class='form-group mb-3'>";
                                            $html[] = "<label class='form-label text-muted'>Property Type</label>";
                                            $html[] = "<div class='input-icon mb-3'>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-building-estate'></i></span>";
                                                $html[] = "<select class='form-control' name='preferences[type]' id='type'>";
                                                    $offer_type = array("Residential","Commercial");
                                                    foreach($offer_type as $key => $val) {
                                                        $sel = $val == $data['preferences']['type'] ? "selected" : "";
                                                        $html[] = "<option value='".$val."' $sel>$val</option>";
                                                    }
                                                $html[] = "</select>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-md-6 col-lg-6 col-12'>";
                                        $html[] = "<div class='form-group mb-3'>";
                                            $html[] = "<label class='form-label text-muted'>Category</label>";
                                            $html[] = "<div class='input-icon mb-3'>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-building-store'></i></span>";
                                                $html[] = $data['categorySelection'];
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='row'>";
                                    $html[] = "<div class='col-md-4 col-lg-4 col-12'>";
                                        $html[] = "<div class='form-group mb-3'>";
                                            $html[] = "<label class='form-label text-muted'>Bedroom</label>";
                                            $html[] = "<div class='input-icon mb-3'>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-bed-flat'></i></span>";
                                                $html[] = "<select class='form-select' name='preferences[bedroom]' id='bedroom'>";
                                                    $sel = "Studio" == $data['preferences']['bedroom'] ? "selected" : "";
                                                    $html[] = "<option value='Studio' $sel>Studio</option>";
                                                    for($i=1; $i<11; $i++) {
                                                        $sel = $i == $data['preferences']['bedroom'] ? "selected" : "";
                                                        $html[] = "<option value='$i' $sel>$i Bedroom</option>";
                                                    }
                                                $html[] = "</select>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-md-4 col-lg-4 col-12'>";
                                        $html[] = "<div class='form-group mb-3'>";
                                            $html[] = "<label class='form-label text-muted'>Bathroom</label>";
                                            $html[] = "<div class='input-icon mb-3'>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-bath'></i></span>";
                                                $html[] = "<select class='form-select' name='preferences[bathroom]' id='bathroom'>";
                                                    for($i=0; $i<11; $i++) {
                                                        $sel = $i == $data['preferences']['bathroom'] ? "selected" : "";
                                                        $html[] = "<option value='$i' $sel>".($i == 0 ? "No" : $i)." Bathroom</option>";
                                                    }
                                                $html[] = "</select>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-md-4 col-lg-4 col-12'>";
                                        $html[] = "<div class='form-group mb-3'>";
                                            $html[] = "<label class='form-label text-muted'>Car Garage</label>";
                                            $html[] = "<div class='input-icon mb-3'>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-car-garage'></i></span>";
                                                $html[] = "<select class='form-select' name='preferences[parking]' id='parking'>";
                                                    for($i=0; $i<11; $i++) {
                                                        $sel = $i == $data['preferences']['parking'] ? "selected" : "";
                                                        $html[] = "<option value='$i' $sel>".($i == 0 ? "No Garage" : $i." car slot")."</option>";
                                                    }
                                                $html[] = "</select>";
                                                $html[] = "<span class='input-icon-addon'><i class='ti ti-caret-down-filled'></i></span>";
                                            $html[] = "</div>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='col-md-6 col-lg-6 col-12'>";
                                    $html[] = "<div class='mb-3'>";
                                        $html[] = "<label class='form-label text-muted'>Lot Area</label>";
                                        $html[] = "<div class='input-icon mb-3'>";
                                            $html[] = "<input type='text' name='preferences[lot_area]' id='lot_area' value='".$data['preferences']['lot_area']."' class='form-control' placeholder='Lot area' />";
                                            $html[] = "<span class='input-icon-addon'><small>sq.m <i class='ti ti-ruler me-1'></i></small></span>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                $html[] = "</div>";

                                $html[] = "<div class='form-group mb-3'>";
                                    $html[] = "<label class='form-label text-muted'>Address</label>";
                                    $html[] = $data['addresses']->addressSelection($data['preferences']['address']);
                                $html[] = "</div>";

                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</form>";

            $html[] = "</div>";

        $html[] = "</div>";
    $html[] = "</div>";

    $html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
        $html[] = "<div class='row g-0 justify-content-center'>";
            $html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

                $html[] = "<div class='text-end'>";
                    $html[] = "<span class='btn btn-outline-primary btn-save-lead'><i class='ti ti-device-floppy me-2'></i> Save Lead Information</span>";
                    $html[] = "<span class='btn-save d-none'></span>";
                $html[] = "</div>";
                
            $html[] = "</div>";
        $html[] = "</div>";
    $html[] = "</div>";

$html[] = "</div>";