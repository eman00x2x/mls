<?php

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$columns = explode(",","listing_id,offer,category,lot_area,floor_area,bedroom,bathroom,parking,address,price");

		$html[] = "<h1 class=''>Comparative Analysis Table</h1>";

		$html[] = "<span class='text-muted d-block fs-12'>Shared By: </span>";
		$html[] = "<div class='bg-white p-2 border mb-3 mt-1'>";
			$html[] = "<div class='d-flex gap-3 lh-base flex-wrap'>";

				$html[] = "<span class='avatar ' style='background-image: url(".$data['account']['logo'].")'></span>";
				
				$html[] = "<div class=''>";
					$html[] = "<span class='d-block'>".$data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</span>";
					$html[] = "<span class='d-block text-muted fst-italic small'>".$data['account']['profession']."</span>";
				$html[] = "</div>";

				$html[] = "<div class=''>";
					$html[] = "<span class='d-block'><i class='ti ti-phone me-1 fs-14'></i>".$data['account']['mobile_number']."</span>";
					$html[] = "<span class='d-block'><i class='ti ti-mail me-1 fs-14'></i>".$data['account']['email']."</span>";
				$html[] = "</div>";


			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='card'>";
			$html[] = "<div class='table-responsive'>";
				$html[] = "<table class='table table-vcenter table-bordered card-table caption-top'>";
				$html[] = "<thead>";

					$html[] = "<tr>";
						$html[] = "<th class='text-center col-avatar'>Image</th>";
						$export['header'][] = "Image";
						foreach($columns as $col) {
							$html[] = "<th class='text-center col-$col'>".ucwords(str_replace("_"," ",$col))."</th>";
							$export['header'][] = ucwords(str_replace("_"," ",$col));
						}
					$html[] = "<tr>";
					
				$html[] = "</thead>";

				$html[] = "<tbody>";

					for($i=0; $i<count($data['listing']); $i++) {

						$export['rows'][$i][] = $data['listing'][$i]['thumb_img'];

						$html[] = "<tr>";
							$html[] = "<td class='text-center col-avatar'>";
								$html[] = "<div class='avatar avatar-xl' style='background-image: url(".$data['listing'][$i]['thumb_img'].")'></div>";
							$html[] = "</td>";

							foreach($columns as $col) {
								switch($col) {
									case 'address':

										$address = [];

										if(isset($data['listing'][$i]["address"]['street'])) {
											$address[] = $data['listing'][$i]["address"]['street'];
										}

										if(isset($data['listing'][$i]["address"]['village'])) {
											$address[] = $data['listing'][$i]["address"]['village'];
										}

										if(isset($data['listing'][$i]["address"]['barangay'])) {
											$address[] = $data['listing'][$i]["address"]['barangay'];
										}

										if(isset($data['listing'][$i]["address"]['municipality'])) {
											$address[] = $data['listing'][$i]["address"]['municipality'];
										}

										if(isset($data['listing'][$i]["address"]['province'])) {
											$address[] = $data['listing'][$i]["address"]['province'];
										}

										$export['rows'][$i][] = implode(" ", $address);
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data['listing'][$i]["address"]['municipality']." ".$data['listing'][$i]["address"]['province']."</td>";
										break;
									
									case 'price':
										$export['rows'][$i][] = $data['listing'][$i]['price'];
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>&#8369;".number_format($data['listing'][$i]['price'],0)."</td>";
										break;

									default:
										$export['rows'][$i][] = $data['listing'][$i][$col];
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data['listing'][$i][$col]."</td>";
								}
							}
						$html[] = "</tr>";
					}

				$html[] = "</tbody>";
				$html[] = "</table>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";