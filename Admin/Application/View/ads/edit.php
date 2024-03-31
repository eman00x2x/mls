<?php

$html[] = "<input type='hidden' id='photo_uploader' value='page_ads' />";
$html[] = "<form action='".url("PageAdsController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("PageAdsController@saveUpdate", ["id" => $data['page_ads_id']])."' />";

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";
        $html[] = "<div class='row justify-content-center'>";
            $html[] = "<div class='col-lg-8 col-md-10 col-12'>";
                $html[] = "<div class='row g-2 '>";
                    $html[] = "<div class='col'>";
                        $html[] = "<h1 class='page-title'><i class='ti ti-ad me-2'></i> Page Ads Settings</h1>";
                    $html[] = "</div>";
                    $html[] = "<div class='col-auto ms-auto d-print-none'>";
                        $html[] = "<div class='d-none d-sm-inline'>";
                            $html[] = "<div class='btn-list'>";
                                
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
        
        $html[] = "<div class='row justify-content-center mb-5 pb-5'>";
            $html[] = "<div class='col-lg-8 col-md-10 col-12'>";

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Update Page Ads Settings</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							$html[] = "<div class='text-center bg-white mb-5'>";
								$html[] = "<input type='hidden' name='banner' class='banner' id='photo' class='form-control' value='".$data['banner']."' />";
								$html[] = "<span class='avatar photo-preview mb-1 mb-3 rounded-0' style='background-image: url(".$data['banner'].")'></span>";
								$html[] = "<small class='d-block'>Click to Upload Banner</small>";
								$html[] = "<span class='photo-upload-loader d-block'></span>";
							$html[] = "</div>";

							
                            $html[] = "<div class='row justify-content-center'>";
	                            $html[] = "<div class='col-lg-8 col-md-10 col-12'>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Placement</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<select class='form-select' name='placement' id='placement'>";
                                                $html[] = "<option value=''></option>";
                                                foreach($model->placements as $key => $arr) {
                                                    $sel = $key == $data['placement'] ? "selected" : "";
                                                    $html[] = "<option value='$key' data-width='".$arr['size']['width']."' data-height='".$arr['size']['height']."' $sel>$key</option>";
                                                }
                                            $html[] = "</select>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Size Guide</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<input type='text' class='size-guide form-control-plaintext' value='' />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Visibility</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<select class='form-select' name='visibility' id='visibility'>";
                                                foreach(["visible", "hidden"] as $val) {
                                                    $sel = $val == $data['visibility'] ? " selected" : "";
                                                    $html[] = "<option value='$val' $sel>".ucwords($val)."</option>";
                                                }
                                            $html[] = "</select>";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end' for='url'>URL</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<input type='url' name='url' id='url' value='".$data['url']."' class='form-control' />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end' for='started_at'>Start Date</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<input type='date' name='started_at' id='started_at' value='".date("Y-m-d", $data['started_at'])."' class='form-control' />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                    $html[] = "<div class='row mb-3'>";
                                        $html[] = "<label class='text-muted col-sm-3 col-form-label text-end' for='ended_at'>End Date</label>";
                                        $html[] = "<div class='col-sm-9'>";
                                            $html[] = "<input type='date' name='ended_at' id='ended_at' value='".date("Y-m-d", $data['ended_at'])."' class='form-control' />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";

                                $html[] = "</div>";
                            $html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</form>";

			$html[] = "</div>";

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Page Ads</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";