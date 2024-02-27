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
				$html[] = "<div class='page-pretitle'>Subscribe to a premium to get the benefits in your account</div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-layers-union me-2'></i> Premiums</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<h3 class='text-center text-white'>Available Package</h3>";

			$html[] = "<div class='mb-5' style='overflow:auto; white-space: nowrap;'>";
				$html[] = "<div class='d-flex flex-row flex-nowrap justify-content-center '>";
					if($data['premiums']['package']) {
						for($i=0; $i<count($data['premiums']['package']); $i++) {
							
							$html[] = "<div class='mx-2' style='width:300px; white-space: wrap;'>";
								$html[] = "<div class='card card-md text-dark ".($data['premiums']['package'][$i]['name'] == "Silver Package" ? "bg-success-lt" : "")."'>";

									if($data['premiums']['package'][$i]['name'] == "Silver Package") {
										$html[] = "<div class='ribbon ribbon-top ribbon-bookmark bg-green'>";
											$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>';
										$html[] = "</div>";
									}

									$html[] = "<div class='card-body text-center'>";
										$html[] = "<div class='mb-3' style='min-height:250px; height:250px;'>";
											$html[] = "<div class='text-muted fw-medium'>".$data['premiums']['package'][$i]['name']."</div>";
											$html[] = "<div class='display-5 fw-bold my-3'>&#8369;".$data['premiums']['package'][$i]['cost']."</div>";
											$html[] = "<ul class='list-unstyled lh-lg'>";
												foreach(explode(",", $data['premiums']['package'][$i]['details']) as $details) {
													$html[] = "<li>$details</li>";
												}
											$html[] = "<ul>";
										$html[] = "</div>";
										$html[] = "<div class='text-center mt-4'>";
											$html[] = "<a href='".url("TransactionsController@checkout", ["premium_id" => $data['premiums']['package'][$i]['premium_id']])."' class='btn w-100'>Subscribe</a>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
							
						}
					}
				$html[] = "</div>";
			$html[] = "</div>";
		

        $html[] = "<h3 class='text-center'>Available Add-On</h3>";

		$html[] = "<div class='mb-5' style='overflow:auto; white-space: nowrap;'>";
            $html[] = "<div class='d-flex flex-row flex-nowrap justify-content-center '>";
				if($data['premiums']['individual']) {
					for($i=0; $i<count($data['premiums']['individual']); $i++) {

						$html[] = "<div class='mx-2' style='width:300px; white-space: wrap;'>";
							$html[] = "<div class='card card-md'>";

									$html[] = "<div class='ribbon ribbon-top ribbon-bookmark bg-green'>";
										$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>';
									$html[] = "</div>";

								$html[] = "<div class='card-body text-center'>";
									$html[] = "<div class='' style='min-height:250px; height:250px;'>";
										$html[] = "<div class='text-muted fw-medium'>".$data['premiums']['individual'][$i]['name']."</div>";
										$html[] = "<div class='display-5 fw-bold my-3'>&#8369;".$data['premiums']['individual'][$i]['cost']."</div>";
										$html[] = "<ul class='list-unstyled lh-lg'>";
											foreach(explode(",", $data['premiums']['individual'][$i]['details']) as $details) {
												$html[] = "<li>$details</li>";
											}
										$html[] = "<ul>";
									$html[] = "</div>";
									$html[] = "<div class='text-center mt-4'>";
										$html[] = "<a href='".url("TransactionsController@checkout", ["premium_id" => $data['premiums']['individual'][$i]['premium_id']])."' class='btn w-100'>Subscribe</a>";
									$html[] = "</div>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
						
					}
				}
			$html[] = "</div>";
		$html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";