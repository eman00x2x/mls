<?php

$html[] = "<div class='page-body bg-white' style='margin: 0;'>";
    $html[] = "<div class='container-xl'>";

		$html[] = "<div class=' px-2 fs-16'>";
			$html[] = "<div class='row'>";
				$html[] = "<div class='col-md-8 col-12'>";
				
					$html[] = "<div class='article py-4'>";
						
						$html[] = "<div class='d-flex flex-wrap justify-content-between'>";

							$html[] = "<div class=''>";
								$html[] = "<h1 class='mb-1'>".$data['title']."</h1>";
								$html[] = "<p class='m-0 p-0 fs-12 text-muted'><i class='ti ti-clock fs-14'></i> ".date("F d, Y", $data['created_at'])."</p>";
							$html[] = "</div>";

							$html[] = "<div class='share-buttons'>";
								$html[] = $data['share_buttons'];
							$html[] = "</div>";
						$html[] = "</div>";


						$html[] = "<div class='mt-4'>";
							$html[] = "<div class='avatar mb-3 w-100' style='height: 300px; background-image: url(".$data['banner'].")'></div>";
							$html[] = $data['content'];

							$html[] = "<div class='share-buttons'>";
								$html[] = $data['share_buttons'];
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
				$html[] = "<div class='col-md-4 col-12'>";

					$html[] = "<div class='mt-5'>";
						/*** ADS CONTAINER */
						$html[] = "<div class='d-none px-2 ARTICLE_VIEW_SIDEBAR'>";
							$html[] = "<a href='#' target='_blank' class='text-decoration-none'>";
								$html[] = "<div class='card bg-dark-lt mt-2 rounded-0  d-print-none banner-container d-flex align-items-center justify-content-center gap-2' style='height:280px;'>";
									$html[] = "<div class='loader'></div>";
									$html[] = "<p>Loading Ads</p>";
								$html[] = "</div>";
							$html[] = "</a>";
						$html[] = "</div>";
						/*** END ADS CONTAINER */
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";