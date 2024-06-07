<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-header d-print-none text-white'>";
    $html[] = "<div class='container-xl'>";
        $html[] = "<div class='row g-2 '>";
            $html[] = "<div class='col'>";
                $html[] = "<div class='page-pretitle'>Inquiries from website</div>";
                $html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> Leads</h1>";
            $html[] = "</div>";
            $html[] = "<div class='col-auto ms-auto d-print-none'>";
                $html[] = "<div class=''>";
                    $html[] = "<div class='btn-list'>";
                        $html[] = "<a class='ajax btn btn-dark' href='".url("LeadsController@edit", ["id" => $data['lead_id']])."'><i class='ti ti-user-edit me-2'></i> Update Lead Information</a>";
                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";
    $html[] = "</div>";
$html[] = "</div>";



$html[] = "<div class='page-body'>";
    $html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
	        $html[] = "<div class='col-md-4 col-12'>";

                $html[] = "<div class='card mb-3'>";
                    $html[] = "<div class='card-header'>";
                        $html[] = "<h3 class='card-title text-blue mb-0'>Lead Information</h3>";
                    $html[] = "</div>";

                    $html[] = "<div class='card-body'>";
                        $html[] = "<table class='table'>";
                        $html[] = "<tr>";
                            $html[] = "<td class='pt-0 w-20'>Name</td>";
                            $html[] = "<td class='pt-0'><span class='name-container'><img src='".CDN."images/loader.gif' /> decrypting</span></td>";
                        $html[] = "</tr>";
                        $html[] = "<tr>";
                            $html[] = "<td>Mobile Number</td>";
                            $html[] = "<td><span class='mobile-number-container'><img src='".CDN."images/loader.gif' /> decrypting</span></td>";
                        $html[] = "</tr>";
                        $html[] = "<tr>";
                            $html[] = "<td>Email</td>";
                            $html[] = "<td><span class='email-container'><img src='".CDN."images/loader.gif' /> decrypting</span></td>";
                        $html[] = "</tr>";
                        $html[] = "<tr>";
                            $html[] = "<td>Message</td>";
                            $html[] = "<td><span class='message-container'><img src='".CDN."images/loader.gif' /> decrypting</span></td>";
                        $html[] = "</tr>";
                        $html[] = "<tr>";
                            $html[] = "<td>Inquire At</td>";
                            $html[] = "<td>".date("M d, Y g:ia",$data['inquire_at'])."</td>";
                        $html[] = "</tr>";
                        $html[] = "</table>";

                        if($data['listing']) {
                            $html[] = "<div class='listing_wrap my-5'>";

                                $html[] = "<h3>Subject Listing</h3>";
   
                                $html[] = "<div class='d-flex'>";
                                    $html[] = "<div class=''>";
                                        $html[] = "<span class='avatar avatar-xl' style='background-image: url(".$data['listing']['thumb_img'].")'></span>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='ps-2'>";
                                        $html[] = "<span class='d-block'>".$data['listing']['title']."</span>";
                                        $html[] = "<span class='d-block'>".$data['listing']['category']."</span>";
                                        $html[] = "<span class='d-block'>".$data['listing']['address']['municipality']." ".$data['listing']['address']['province']."</span>";
                                        $html[] = "<a href='".url("ListingsController@view",["id" => $data['listing']['listing_id']])."' class='btn btn-primary mt-2'>View Listing</a>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                                
                            $html[] = "</div>";
                        }
                    $html[] = "</div>";
                
                $html[] = "</div>";

                $html[] = "<div class='card mb-3'>";
                    $html[] = "<div class='card-header'>";
                        $html[] = "<h3 class='card-title text-blue mb-0'>Lead Preferences</h3>";
                    $html[] = "</div>";

                    $html[] = "<div class='card-body'>";
                        $html[] = "<div class='d-flex gap-2 align-items-center flex-wrap'>";
                        foreach($data['preferences'] as $key => $val) {
                            if(is_array($val)) {
                                foreach($val as $x => $v) {
                                    if($v != "") {
                                        $html[] = "<div class=''>";
                                            $html[] = "<label class='fs-11 text-muted'>".ucwords(str_replace("_"," ", $x))."</label>";
                                            $html[] = "<p>$v</p>";
                                        $html[] = "</div>";
                                    }
                                }
                            }else {
                                $html[] = "<div class=''>";
                                    $html[] = "<label class='fs-11 text-muted'>".ucwords(str_replace("_"," ", $key))."</label>";
                                    $html[] = "<p>$val</p>";
                                $html[] = "</div>";
                            }
                        }
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

            $html[] = "</div>";

            $html[] = "<div class='col-md-8 col-12'>";
                 $html[] = "<div class='card mb-3'>";
                    $html[] = "<div class='card-header'>";
                        $html[] = "<h3 class='card-title text-blue mb-0'>Notes</h3>";
                    $html[] = "</div>";

                    $html[] = "<div class='card-body'>";
                        $html[] = "<div class='notes-wrapper' style='height:300px; overflow-x: auto;'></div>";
                    $html[] = "</div>";
                    $html[] = "<div class='card-footer'>";
                        $html[] = "<input type='hidden' name='save_url' id='save_url' value='".url("LeadNotesController@saveNew", ["lead_id" => $data['lead_id']])."' />";
                        $html[] = "<form id='form' method='GET'>";
                            $html[] = "<input type='hidden' name='user_id' id='user_id' value='".$_SESSION['user_logged']['user_id']."' />";
                            $html[] = "<input type='hidden' name='lead_id' id='lead_id' value='".$data['lead_id']."' />";
                            /* $html[] = "<input type='hidden' name='iv' id='iv' value='' />";
                            $html[] = "<input type='hidden' name='content' id='content' value='' />"; */
                            
                            $html[] = "<div class='form-floating mb-3'>";
                                /* $html[] = "<input type='text' name='note' id='note' value='' class='form-control' />"; */
                                $html[] = "<input type='text' name='content' id='content' value='' class='form-control' />";
                                $html[] = "<label for='note'>Note</label>";
                            $html[] = "</div>";
                            $html[] = "<span class='btn btn-primary btn-save-note'>Save Note</span>";
                        $html[] = "</form>";
                    $html[] = "</div>";
                $html[] = "</div>";


                
            $html[] = "</div>";

        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";