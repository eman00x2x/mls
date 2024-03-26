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
				$html[] = "<div class='page-pretitle'></div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Transaction</h1>";
			$html[] = "</div>";
			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='btn-list text-end'>";
					
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='card'>";
            $html[] = "<div class='card-body'>";
                
                $html[] = "<div class='d-flex flex-wrap justify-content-between align-items-center mb-3'>";
                    $html[] = "<h3 class='card-title'>Transaction: ".$data['payment_transaction_id']."</h3>";
                    $html[] = "<a href='".url("TransactionsController@invoices", ["account_id" => $data['account_id'], "id" => $data['transaction_id']])."' class='btn btn-outline-primary'><i class='ti ti-file-invoice me-1'></i> View invoice</a>";
                $html[] = "</div>";

                $html[] = "<div class='table-responsive'>";
                    $html[] = "<table class='table table-bordered'>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Transaction Date</td>";
                        $html[] = "<td class='align-middle'>".date("d M Y h:i A", $data['created_at'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Transaction Id</td>";
                        $html[] = "<td class='align-middle'>".$data['payment_transaction_id']."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Account</td>";
                        $html[] = "<td class='align-middle'>";
                            $html[] = "<div class='d-flex align-items-center gap-2'>";
                                $html[] = "<span class='avatar avatar-md' style='background-image: url(".$data['account']['logo'].")'></span>";
                                $html[] = "<div class=''>";
                                    $html[] = "<span class='d-block'>".$data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['middlename']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</span>";
                                    $html[] = "<span class='d-block text-muted fs-12'>".$data['account']['profession']."</span>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                        $html[] = "</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Premium</td>";
                        $html[] = "<td class='align-middle'>".$data['premium_description']."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Price</td>";
                        $html[] = "<td class='align-middle'>&#8369; ".number_format($data['premium_price'], 2)."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Payment Source</td>";
                        $html[] = "<td class='align-middle'>".strtoupper($data['payment_source'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-middle'>Payment Status</td>";
                        $html[] = "<td class='align-middle'>".strtoupper($data['payment_status'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td class='align-top'>Transaction Details</td>";
                        $html[] = "<td class='align-top p-0'>";
                            $html[] = "<table class='table'>";
                            if(isset($data['transaction_details']['seller_receivable_breakdown'])) {
                                foreach($data['transaction_details']['seller_receivable_breakdown'] as $key => $arr) {
                                    $html[] = "<tr>";
                                        $html[] = "<td style='width:200px;'>".ucwords(str_replace("_"," ", $key))."</td>";
                                        $html[] = "<td class='fw-bold'>";
                                            if(isset($data['transaction_details']['seller_receivable_breakdown'][$key]['currency_code'])) {
                                                $html[] = "".$data['transaction_details']['seller_receivable_breakdown'][$key]['currency_code']." ";
                                            }
                                            if($key != "exchange_rate") {
                                                if(isset($data['transaction_details']['seller_receivable_breakdown'][$key]['value'])) {
                                                    $html[] = number_format($data['transaction_details']['seller_receivable_breakdown'][$key]['value'],2);
                                                }
                                                
                                            }else {
                                                $html[] = $data['transaction_details']['seller_receivable_breakdown'][$key]['value'];
                                            }
                                        $html[] = "</td>";
                                    $html[] = "</tr>";
                                }
                            }

                            if(isset($data['transaction_details']['transaction'])) {
                                $html[] = "<tr>";
                                    $html[] = "<td style='width:200px;'>Processed By</td>";
                                    $html[] = "<td>".$data['transaction_details']['transaction']['name']."</td>";
                                $html[] = "</tr>";

                                if(isset($data['payer']['transaction_number'])) {
                                    $html[] = "<tr>";
                                        $html[] = "<td style='width:200px;'>Transaction / Check / Reference Numbers</td>";
                                        $html[] = "<td>".$data['payer']['transaction_number']."</td>";
                                    $html[] = "</tr>";
                                }
                            }

                            $html[] = "</table>";
                        $html[] = "</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";
                $html[] = "</div>";

            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";