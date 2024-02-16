<?php

$html[] = "<div class='row g-0 justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-md-8 col-12'>";

        $html[] = "<div class='page-header d-print-none text-white'>";
            $html[] = "<div class='container-xl'>";

                $html[] = "<div class='row g-2 '>";
                    $html[] = "<div class='col'>";
                        $html[] = "<div class='page-pretitle'></div>";
                        $html[] = "<h1 class='page-title'><i class='ti ti-file-invoice me-2'></i> Transactions</h1>";
                    $html[] = "</div>";

                    $html[] = "<div class='col-auto ms-auto d-print-none'>";

                        $html[] = "<div class='btn-list'>";
                            if($_SESSION['user_logged']['account_type'] == "Administrator") {
                                $html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account']['account_id']])."'>";
                                    $html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['account']['logo'].")'></span>";
                                    $html[] = $data['account']['firstname']." ".$data['account']['lastname']." account";
                                $html[] = "</a>";
                            }

                            $html[] = "<div class='btn-group dropstart'>";
                                $html[] = "<span class='btn btn-dark dropdown-toggle' id='transactionDropdownFilter' data-bs-toggle='dropdown' aria-expanded='false'><i class='ti ti-filter me-2'></i> Filter Result</span>";

                                $html[] = "<ul class='dropdown-menu' aria-labelledby='transactionDropdownFilter'>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "today"])."'>Today</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "this-week"])."'>This Week</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "this-month"])."'>This Month</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "this-year"])."'>This Year</a></li></li>";
                                    $html[] = "<li><hr class='dropdown-divider'></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "last-7-days"])."'>Last 7 Days</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "last-month"])."'>Last Month</a></li></li>";
                                    $html[] = "<li><a class='dropdown-item' href='".url("TransactionsController@index", $data['account']['account_id'], ["date" => "last-year"])."'>Last Year</a></li></li>";
                                $html[] = "</ul>";
                            $html[] = "</div>";
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
					
                        if($data['account']['transaction']) {
                            $html[] = "<table class='table'>";
                            for($i=0; $i<count($data['account']['transaction']); $i++) {
                                $html[] = "<tr>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@invoice", ["account_id" => $data['account']['account_id'], "id" => $data['account']['transaction'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Transaction Date</span>".date("F d, Y",$data['account']['transaction'][$i]['created_at'])."</a></td>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@invoice", ["account_id" => $data['account']['account_id'], "id" => $data['account']['transaction'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Premium</span>".$data['account']['transaction'][$i]['premium_description']."</a></td>";
                                    $html[] = "<td><a class='d-block text-dark' style='text-decoration: none' href='".url("TransactionsController@invoice", ["account_id" => $data['account']['account_id'], "id" => $data['account']['transaction'][$i]['transaction_id']])."'><span class='d-block text-muted fs-12'>Price</span>&#8369;".number_format($data['account']['transaction'][$i]['premium_price'],2)."</a></td>";
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