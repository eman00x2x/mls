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
						$html[] = "<div class='d-flex gap-5 flex-wrap'>";

							if(CONFIG['payment_gateway']['paypal'] == 1) {
								$html[] = "<div class='paypal-btn w-100 text-center'>";
									$html[] = "<span class='text-dark fst-italic mb-2 d-block'>Pay with PayPal</span>";
									$html[] = "<span id='paypal-button-container'></span>";
								$html[] = "</div>";
							}

							if(CONFIG['payment_gateway']['xendit'] == 1) {
								$html[] = "<div class='xendit-btn w-100 text-center'>";
									$html[] = "<span class='text-dark fst-italic mb-2 d-block'>Pay with Xendit</span>";
									$html[] = "<span class='btn btn-primary btn-xendit-checkout w-100 py-0'><img src='".CDN."images/04-xendit_logo_light.png' width='80' /></span>";
								$html[] = "</div>";
							}
							
						$html[] = "</div>";
						$html[] = "<p class='text-muted mt-4 fst-italic border rounded p-2' style='background-color:#f5f5f5;'><b>Xendit accepts</b> GCash, PayMAYA, ShopeePay, GrabPay, 7-Eleven, Cebuana Lhuillier, M Lhuiller, Palawan Express and many more</p>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";