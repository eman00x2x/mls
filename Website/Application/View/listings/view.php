<?php

$html[] = "<div class='page-body'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class=''>";
			$html[] = "<div class='row justify-content-center'>";
				$html[] = "<div class='col-md-5 col-12'>";

					$html[] = "<div class=''>";
						$html[] = "<a data-fslightbox data-type='image' href='".$data['thumb_img']."'>";
							$html[] = "<div class='mb-2 img-responsive rounded border' style='position: relative; height: 300px; background-image: url(".$data['thumb_img'].")'>";
								$html[] = "<span style='position: absolute; top:-1px; left: -1px;' class='fw-bold bg-white text-dark p-2'><i class='ti ti-photo'></i> +".count($data['images'])."</span>";
							$html[] = "</div>";
						$html[] = "</a>";

						$html[] = "<div class=''>";
							if($data['images']) {
								$html[] = "<div class='d-flex gap-2 justify-content-center overflow-auto'>";
								for($i=0; $i<count($data['images']); $i++) {
									if($i <= 6) {
										if($data['thumb_img'] != $data['images'][$i]['url']) {
											$html[] = "<a data-fslightbox data-type='image' href='".$data['images'][$i]['url']."'>";
												$html[] = "<div class='avatar avatar-xl' style='position:relative; background-image: url(".$data['images'][$i]['url'].")'>";
													if($i == 6) {
														$html[] = "<div class='overlay' style='z-index: 1; position:absolute; background-color: rgba(0, 0, 0, 0.5); height: 100%; width: 100%;'></div>";
														$html[] = "<span class='text-white' style='z-index: 2;'>+".(count($data['images']) - 6)."</span>";
													}
												$html[] = "</div>";
											$html[] = "</a>";
										}
									}else {
										$html[] = "<a data-fslightbox data-type='image' class='d-none' href='".$data['images'][$i]['url']."'></a>";
									}
								}
								$html[] = "</div>";
							}
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";
				$html[] = "<div class='col-md-4 col-12'>";
					$html[] = "<h1>".$data['title']."</h1>";
					$html[] = "<p class='display-5 fw-bold text-green'>&#8369;".number_format($data['price'], 0)."</p>";

					$html[] = "<div class='d-flex gap-5'>";
						$html[] = "<div class='fs-24 fw-bold'><small class='fw-normal fs-12 d-block text-muted'> Lot Area:</small> ".$data['lot_area']."sqm</div>";
						$html[] = "<div class='fs-24 fw-bold'><small class='fw-normal fs-12 d-block text-muted'> Lot Area:</small> ".$data['floor_area']."sqm</div>";
					$html[] = "</div>";

				$html[] = "</div>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";

	$html[] = "<div class='bg-white pt-4 mt-3 border-top'>";
		$html[] = "<div class='container-xl'>";
			$html[] = "<pre>";
				ob_start();
				print_r($data);
				$content = ob_get_contents();
				ob_clean();

				$html[] = $content;
			$html[] = "</pre>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript' src='".CDN."js/fslightbox/fslightbox.js'></script>";