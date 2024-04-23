<?php

$html[] = "<div class='container-xl'>";
$html[] = "<div class='row justify-content-center'>";
    $html[] = "<div class='col-lg-8 col-md-12 col-sm-12 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'></div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-file-invoice me-2'></i> Invoice</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";

								if($_SESSION['user_logged']['account_type'] == "Administrator") {
									$html[] = "<a class='ajax btn btn-dark' href='".url("AccountsController@view", ["id" => $data['account']['account_id']])."'>";
										$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['account']['logo'].")'></span>";
										$html[] = $data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']." account";
									$html[] = "</a>";
								}
								
								$html[] = "<a class='ajax btn btn-dark' href='javascript:window.print()'><i class='ti ti-printer me-2'></i> Print</a>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='card card-lg'>";
				
					$html[] = "<div class='card-body'>";

						$html[] = "<h1 class='mb-5'>Invoice</h1>";

						$html[] = "<div class='d-flex gap-2 justify-content-between'>";
							$html[] = "<p>";
								$html[] = "<span class='text-muted fs-11'>Account #".$data['account']['account_id']."</span>";
								$html[] = "<span class='d-block strong fs-18'>".$data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</span>";
								$html[] = "<span class='text-muted'>".$data['account']['email']."</span>";
							$html[] = "</p>";

							$html[] = "<p class='text-end'>";
								#$html[] = "<span class='d-block text-muted fs-11 text-end'>Transaction Date</span>";
								$html[] = "<span class='d-block'>".date("F d, Y", $data['transaction']['created_at'])."</span>";
								$html[] = "<span class='d-block text-end'>Transaction ID: ".$data['transaction']['payment_transaction_id']."</span>";
							$html[] = "</p>";
						$html[] = "</div>";
						
						if($data['transaction']['payment_source'] == "paypal") {
							$html[] = "<div class='d-flex gap-2 justify-content-between'>";
								$html[] = "<p>";
									$html[] = "<span class='text-muted fs-11'>Payer</span>";
									$html[] = "<span class='d-block strong fs-18'>".$data['transaction']['payer']['name']['given_name']." ".$data['transaction']['payer']['name']['surname']."</span>";
									$html[] = "<span class='text-muted'>".$data['transaction']['payer']['email_address']."</span>";
								$html[] = "</p>";

								$html[] = "<p>";
								$html[] = "</p>";
							$html[] = "</div>";
						}

						$html[] = "<div class='bg-muted-lt border p-4 mb-3'>";
							$html[] = "<div class='table-responsive'>";
								$html[] = "<table class='table table-transparent table-responsive mb-0'>";
								$html[] = "<thead>";
									$html[] = "<tr>";
										$html[] = "<th class='pt-0 text-center'>Payment Source</th>";
										$html[] = "<th class='pt-0 text-center'>Transaction Id</th>";
										$html[] = "<th class='pt-0 text-center'>Payment Status</th>";
										$html[] = "<th class='pt-0 text-center'>Date</th>";
									$html[] = "</tr>";
								$html[] = "</thead>";
								$html[] = "<tr>";
									$html[] = "<td class='text-dark text-center'>".strtoupper($data['transaction']['payment_source'])."</td>";
									$html[] = "<td class='text-dark text-center'>".$data['transaction']['payment_transaction_id']."</td>";
									$html[] = "<td class='text-dark text-center'>".$data['transaction']['payment_status']."</td>";
									$html[] = "<td class='text-dark text-center'>".date("F d, Y g:i a", $data['transaction']['transaction_details']['create_time'])."</td>";
								$html[] = "</tr>";
								$html[] = "</table>";
							$html[] = "</div>";
						$html[] = "</div>";
						
						$html[] = "<div class='table-responsive'>";
							$html[] = "<table class='table table-transparent table-responsive'>";
							$html[] = "<thead>";
								$html[] = "<tr>";
									$html[] = "<th class='w-1'></th>";
									$html[] = "<th style='width:500px;'>Product</th>";
									$html[] = "<th class='text-center'>Duration</th>";
									$html[] = "<th class='text-end'>Amount</th>";
								$html[] = "</tr>";
							$html[] = "</thead>";
							
							$html[] = "<tr>";
								$html[] = "<td class='text-muted text-center'>1</td>";
								$html[] = "<td>".$data['transaction']['premium_description']."</td>";
								$html[] = "<td class='text-center w-1'>".$data['transaction']['duration']." days</td>";
								$html[] = "<td class='text-end'>&#8369;".number_format($data['transaction']['premium_price'],2)."</td>";
							$html[] = "</tr>";

							if(VAT) {
								$html[] = "<tr>";
									$html[] = "<td colspan='3' class='border-dark strong text-uppercase text-end text-muted'>12% VAT</td>";
									$html[] = "<td class='text-end border-dark'>&#8369;".number_format($data['vat'],2)."</td>";
								$html[] = "</tr>";
							}

							$html[] = "<tr>";
								$html[] = "<td colspan='3' class='strong text-uppercase text-end text-muted'>Total</td>";
								$html[] = "<td class='text-end'>&#8369;".number_format($data['total'],2)."</td>";
							$html[] = "</tr>";
							$html[] = "</table>";
						$html[] = "</div>";

						if($data['transaction']['payment_status'] == "PENDING" && $data['transaction']['payment_source'] == "xendit") {
							$html[] = "<div class='mt-5'>";
								$html[] = "<p class='text-center'>";
									$html[] = "<a href='".$data['transaction']['transaction_details']['links']['href']."' class='btn btn-primary'>Click here to pay</a>";
								$html[] = "</p>";
							$html[] = "</div>";
						}

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";
$html[] = "</div>";