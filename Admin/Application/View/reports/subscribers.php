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
                $html[] = "<div class='page-pretitle'>Subscriber Per Region per Board</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-user-circle me-2'></i> Subscribers Report</h1>";
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

        $html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				$html[] = "<div class='box-container mb-3'>";
				
					$html[] = "<div class='search-box'>";
						$html[] = "<input type='text' name='search' id='search' value='' placeholder='Search Local Board' data-url='".url("ReportsController@subscribersReport")."' />";
						$html[] = "<a href='".url("ReportsController@subscribersReport")."' class='clearFilter'>CLEAR FILTER</a>";
					$html[] = "</div>";

                    if($data) {

                        $export[] = "REGION|LOCAL BOARD NAME|TOTAL SUBSCRIBER|NET EARNINGS";

						$html[] = "<div class='table-responsive'>";
                            $html[] = "<table class='table'>";
                            foreach($data as $region => $region_data) {
                                $html[] = "<thead>";
                                    $html[] = "<tr>";
                                        $html[] = "<th colspan='3'>$region</th>";
                                    $html[] = "</tr>";
                                $html[] = "</thead>";

                                for($i=0; $i<count($region_data); $i++) {
                                    $html[] = "<tbody>";
                                        $html[] = "<tr>";
                                            $html[] = "<td class='w-50'><span class='text-muted fs-12 d-block'>Board Name</span> ".$region_data[$i]['board']."</td>";
                                            $html[] = "<td class='text-center'><span class='text-muted fs-12 d-block'>Total Subscriber</span> ".$region_data[$i]['total']."</td>";
                                            $html[] = "<td class='text-center'><span class='text-muted fs-12 d-block'>Total Net Earnings</span> ".number_format($region_data[$i]['net_earnings'],2)."</td>";
                                        $html[] = "</tr>";
                                    $html[] = "</tbody>";

                                    $rows[$i][] = $region;
                                    $rows[$i][] = $region_data[$i]['board'];
                                    $rows[$i][] = $region_data[$i]['total'];
                                    $rows[$i][] = $region_data[$i]['net_earnings'];

                                    $export[] = implode("|", $rows[$i]);
                                }
                            }
                            $html[] = "</table>";
                        $html[] = "</div>";
                    }
        
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";

$_SESSION['export'] = $export;