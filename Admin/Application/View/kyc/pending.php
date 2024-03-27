<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

/** START PAGE BODY */
$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
		$html[] = "<div class='row justify-content-center'>";
			$html[] = "<div class='col-md-6 col-12'>";

					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<h1 class='display-5'>KYC status pending!</h1>";
							$html[] = "<p><i class='ti ti-hourglass'></i> The customer's KYC verification is currently pending approval by the compliance team, with an estimated waiting time of 2-3 business days</p>";
						$html[] = "</div>";
					$html[] = "</div>";
				
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";
/** END PAGE */

