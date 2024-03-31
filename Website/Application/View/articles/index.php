<?php

$html[] = "<div class='page-body'>";
    $html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2'>";
			$html[] = "<div class='col-lg-9 col-md-8 col-sm-12 col-12'>";

				if($data['articles']) {
					$html[] = "<div class='px-2'>";
						$html[] = "<h2>Articles</h2>";
						$html[] = "<div class='row'>";
						
							for($i=0; $i<count($data['articles']); $i++) {
								$html[] = "<div class='col-lg-3 col-md-6 col-sm-12 col-12'>";
									$html[] = "<div class='card mb-3' title='".$data['articles'][$i]['title']."'>";
										$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='height:150px; background-image: url(".$data['articles'][$i]['banner'].");'></div>";
										$html[] = "<div class='card-body mb-0 pb-2'>";
											$html[] = "<div class='p-description' style='height:70px;'>";
												$html[] = "<h3 class='p-title card-title mb-1' title='".$data['articles'][$i]['title']."'>".nicetrim($data['articles'][$i]['title'], 55)."</h3>";
												
											$html[] = "</div>";
										$html[] = "</div>";
										$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
											$html[] = "<a href='".url("ArticlesController@view", ["name" => $data['articles'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>Read</a>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
							}
						
						$html[] = "</div>";
					$html[] = "</div>";
					
					if(!empty($model)) {
						$html[] = $model->pagination;
					}
				}else {
					$html[] = "<div class=''>";
                        $html[] = "<div class='empty'>";
                            $html[] = "<div class='empty-image mb-4'>";
                                $html[] = "<img src='".CDN."images/undraw_quitting_time_dm8t.svg' height='128' />";
                            $html[] = "</div>";
                            $html[] = "<p class='empty-title'>No results found</p>";
                            $html[] = "<p class='empty-subtitle text-secondary'>Try adjusting your search or filter to find what you're looking for.</p>";
                        $html[] = "</div>";
                    $html[] = "</div>";
				}
			
			$html[] = "</div>";
			$html[] = "<div class='col-lg-3 col-md-4 col-sm-12 col-12'>";
				$html[] = "<div class='d-none d-md-block'>";

					$html[] = "<div class='card'>";
						$html[] = "<div class='card-body'>";
							$html[] = "<div class=''>";
								$html[] = "<h3 class='card-title'>Categories</h3>";
								$html[] = "<div class='list-group list-group-flush'>";
									if($data['categories']) {
										for($i=0; $i<count($data['categories']); $i++) {
											$html[] = "<a class='list-group-item d-flex justify-content-between text-decoration-none' href='".url("ArticlesController@index", null, ["category" => $data['categories'][$i]['category']])."'>";
												$html[] = "<span>".$data['categories'][$i]['category']."</span>";
												$html[] = "<span class='badge bg-cyan text-cyan-fg ms-2'>".$data['categories'][$i]['total_category']."</span>";
											$html[] = "</a>";
										}
									}
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</div>";

				/*** ADS CONTAINER */
				$html[] = "<div class='d-none px-2 ARTICLE_LIST_SIDEBAR'>";
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