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

				$html[] = "<div class='card loader-container d-none'>";
					$html[] = "<div class='card-body'>";
						$html[] = "<div class='p-5 m-5 text-center'>";
							$html[] = "<div class='d-flex align-items-center justify-content-center'>";
								$html[] = "<div class='loader'></div>";
							$html[] = "</div>";
							$html[] = "<p class='mt-3 mb-0'>Please wait while processing your purchase.</p>";
							$html[] = "<p class='fst-italic text-muted'>Do not nagivate away or reload this page.</p>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

				
				$html[] = "<div class='card cart-container'>";
				
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

						$html[] = "<div class='xendit-btn mt-3'>";
							$html[] = "<span class='btn btn-primary btn-xendit-checkout w-100'>Xendit</span>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";