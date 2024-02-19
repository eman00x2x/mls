<?php

$html[] = "<div class='page-body'>";
    $html[] = "<div class='container-xl'>";

       
			$html[] = "<h2>Articles</h2>";
			$html[] = "<div class='row row-deck row-cards'>";
				if($data['articles']) {
					for($i=0; $i<count($data['articles']); $i++) {
						$html[] = "<div class='col-md-3 col-auto '>";
							$html[] = "<div class='card property-container' title='".$data['articles'][$i]['title']."'>";
								$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data['articles'][$i]['banner'].");'></div>";
								$html[] = "<div class='card-body mb-0 pb-2'>";
									$html[] = "<div class='p-description' style='height:130px;'>";
										$html[] = "<h3 class='p-title card-title mb-1' title=''>".nicetrim($data['articles'][$i]['title'], 55)."</h3>";
										$html[] = "<div class='p-tech-details'>";
											$html[] = "<p>".nicetrim(strip_tags($data['articles'][$i]['content']),100)."</p>";
										$html[] = "</div>";
									$html[] = "</div>";
								$html[] = "</div>";
								$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
									$html[] = "<a href='".url("ArticlesController@view", ["name" => $data['articles'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>Read</a>";
								$html[] = "</div>";
							$html[] = "</div>";
						$html[] = "</div>";
					}
				}
			$html[] = "</div>";
		

        if(!empty($model)) {
			$html[] = $model->pagination;
		}

    $html[] = "</div>";
$html[] = "</div>";