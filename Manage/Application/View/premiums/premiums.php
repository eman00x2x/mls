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
				$html[] = "<div class='page-pretitle'>Subscribe to a premium to get the benefits in your account</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Premiums</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		if($data['subscription']) {

			$subscription = $data['subscription'][0];

			$html[] = "<div class='row row-deck row-cards mb-5'>";

				$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
					$html[] = "<div class='card'>";
						$html[] = "<div class='card-body'>";

							$html[] = "<h3 class='card-title'>Current Privileges</h3>";

							$html[] = "<table class='table'>";
							foreach($data['current_privileges'] as $key => $value) {
								$html[] = "<tr>";
									$html[] = "<td><span>".ucwords(str_replace("_"," ",$key))."</span></td>";
									$html[] = "<td class='text-center fw-bold'>";
										if(in_array($key, ["mls_access", "chat_access", "comparative_analysis_access"])) {
											$html[] = $value > 0 ? " Yes " : " No ";
										}else {
											$html[] = $value;
										}
									$html[] = "</td>";
								$html[] = "</tr>";
							}
							$html[] = "</table>";

						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			
				$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

					$html[] = "<div class='card'>";
						$html[] = "<div class='card-body'>";

							$html[] = "<h3 class='card-title'>Current Subscription</h3>";

							$html[] = "<p>";
								$html[] = "<span class='fs-13 text-muted d-block'>Name</span>";
								$html[] = $subscription['name'];
							$html[] = "</p>";

							$html[] = "<p>";
								$html[] = "<span class='fs-13 text-muted d-block'>Details</span>";
								$html[] = $subscription['details'];
							$html[] = "</p>";

							$html[] = "<p>";
								$html[] = "<span class='fs-13 text-muted d-block'>Premium Cost</span>";
								$html[] = "&#8369; ".$subscription['premium_price'];
							$html[] = "</p>";

							$html[] = "<div class='d-flex gap-5'>";

								$html[] = "<p>";
									$html[] = "<span class='fs-13 text-muted d-block'>Subscription Duration</span>";
									$html[] = $subscription['duration']." days";
								$html[] = "</p>";

								$html[] = "<p>";
									$html[] = "<span class='fs-13 text-muted d-block'>Subscription Started</span>";
									$html[] = date("d M Y", $subscription['subscription_start_at']);
								$html[] = "</p>";

								$html[] = "<p>";
									$html[] = "<span class='fs-13 text-muted d-block'>Subscription End</span>";
									$html[] = date("d M Y", $subscription['subscription_end_at']);
								$html[] = "</p>";

							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";

			$html[] = "</div>";

		}else {

			if((isset($data['premiums']['package']) && $data['premiums']['package']) && $data['subscription'] === false) {
				$html[] = "<h3 class='text-center text-white'>Available Package</h3>";
				$html[] = "<div class='mb-5' style='overflow:auto; white-space: nowrap;'>";
					$html[] = "<div class='d-flex flex-row flex-wrap justify-content-center '>";
						for($i=0; $i<count($data['premiums']['package']); $i++) {
							
							$html[] = "<div class='mx-2 mb-3' style='width:300px; white-space: wrap;'>";
								$html[] = "<div class='card card-md text-dark ".($data['premiums']['package'][$i]['name'] == "Silver Package" ? "bg-success-lt" : "")."'>";

									if($data['premiums']['package'][$i]['name'] == "Silver Package") {
										$html[] = "<div class='ribbon ribbon-top ribbon-bookmark bg-green'>";
											$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>';
										$html[] = "</div>";
									}

									$html[] = "<div class='card-body text-center'>";
										$html[] = "<div class='mb-3' style='min-height:250px; height:350px;'>";
											$html[] = "<div class='text-muted fw-medium'>".$data['premiums']['package'][$i]['name']."</div>";
											$html[] = "<div class='display-5 fw-bold my-3'>&#8369;".$data['premiums']['package'][$i]['cost']."</div>";
											$html[] = "<ul class='list-unstyled lh-lg'>";
												foreach(explode(",", $data['premiums']['package'][$i]['details']) as $details) {
													$html[] = "<li>$details</li>";
												}
											$html[] = "<ul>";
										$html[] = "</div>";
										$html[] = "<div class='text-center mt-4'>";
											$html[] = "<a href='".url("TransactionsController@mycart", ["premium_id" => $data['premiums']['package'][$i]['premium_id']])."' class='btn w-100'>Subscribe</a>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							
						}
					$html[] = "</div>";
				$html[] = "</div>";
			}
		
		}
		
		if(isset($data['premiums']['individual']) && $data['premiums']['individual']) {
			$html[] = "<h3 class='text-center'>Available Add-On</h3>";
			$html[] = "<div class='mb-5' style='overflow:auto; white-space: nowrap;'>";
				$html[] = "<div class='d-flex flex-row flex-nowrap justify-content-center '>";
					
					for($i=0; $i<count($data['premiums']['individual']); $i++) {

						$html[] = "<div class='mx-2' style='width:300px; white-space: wrap;'>";
							$html[] = "<div class='card card-md'>";

									$html[] = "<div class='ribbon ribbon-top ribbon-bookmark bg-green'>";
										$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>';
									$html[] = "</div>";

								$html[] = "<div class='card-body text-center'>";
									$html[] = "<div class='' style='min-height:250px; height:250px;'>";
										$html[] = "<div class='text-muted fw-medium'>".$data['premiums']['individual'][$i]['name']."</div>";
										$html[] = "<div class='display-5 fw-bold my-3'>&#8369;".$data['premiums']['individual'][$i]['cost']."</div>";
										$html[] = "<ul class='list-unstyled lh-lg'>";
											foreach(explode(",", $data['premiums']['individual'][$i]['details']) as $details) {
												$html[] = "<li>$details</li>";
											}
										$html[] = "<ul>";
									$html[] = "</div>";
									$html[] = "<div class='text-center mt-4'>";
										$html[] = "<a href='".url("TransactionsController@mycart", ["premium_id" => $data['premiums']['individual'][$i]['premium_id']])."' class='btn w-100'>Subscribe</a>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					}
				$html[] = "</div>";
			$html[] = "</div>";
		}

    $html[] = "</div>";
$html[] = "</div>";