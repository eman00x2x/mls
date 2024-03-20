<?php

$html[] = "<h3><i class='ti ti-building'></i> Related Properties</h3>";
$html[] = "<div class='row row-cards'>";
	$html[] = "<div class='space-y'>";

		if($model->listingRows) {

			$c = 0;
			for($i=0; $i<count($model->listingRows); $i++) { $c++;
				$html[] = $model->listingRows[$i];
			}

		}else {
			$html[] = "<p>No related properties</p>";
		}

	$html[] = "</div>";
$html[] = "</div>";
