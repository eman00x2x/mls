<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
        	$html[] = "<div class='col-md-6 col-12'>";
				
				$html[] = "<div class='card'>";
				
					$html[] = "<div class='card-body pb-5'>";

						$html[] = "<h2 class='text-center mb-5'>";
							
						if(in_array($data['transaction']['payment_status'], ["COMPLETED", "PAID"])) {
							$html[] = "<span class='d-block text-green'>";
								$html[] = "<i class='ti ti-xbox-x' style='font-size:100px;'></i>";
							$html[] = "</span>";
							$html[] = "<span class='text-green'>Your Payment has been Successful!</span>";
						}else {
							$html[] = "<span class='d-block text-danger mb-3'>";
								$html[] = "<i class='ti ti-xbox-x' style='font-size:100px;'></i>";
							$html[] = "</span>";
							$html[] = "<span class='text-danger'>Transaction has been failed!</span>";
						}

						$html[] = "</h2>";

						$html[] = "<p class='text-center'>";
							$html[] = "<span class='d-block text-muted'>Transaction Id</span>";
							$html[] = "<span class='fs-22'>".$data['transaction']['payment_transaction_id']."</span>";
						$html[] = "</p>";

						if(in_array($data['transaction']['payment_status'], ["COMPLETED", "PAID"])) {

							$html[] = "<p class='text-center'>";
								$html[] = "<span class='d-block text-muted'>Payment Date</span>";
								$html[] = "<span class='fs-22'>".date("d F Y", strtotime($data['transaction']['transaction_details']['create_time']))."</span>";
							$html[] = "</p>";

							$html[] = "<p class='text-center'>";
								$html[] = "<span class='d-block text-muted'>Total Amount Paid</span>";
								$html[] = "<span class='fs-22'>&#8369;".number_format($data['transaction']['premium_price'],2)."</span>";
							$html[] = "</p>";

							$html[] = "<p class='text-center my-5'>";
								$html[] = "<a href='".url("TransactionsController@invoice", ["id" => $data['transaction']['transaction_id']])."' class='btn btn-primary'>View invoice</a>";
							$html[] = "</p>";

						}else {

							$html[] = "<p class='text-center'>";
								$html[] = "<span class='d-block text-muted'>Amount to be paid</span>";
								$html[] = "<span class='fs-22'>&#8369;".number_format($data['transaction']['premium_price'],2)."</span>";
							$html[] = "</p>";

							if($data['transaction']['payment_source'] == "xendit") {
								$html[] = "<p class='text-center my-5'>";
									$html[] = "<a href='".$data['transaction']['transaction_details']['links']['href']."' class='btn btn-primary'>Click here to retry</a>";
								$html[] = "</p>";
							}
						}
						
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";