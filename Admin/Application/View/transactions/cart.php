<?php

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='overlay d-none'><div class='overlay-content'><img src='".CDN."images/loader.gif' alt='Processing...'/></div></div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";
        $html[] = "<form action='".url('TransactionsController@checkout', ["premium_id" => $data['premium_id']])."' method='POST'>";

        $html[] = "<input type='hidden' name='_method' value='POST' />";
        $html[] = "<input type='hidden' name='cost' id='cost' value='".$data['cost']."' />";
        $html[] = "<input type='hidden' name='duration' id='duration' value='".$data['cost']."' />";

        $html[] = "<div class='row justify-content-center'>";
        	$html[] = "<div class='col-md-8 col-12'>";
				
				$html[] = "<div class='card'>";
				
					$html[] = "<div class='card-header'>";
						$html[] = "<h2 class='card-title'><i class='ti ti-shopping-cart me-2'></i> Cost Summary</h2>";
					$html[] = "</div>";

					$html[] = "<div class='card-body'>";
						
                        $html[] = "<div class='row align-items-center '>";
                            $html[] = "<div class='col-lg-7 col-md-12 col-sm-12 col-12 '>";
                                $html[] = "<h3 class='mb-2 fs-18'>1 x ".$data['name']."</h3>";
                                $html[] = "<p class='text-muted'>".$data['details']."</p>";
                            $html[] = "</div>";

                            $html[] = "<div class='col-lg-3 col-md-12 col-sm-12 col-12 col-12 '>";
                                $html[] = "<div class='form-floating'>";
                                    $html[] = "<select name='duration' id='duration' class='form-select'>";
                                    foreach($data['duration'] as $days) {
                                        $html[] = "<option value='$days'>$days days</option>";
                                    }
                                    $html[] = "</select>";
                                    $html[] = "<label for='duration'>Duration</label>";
                                $html[] = "</div>";
                            $html[] = "</div>";
                            
                            $html[] = "<div class='col-lg-2 col-md-12 col-sm-12 col-12 col-12 '>";
                                $html[] = "<p class='mt-3 fs-18 fw-bold text-end'>&#8369; <span class='amount' data-cost='".$data['cost']."'>".number_format($data['cost'],2)."</span></p>";
                            $html[] = "</div>";

                        $html[] = "</div>";

						$html[] = "<p class='border-top pt-3 pe-3 fw-bold fs-16 text-end'><span class='text-muted fw-normal fs-14 me-2'>Total</span> &#8369; <span class='amount'>".number_format($data['cost'],2)."</span></p>";
						
					$html[] = "</div>";

					$html[] = "<div class='card-footer'>";

						$html[] = "<span id='paypal-button-container'></span>";

						$html[] = "<div class='d-flex gap-3 justify-content-between'>";
							$html[] = "<a href='".url("PremiumsController@index")."' class='btn btn-light text-muted'>Cancel</a>";
							$html[] = "<input type='submit' class='btn btn-success' value='Proceed to Checkout' />";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "</form>";

    $html[] = "</div>";
$html[] = "</div>";