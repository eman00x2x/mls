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
				$html[] = "<div class='page-pretitle'>Account Overview</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-layout-dashboard me-2'></i> Dashboard</h1>";
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
		
		$html[] = "<div class='row row-deck row-cards'>";

			$html[] = "<div class='col-12'>";
				$html[] = "<div class='row row-cards'>";

					$html[] = "<div class='col-sm-6 col-lg-3'>";
						$html[] = "<div class='card card-sm'>";
							$html[] = "<div class='card-body'>";
								$html[] = "<div class='row align-items-center'>";
									$html[] = "<div class='col-auto'>";
										$html[] = "<span class='bg-primary text-white avatar'><i class='ti ti-user'></i></span>";
									$html[] = "</div>";
									$html[] = "<div class='col'>";
										$html[] = "<div class='font-weight-medium'><span class='fs-18'>".$data['total_accounts']." Active Accounts</span></div>";
										$html[] = "<div class='text-secondary'>Registered Accounts</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

					$html[] = "<div class='col-sm-6 col-lg-3'>";
						$html[] = "<div class='card card-sm'>";
							$html[] = "<div class='card-body'>";
								$html[] = "<div class='row align-items-center'>";
									$html[] = "<div class='col-auto'>";
										$html[] = "<span class='bg-success text-white avatar'><i class='ti ti-premium-rights'></i></span>";
									$html[] = "</div>";
									$html[] = "<div class='col'>";
										$html[] = "<div class='font-weight-medium'><span class='fs-18'>&#8369;".number_format($data['total_earnings'],1)."</span> </div>";
										$html[] = "<div class='text-secondary'>This Week Earnings</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

					if($data['kyc']) {

						$bg = [
							0 => "bg-primary",
							1 => "bg-red",
							2 => "bg-success",
							3 => "bg-warning"
						];

						for($i=0; $i<count($data['kyc']); $i++) {

							$html[] = "<div class='col-sm-6 col-lg-3'>";
								$html[] = "<div class='card card-sm'>";
									$html[] = "<div class='card-body'>";
										$html[] = "<div class='row align-items-center'>";
											$html[] = "<div class='col-auto'>";
												$html[] = "<span class='".$bg[$i]." text-white avatar'><i class='ti ti-user'></i></span>";
											$html[] = "</div>";
											$html[] = "<div class='col'>";
												$html[] = "<div class='font-weight-medium'><span class='fs-18'>".$data['kyc'][$i]['total']." Accounts</span></div>";
												$html[] = "<div class='text-secondary'>".$data['kyc'][$i]['description']."</div>";
											$html[] = "</div>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						}
					}

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-6 col-sm-6 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>Property Listings Traffic This Year</h3>";
						$html[] = "<div id='getTrafficChart_this_year' class='chart-lg'></div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-6 col-sm-6 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>Premium Purchases</h3>";
						$html[] = "<div id='getChartEarnings' class='chart-lg'></div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>KYC Verification This Year</h3>";
						$html[] = "<div id='getKycDateVerified_this_year' class='chart-lg'></div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-6 col-sm-6 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-header'>";
						$html[] = "<h3 class='card-title'>Most Visited Property Listings</h3>";
					$html[] = "</div>";

					$html[] = "<div class='card-table table-responsive'>";
						$html[] = "<table class='table table-vcenter'>";
						$html[] = "<thead>";
							$html[] = "<th>Posting Title</th>";
							$html[] = "<th class='text-center'>Visitors</th>";
							$html[] = "<th class='text-center'>Posted By</th>";
							$html[] = "<th></th>";
						$html[] = "</thead>";

						if($data['most_traffic']) {
							for($i=0; $i<count($data['most_traffic']); $i++) {
								$html[] = "<tr>";
									$html[] = "<td>".$data['most_traffic'][$i]['title']." <span class='text-muted fs-12 d-block'>".str_replace([WEBDOMAIN, MANAGE], ["",""], $data['most_traffic'][$i]['url'])."</span></td>";
									$html[] = "<td class='text-center'>".$data['most_traffic'][$i]['count']."</td>";
									$html[] = "<td class='text-center'>".$data['most_traffic'][$i]['posted_by']."</td>";
									$html[] = "<td></td>";
								$html[] = "</tr>";
							}
						}

						$html[] = "</table>";
					$html[] = "</div>";
					
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>KYC Verification Statistics</h3>";
						
						$html[] = "<div class='table-responsive' style='max-height:350px; overflow-y: auto;'>";
							$html[] = "<table class='table'>";
							$html[] = "<thead>";
								$html[] = "<th>Details</th>";
								$html[] = "<th class='text-center'>Total</th>";
							$html[] = "</thead>";

							if($data['kyc_statistics']) {
								$html[] = "<tbody>";
								for($i=0; $i<count($data['kyc_statistics']); $i++) {
									$html[] = "<tr>";
										$html[] = "<td>".$data['kyc_statistics'][$i]['verification_details']."</td>";
										$html[] = "<td class='text-center'>".$data['kyc_statistics'][$i]['total']."</td>";
									$html[] = "</tr>";
								}
								$html[] = "<tbody>";
							}

							$html[] = "</table>";
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-lg-4 col-md-4 col-sm-12 col-12'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>KYC Verifier</h3>";
						
						$html[] = "<div class='table-responsive' style='max-height:350px; overflow-y: auto;'>";
							$html[] = "<table class='table'>";
							$html[] = "<thead>";
								$html[] = "<th>Verifier</th>";
								$html[] = "<th class='text-center'>Total Verified</th>";
							$html[] = "</thead>";

							if($data['kyc_verifier']) {
								$html[] = "<tbody>";
								for($i=0; $i<count($data['kyc_verifier']); $i++) {
									$html[] = "<tr>";
										$html[] = "<td>".$data['kyc_verifier'][$i]['verified_by']."</td>";
										$html[] = "<td class='text-center'>".$data['kyc_verifier'][$i]['total']."</td>";
									$html[] = "</tr>";
								}
								$html[] = "<tbody>";
							}

							$html[] = "</table>";
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
		