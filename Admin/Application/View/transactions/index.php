<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-md-10 col-12'>";

        $html[] = "<div class='page-header d-print-none text-white'>";
            $html[] = "<div class='container-xl'>";

                $html[] = "<div class='row g-2 '>";
                    $html[] = "<div class='col'>";
                        $html[] = "<div class='page-pretitle'></div>";
                        $html[] = "<h1 class='page-title'><i class='ti ti-file-invoice me-2'></i> Transactions</h1>";
                    $html[] = "</div>";

                    $html[] = "<div class='col-auto ms-auto d-print-none'>";

                        $html[] = "<div class='btn-list'>";
                          
                            $html[] = "<div class='btn-group dropstart'>";
                                $html[] = "<span class='btn btn-dark dropdown-toggle' id='transactionDropdownFilter' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-filter me-2'></i> Filter Result </span>";

                                $html[] = "<ul class='dropdown-menu' aria-labelledby='transactionDropdownFilter'>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "today"])."'>Today</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "this-week"])."'>This Week</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "this-month"])."'>This Month</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "this-year"])."'>This Year</a></li></li>";
                                    $html[] = "<li><hr class='dropdown-divider'></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "last-7-days"])."'>Last 7 Days</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "last-month"])."'>Last Month</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", null, ["date" => "last-year"])."'>Last Year</a></li></li>";
                                $html[] = "</ul>";
                            $html[] = "</div>";
                        $html[] = "</div>";

                    $html[] = "</div>";
                $html[] = "</div>";

            $html[] = "</div>";
        $html[] = "</div>";

        $html[] = "<div class='page-body'>";
            $html[] = "<div class='container-xl'>";

                if(isset($data['reports'])) {
                    $html[] = "<div class='d-flex flex-wrap justify-content-center mb-4 gap-3'>";
                        $html[] = "<div class='card card-sm flex-fill'>";
                            $html[] = "<div class='card-body'>";
                                $html[] = "<div class='row align-items-center'>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='avatar bg-indigo text-indigo-fg'><i class='ti ti-clipboard-data fs-26'></i></span>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='d-block text-muted fs-12 fst-italic'>Total Transactions</span>";
                                        $html[] = "<span class='d-block fs-20 fw-bold'>".number_format($data['reports']['total'], 0)."</span>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";

                        $html[] = "<div class='card card-sm flex-fill'>";
                            $html[] = "<div class='card-body'>";
                                $html[] = "<div class='row align-items-center'>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='avatar bg-orange text-orange-fg'><i class='ti ti-receipt-2 fs-26'></i></span>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='d-block text-muted fs-12 fst-italic'>Total Gross Amount</span>";
                                        $html[] = "<span class='d-block fs-20 fw-bold'>".number_format($data['reports']['total_gross_amount'] , 2)."</span>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";

                        $html[] = "<div class='card card-sm flex-fill'>";
                            $html[] = "<div class='card-body'>";
                                $html[] = "<div class='row align-items-center'>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='avatar bg-teal text-teal-fg'><i class='ti ti-receipt fs-26'></i></span>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='d-block text-muted fs-12 fst-italic'>Total Tax Amount</span>";
                                        $html[] = "<span class='d-block fs-20 fw-bold'>".number_format($data['reports']['total_tax_amount'] , 2)."</span>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";

                        $html[] = "<div class='card card-sm flex-fill'>";
                            $html[] = "<div class='card-body'>";
                                $html[] = "<div class='row align-items-center'>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='avatar bg-red text-red-fg'><i class='ti ti-report-money fs-26'></i></span>";
                                    $html[] = "</div>";
                                    $html[] = "<div class='col-auto'>";
                                        $html[] = "<span class='d-block text-muted fs-12 fst-italic'>Total Net Amount</span>";
                                        $html[] = "<span class='d-block fs-20 fw-bold'>".number_format($data['reports']['total_net_amount'] , 2)."</span>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                }

                $html[] = "<div class='card mb-3'>";

					if(isset($model->page['uri']['date'])) {
						$title = ucwords(str_replace('-', ' ', $model->page['uri']['date']));
					}else {
						$title = "All";
					}

					$html[] = "<div class='card-header'>";
						$html[] = "<h3 class='card-title'>".$title." Transactions</h3>";
					$html[] = "</div>";

                    $html[] = "<div class='card-body'>";

                        if($data['transactions']) {
                            $html[] = "<table class='table'>";
                            for($i=0; $i<count($data['transactions']); $i++) {
                                $html[] = "<tr>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transactions'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Transaction Date</span>".date("F d, Y",$data['transactions'][$i]['created_at'])."</a></td>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transactions'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Premium</span>".$data['transactions'][$i]['premium_description']."</a></td>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@view", ["id" => $data['transactions'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Price</span>&#8369;".number_format($data['transactions'][$i]['premium_price'],2)."</a></td>";
                                   /*  $html[] = "<td>";
										$html[] = "<span class='btn btn-outline-danger btn-delete cursor-pointer' data-bs-toggle='offcanvas' data-bs-target='#offcanvasEnd' aria-controls='offcanvasEnd' data-url='".url("TransactionsController@delete",["id" => $data['transactions'][$i]['transaction_id']])."'><i class='ti ti-trash me-1'></i> Delete</span>";
									$html[] = "</td>"; */
                                $html[] = "</tr>";
                            }
                            $html[] = "</table>";
                        }else {
							$html[] = "<p>No transactions</p>";
						}

                    $html[] = "</div>";
                $html[] = "</div>";

				if(!empty($model)) {
					$html[] = $model->pagination;
				}
                
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";