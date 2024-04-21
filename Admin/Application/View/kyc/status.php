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

							$html[] = "<div class='text-center'>";
								$html[] = "<img src='".CDN."images/icons/hourglass-high.svg' width='72' />";
								$html[] = "<h1 class='display-5'>Verification on Progress</h1>";
								$html[] = "<p>Your KYC verification is currently in progress.<br/>The customer's KYC verification is currently pending approval by the compliance team, with an estimated waiting time of 2-3 business days. You will receive a notification via email once the verification is complete.</p>";
								$html[] = "<img src='".CDN."images/icons/line-dotted.svg' width='72' />";
							$html[] = "</div>";
							
						$html[] = "</div>";
					$html[] = "</div>";
				
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";

$html[] = "</div>";
/** END PAGE */

