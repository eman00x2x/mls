<?php

$html[] = "<input type='hidden' name='save_url' id='save_url' value='".url("AccountsController@verifyPin")."' />";

$html[] = "<div class='d-flex flex-column'>";
	$html[] = "<div class='page page-center'>";
		$html[] = "<div class='container container-tight py-4'>";

			$html[] = "<div class='mb-5 pb-5'></div>";

			$html[] = "<div class='card card-md'>";
				$html[] = "<div class='card-body'>";

					$html[] = "<form id='form' class='border-0' action='' method='POST'>";
						$html[] = "<input type='hidden' name='_method' value='POST' />";
						$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";

                        $html[] = "<div class='mb-4 d-flex gap-2'>";
                            $html[] = "<span><i class='ti ti-lock-open' style='font-size:48px;'></i></span>";
                            $html[] = "<div class=''>";
                                $html[] = "<h1 class='m-0 p-0 fw-bold'>Unlock an account </h1>";
                                $html[] = "<span class='form-hint'>Enter the account PIN to gain access</span>";
						    $html[] = "</div>";
						$html[] = "</div>";
                        
                        $html[] = "<div class='response'></div>";

						$html[] = "<div class='my-4'>";
                            $html[] = "<div class='row g-4'>";
                                $html[] = "<div class='col'>";
                                    $html[] = "<div class='row g-2'>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                                $html[] = "<div class='col'>";
                                    $html[] = "<div class='row g-2'>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                        $html[] = "<div class='col'>";
                                            $html[] = "<input type='text' name='pin[]' class='form-control form-control-lg text-center py-3' maxlength='1' data-code-input />";
                                        $html[] = "</div>";
                                    $html[] = "</div>";
                                $html[] = "</div>";
                            $html[] = "</div>";

                            $html[] = "<p class='form-hint mt-3'>To unlock an account, please enter the corresponding PIN (Personal Identification Number) associated with the account.</p>";
                        $html[] = "</div>";

						$html[] = "<div class='form-footer'>";
							$html[] = "<span class='btn btn-primary w-100 btn-unlock'><i class='ti ti-cloud-lock-open me-2'></i> Unloked account</span>";
						$html[] = "</div>";
					$html[] = "</form>";

				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";