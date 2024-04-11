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
					$html[] = "<a class='ajax btn btn-dark' href='".MANAGE."exportToExcel.php'><i class='ti ti-download me-2'></i> Download</a>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class=''>";
            $html[] = "<div class='card mb-3'>";
				$html[] = "<div class='card-body'>";
					$html[] = "<h3 class='card-title'>Per Category</h3>";
					$html[] = "<div id='getCategoriesChart_this_year' class='chart-lg'></div>";
				$html[] = "</div>";
			$html[] = "</div>";
        $html[] = "</div>";

        $html[] = "<div class='row'>";
            $html[] = "<div class='col-lg-4 col-md-5 col-sm-12 col-12'>";

                $html[] = "<div class='card mb-3'>";
                    $html[] = "<div class='card-header'>";
                        $html[] = "<div class=''>";
                            $html[] = "<div class='d-flex gap-2 justify-content-center'>";
                                $html[] = $model->selection;
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                    $html[] = "<div class='card-body p-0'>";
                        $html[] = "<div class='location-continer' style='height:400px;'></div>";
                    $html[] = "</div>";
                $html[] = "</div>";
                
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";
