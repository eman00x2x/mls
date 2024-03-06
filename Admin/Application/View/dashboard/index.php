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

					$html[] = "<div class='col-sm-6 col-lg-3'>";
						
					$html[] = "</div>";

					$html[] = "<div class='col-sm-6 col-lg-3'>";
						
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-6'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>Premium Purchases</h3>";
						$html[] = "<div id='getChartEarnings' class='chart-lg'></div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-6'>";
				$html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<h3 class='card-title'>Property Listings Traffic This Year</h3>";
						$html[] = "<div id='getTrafficChart_this_year' class='chart-lg'></div>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";

			$html[] = "<div class='col-6'>";
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
									$html[] = "<td>".$data['most_traffic'][$i]['title']."</td>";
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

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";
		