<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row justify-content-center'>";
	$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

        $html[] = "<div class='page-header d-print-none text-white'>";
            $html[] = "<div class='container-xl'>";

                $html[] = "<div class='row g-2 '>";
                    $html[] = "<div class='col'>";
                        $html[] = "<div class='page-pretitle'>Total Monthly Transactions</div>";
                        $html[] = "<h1 class='page-title'><i class='ti ti-report me-2'></i> Transactions Report</h1>";
                    $html[] = "</div>";

                    $html[] = "<div class='col-auto ms-auto d-print-none'>";
                        $html[] = "<div class='btn-list'>";
                            $html[] = "<a class='ajax btn btn-dark' href='".MANAGE."exportToExcel.php'><i class='ti ti-download me-2'></i> Download</a>";

                            $html[] = "<div class='dropdown dropstart'>";
                                $html[] = "<span class='btn btn-dark dropdown-toggle' id='year-selection' data-bs-toggle='dropdown' aria-expanded='false'>Year</span>";
                                $html[] = "<ul class='dropdown-menu' aria-labelledby='year-selection' style='max-height: 400px; overflow-y: scroll'>";
                                    $years = range(2024, date("Y", strtotime("+5 years")));
                                    foreach($years as $year) {
                                        $html[] = "<li><a class='dropdown-item' href='".url("ReportsController@transactionsReport", null, ["year" => $year])."'>Year $year</a></li>";
                                    }
                                $html[] = "</ul>";
                            $html[] = "</div>";

                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

            $html[] = "</div>";
        $html[] = "</div>";

        $html[] = "<div class='page-body'>";
            $html[] = "<div class='container-xl'>";

                if($data) {

                    $calendar = cal_info(0);
                    $year = $data[ $model->page['uri']['year'] ];
                    
                    $html[] = "<div class='card'>";

                        $html[] = "<div class='ribbon bg-red'>";
                            $html[] = "<span class='fs-28'>".$model->page['uri']['year']."</span>";
                        $html[] = "</div>";

                        $html[] = "<div class='card-header'>";
                            $html[] = "<h3 class='card-title'>Monthly Earnings</h3>";
                        $html[] = "</div>";

                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='table-responsive'>";
                            
                                $html[] = "<table class='table'>";
                                $html[] = "<thead>";
                                    $html[] = "<tr>";
                                        $html[] = "<th  class=''>Month</th>";
                                        $html[] = "<th  class='text-center'>Gross Earnings</th>";
                                        $html[] = "<th  class='text-center'>Tax</th>";
                                        $html[] = "<th  class='text-center'>Net Earnings</th>";
                                    $html[] = "</tr>";
                                $html[] = "</thead>";
                                $html[] = "<tbody>";

                                $total_gross = 0;
                                $total_tax = 0;
                                $total_net = 0;

                                foreach($calendar['months'] as $key => $month) {
                                    if(isset($year[$month])) {

                                        $html[] = "<tr>";
                                            $html[] = "<td>".$month."</td>";
                                            $html[] = "<td class='text-center'>&#8369; ".number_format($year[$month]['gross_earnings'],2)."</td>";
                                            $html[] = "<td class='text-center'>&#8369; ".number_format( (int) $year[$month]['tax'],2)."</td>";
                                            $html[] = "<td class='text-center'>&#8369; ".number_format($year[$month]['net_earnings'],2)."</td>";
                                        $html[] = "</tr>";

                                        $rows[$key][] = $month;
                                        $rows[$key][] = $year[$month]['gross_earnings'];
                                        $rows[$key][] = $year[$month]['tax'];
                                        $rows[$key][] = $year[$month]['net_earnings'];

                                        $total_gross += (int) $year[$month]['gross_earnings'];
                                        $total_tax += (int) $year[$month]['tax'];
                                        $total_net += (int) $year[$month]['net_earnings'];

                                    }else {

                                        $html[] = "<tr>";
                                            $html[] = "<td>$month</td>";
                                            $html[] = "<td class='text-center'>-</td>";
                                            $html[] = "<td class='text-center'>-</td>";
                                            $html[] = "<td class='text-center'>-</td>";
                                        $html[] = "</tr>";

                                        $rows[$key][] = $month;
                                        $rows[$key][] = '0';
                                        $rows[$key][] = '0';
                                        $rows[$key][] = '0';

                                    }

                                    $export[] = implode("|", $rows[$key]);
                                    unset($rows);

                                }

                                $html[] = "<tr>";
                                    $html[] = "<td class='text-muted'>Total</td>";
                                    $html[] = "<td class='text-center fw-bold'>&#8369; ".number_format($total_gross, 2)."</td>";
                                    $html[] = "<td class='text-center fw-bold'>&#8369; ".number_format($total_tax, 2)."</td>";
                                    $html[] = "<td class='text-center fw-bold'>&#8369; ".number_format($total_net, 2)."</td>";
                                $html[] = "</tr>";

                                $html[] = "</tbody>";
                                $html[] = "</table>";

                            $html[] = "</div>";

                        $html[] = "</div>";
                    $html[] = "</div>";

                }else {

                    $html[] = "<div class='card'>";
                        $html[] = "<div class='empty'>";
                            $html[] = "<div class='empty-image'>";
                                $html[] = "<img src='".CDN."images/undraw_quitting_time_dm8t.svg' height='128' />";
                            $html[] = "</div>";
                            $html[] = "<p class='empty-title'>No results found</p>";
                            $html[] = "<p class='empty-subtitle text-secondary'>Try adjusting your search or filter to find what you're looking for.</p>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                }
        
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";

if(isset($export)) {
    $_SESSION['export'] = $export;   
}