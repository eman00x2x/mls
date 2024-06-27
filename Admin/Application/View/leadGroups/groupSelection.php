<?php

$html[] = "<div class=''>";
	$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Lead Group Selection</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

	$html[] = "<div class='offcanvas-body'>";

		$html[] = "<div class='mb-3'>";
			$html[] = "<div class='input-group mb-2'>";
				$html[] = "<input type='text' id='searchgroup' value='' class='form-control' />";
				$html[] = "<span class='btn btn-searchgroup'>Search</span>";
			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='response-body'>";

			$html[] = "<table class='table table-hover'>";
			$html[] = "<tr>";
				$html[] = "<td>Ungrouped</td>";
				$html[] = "<td>";
					$html[] = "<span class='btn btn-sm btn-success btn-selected' data-id='0' data-name='Ungrouped'>Select</span>";
				$html[] = "</td>";
			$html[] = "</tr>";
				if($data) {
					for($i=0; $i<count($data); $i++) {
						$html[] = "<tr>";
							$html[] = "<td>".$data[$i]['name']."</td>";
							$html[] = "<td>";
								$html[] = "<span class='btn btn-sm btn-success btn-selected' data-id='".$data[$i]['lead_group_id']."' data-name='".$data[$i]['name']."'>Select</span>";
							$html[] = "</td>";
						$html[] = "</tr>";
					}
					
				}
			$html[] = "</table>";

        $html[] = "</div>";
    $html[] = "</div>";
$html[] = "</div>";