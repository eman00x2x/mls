<?php

$html[] = "<div class='response'>";
	$html[] = "<div class='container-xl'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
        	$html[] = "<div class='col-md-6 col-12'>";
				
				$html[] = "<div class='card'>";
				
					$html[] = "<div class='card-body pb-5'>";

						$html[] = "<h2 class='text-green text-center mb-5'>";
							
						if($data['transaction_status']) {
							$html[] = "<span class='d-block'>";
								$html[] = "<img src='".CDN."images/icons/checks.svg' width='128' />";
							$html[] = "</span>";
							$html[] = "Your Payment has been Successful!";
						}else {
							$html[] = "Transaction has been failed!";
						}

						$html[] = "</h2>";

						$html[] = "<p class='text-center'>";
							$html[] = "<span class='d-block text-muted'>Transaction Id</span>";
							$html[] = "<span class='fs-22'>".$data['transaction']['payment_transaction_id']."</span>";
						$html[] = "</p>";

						$html[] = "<p class='text-center'>";
							$html[] = "<span class='d-block text-muted'>Payment Date</span>";
							$html[] = "<span class='fs-22'>".date("d F Y", strtotime($data['transaction']['transaction_details']['create_time']))."</span>";
						$html[] = "</p>";

						$html[] = "<p class='text-center'>";
							$html[] = "<span class='d-block text-muted'>Total Amount Paid</span>";
							$html[] = "<span class='fs-22'>".$data['transaction']['premium_price']."</span>";
						$html[] = "</p>";

						$html[] = "<p class='text-center my-5'>";
							$html[] = "<a href='".url("TransactionsController@invoice", ["id" => $data['transaction']['transaction_id']])."' class='btn btn-primary'>View invoice</a>";
						$html[] = "</p>";
						
						/* $html[] = "<div class='table-responsive'>";
							$html[] = "<table class='table'>";
							foreach($data['transaction'] as $fields => $val) {
								$html[] = "<tr>";
									$html[] = "<td>$fields</td>";
									if(is_array($val)) {
										$html[] = "<td>";
											$html[] = "<pre>";
											$html[] = json_encode($val, JSON_PRETTY_PRINT);
											$html[] = "</pre>";
										$html[] = "</td>";
									}else {
										$html[] = "<td>$val</td>";
									}
								$html[] = "</tr>";
							}
							$html[] = "</table>";
						$html[] = "</div>"; */

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";