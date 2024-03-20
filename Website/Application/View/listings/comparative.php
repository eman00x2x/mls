<?php

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='response'>";
			$html[] = getMsg();
		$html[] = "</div>";

		$columns = explode(",","listing_id,offer,category,lot_area,floor_area,bedroom,bathroom,parking,address,price");

		$html[] = "<h1 class='d-none d-print-block'>MLS System - Comparative Analysis Table</h1>";
		$html[] = "<div class='card'>";
			$html[] = "<div class='table-responsive'>";
				$html[] = "<table class='table table-vcenter table-bordered card-table caption-top'>";
				$html[] = "<thead>";
					$html[] = "<tr>";
						$html[] = "<td class='text-center col-avatar' style='width:150px !important;'>Image</td>";
						for($i=0; $i<count($data); $i++) {
							$html[] = "<td class='text-center col-avatar'>";
								$html[] = "<div class='avatar avatar-xl' style='background-image: url(".$data[$i]['thumb_img'].")'></div>";
							$html[] = "</td>";
						}
					$html[] = "</tr>";
				$html[] = "</thead>";

				$html[] = "<tbody>";

					foreach($columns as $col) {
						$html[] = "<tr>";
							$html[] = "<td class='text-center col-$col'>".ucwords(str_replace("_"," ",$col))."</td>";

							for($x=0; $x<count($data); $x++) {
								
								switch($col) {
									case 'address':
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data[$x]["address"]['municipality']." ".$data[$x]["address"]['province']."</td>";
										break;
									
									case 'price':
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>&#8369;".number_format($data[$x]['price'],0)."</td>";
										break;

									default:
										$html[] = "<td class='text-center text-wrap col-$col' style='width:150px;'>".$data[$x][$col]."</td>";
								}

							}

						$html[] = "<tr>";
					}

				$html[] = "</tbody>";
				$html[] = "</table>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";