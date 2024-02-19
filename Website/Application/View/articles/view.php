<?php

$html[] = "<div class='page-body'>";
    $html[] = "<div class='container-xl'>";

        $html[] = "<div class='row'>";

            $html[] = "<div class='col-md-8 col-12'>";
			
				$html[] = "<div class='article'>";
					$html[] = "<h1 class='mb-1'>".$data['title']."</h1>";
					$html[] = "<p class='m-0 p-0'><i class='ti ti-clock'></i> ".date("F d, Y", $data['created_at'])."</p>";

					$html[] = "<div class='mt-4'>";
						$html[] = "<div class='banner mb-3' style='background-image: url(".$data['banner'].")'></div>";
						$html[] = $data['content'];

						$html[] = "<div class='share-buttons'>";
							$html[] = "";
						$html[] = "</div>";

					$html[] = "</div>";
				$html[] = "</div>";

            $html[] = "</div>";

			$html[] = "<div class='col-md-4 col-12'>";
				
        	$html[] = "</div>";

        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";