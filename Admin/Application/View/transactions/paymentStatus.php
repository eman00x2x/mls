<?php

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
        	$html[] = "<div class='col-md-6 col-12'>";
				$html[] = "<div class='response'>";
					$html[] = getMsg();
				$html[] = "</div>";

				$html[] = "<div class='card'>";
				
					$html[] = "<div class='card-header'>";
						$html[] = "<h2 class='card-title'><i class='ti ti-shopping-cart me-2'></i> ".$data['payment_status_message']."</h2>";
					$html[] = "</div>";

					$html[] = "<div class='card-body'>";
						
						$html[] = "<div class='table-responsive'>";
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
						$html[] = "</div>";

					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";