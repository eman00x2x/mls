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
                $html[] = "<div class='page-pretitle'>Posted Listings</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> Listings Report</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='ajax btn btn-dark btn-download-report' href='".url("ReportsController@downloadListingsReport")."'><i class='ti ti-download me-2'></i> Download</span>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row'>";
            $html[] = "<div class='col-lg-3 col-md-5 col-sm-12 col-12'>";

                $html[] = "<div class='card mb-3'>";
                    $html[] = "<div class='card-header'>";
                        $html[] = "<h3 class='card-title'>Create Report</h3>";
                    $html[] = "</div>";
                    $html[] = "<div class='card-body'>";
                        $html[] = "<form id='create_report' method='get'>";
                            $html[] = "<div class='mb-3'>";
                                $html[] = "<label class='form-label'>Offer</label>";
                                $html[] = "<select name='offer' id='offer' class='form-select'>";
                                    foreach(["for sale","for rent","looking for"] as $offer) {
                                        $html[] = "<option value='$offer'>".ucwords($offer)."</option>";
                                    }
                                $html[] = "</select>";
                            $html[] = "</div>";

                            $html[] = $model->selection;

                            $html[] = "<div class='mb-3'>";
                                foreach([1 => "available", 0 => "expired", 2=> "sold"] as $key => $status) {
                                    $html[] = "<div class='form-check'>";
                                        $html[] = "<input type='checkbox' name='status[]' value='$key' class='form-check-input' id='statusCheckBox_$status' />";
                                        $html[] = "<label class='form-label' for='statusCheckBox_$status'>".ucwords($status)."</label>";
                                    $html[] = "</div>";
                                }
                            $html[] = "</div>";

                            $html[] = "<div class='mt-3 d-flex justify-content-between gap-3'>";
                                $html[] = "<a href='".url("ReportsController@propertiesReport")."' class='btn btn-secondary'>Reset</a>";
                                $html[] = "<span class='btn btn-primary btn-create-report'>Create Report</span>";
                            $html[] = "</div>";

                        $html[] = "</form>";
                    $html[] = "</div>";
                $html[] = "</div>";
                
            $html[] = "</div>";
            $html[] = "<div class='col-lg-9 col-md-7 col-sm-12 col-12'>";

                $html[] = "<div class=''>";
                    $html[] = "<div class='card mb-3'>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<h3 class='card-title'>Category Chart</h3>";
                            $html[] = "<div id='getCategoriesChart_this_year' class='chart-lg'></div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

                $html[] = "<div class=''>";
                    $html[] = "<div class='card mb-3'>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<h3 class='card-title'>Price Range Chart</h3>";
                            $html[] = "<div id='getPriceRangeChart' class='chart-lg'></div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

                $html[] = "<div class=''>";
                    $html[] = "<div class='card mb-3'>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='location-continer' style='height:400px;'>".$data['location']."</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";
