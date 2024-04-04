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
				$html[] = "<div class='page-pretitle'>Subscriptions of ".$data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']."</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Subscriptions</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						if(isset($_SESSION['permissions']['subscriptions'])) {
							$html[] = "<a class='btn btn-danger' href='".url("PremiumsController@index")."'>Subscribe to Premiums</a>";
						}
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row'>";
			$html[] = "<div class='col-12'>";
				
                $html[] = "<div class='card mb-3'>";
					$html[] = "<div class='card-header'>";
						$html[] = "<h4 class='text-blue card-title mb-0'>Premium Subscriptions</h4>";
					$html[] = "</div>";
				
					$html[] = "<div class='card-body'>";
						
						if($data['subscriptions']) { $c=0;
							$html[] = "<div style='max-height: 500px; overflow-x:auto;'>";
								$html[] = "<div class='table-responsive'>";
									
									$html[] = "<table class='table table-hover table-outline'>";
									$html[] = "<thead>";
										$html[] = "<tr>";
											$html[] = "<th class='text-center w-1'>#</th>";
											$html[] = "<th>Subscription Date</th>";
											$html[] = "<th>Details</th>";
											$html[] = "<th>Subscription Started</th>";
											$html[] = "<th>Subscription End</th>";
											$html[] = "<th></th>";
										$html[] = "</tr>";
									$html[] = "</thead>";
									
									$html[] = "<tbody>";
									for($i=0; $i<count($data['subscriptions']); $i++) { $c++;
										
										$html[] = "<tr class='row_subscription_".$data['subscriptions'][$i]['account_subscription_id']."'>";
											$html[] = "<td class='align-middle text-center w-1 text-muted'>$c</td>";
											$html[] = "<td class='align-middle'>".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_start_at'])."</td>";
											$html[] = "<td class='align-middle' style='width:300px'>".$data['subscriptions'][$i]['name']." <span class='text-muted small d-block'>".$data['subscriptions'][$i]['details']."</span></td>";
											$html[] = "<td class='align-middle'>".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_start_at'])."</td>";
                                            $html[] = "<td class='align-middle'>";
												
													$html[] = "".date("F d, Y g:ia",$data['subscriptions'][$i]['subscription_end_date'])."";
												
											$html[] = "</td>";
											$html[] = "<td class='align-middle text-center'>";
												switch($data['subscriptions'][$i]['subscription_status']) {
													case 0: $html[] = "Suspended"; break;
													case 1: $html[] = "Active"; break;
													case 2: $html[] = "Ended"; break;
												}
											$html[] = "</td>";
										$html[] = "</tr>";
										
									}
									$html[] = "</tbody>";
									$html[] = "</table>";
									
								$html[] = "</div>";
							$html[] = "</div>";
						}else {
							$html[] = "<p class='mt-3'>This account does not have subscriptions.</p>";
						}

					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

		if(!empty($model)) {
			$html[] = $model->pagination;
		}

	$html[] = "</div>";
$html[] = "</div>";