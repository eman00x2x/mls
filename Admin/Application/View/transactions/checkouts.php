<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='overlay d-none'><div class='overlay-content'><img src='".CDN."images/loader.gif' alt='Processing...'/></div></div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row justify-content-center'>";
        	$html[] = "<div class='col-md-6 col-12'>";
				
				$html[] = "<div class='card'>";
				
					$html[] = "<div class='card-header'>";
						$html[] = "<h2 class='card-title'><i class='ti ti-shopping-cart me-2'></i> Cost Summary</h2>";
					$html[] = "</div>";

					$html[] = "<div class='card-body'>";
						
						$html[] = "<div class='row align-items-center gap-3 '>";
							$html[] = "<div class='col-lg-7 col-md-7 col-sm-12 col-12 '>";
								$html[] = "<h3 class='mb-2 fs-18'>1 x ".$data['name']."</h3>";
								$html[] = "<p class='text-muted'>".$data['details']."</p>";
							$html[] = "</div>";

							$html[] = "<div class='col-lg-2 col-md-2 col-sm-12 col-12 '>";
								$html[] = "<span class='text-muted fs-12'>Duration</span>";
								$html[] = "<p class='fw-bold'>".$data['duration']." days</p>";
							$html[] = "</div>";
							
							$html[] = "<div class='col-lg-2 col-md-2 col-sm-12 col-12 '>";
								$html[] = "<span class='text-muted fs-12'>Amount</span>";
								$html[] = "<p class='fw-bold'>&#8369;".number_format($data['cost'],2)."</p>";
							$html[] = "</div>";

						$html[] = "</div>";

						$html[] = "<p class='border-top pt-3 pe-3 fw-bold fs-16 text-end'><span class='text-muted fw-normal fs-14 me-2'>Total</span> &#8369;".number_format($data['cost'],2)."</p>";
						
					$html[] = "</div>";

					$html[] = "<div class='card-footer'>";
						$html[] = "<span id='paypal-button-container'></span>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";