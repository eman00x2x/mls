<?php

$html[] = "<div class='pb-5 my-5'>";

	$html[] = "<div class='text-center pb-3'>";
		$html[] = "<h2 class='mb-0 display-5 text-highlight'>Insightful Articles</h2>";
		$html[] = "<p>Navigating Real Estate with Informed Knowledge</p>";
	$html[] = "</div>";

	$html[] = "<div class='mt-3'>";
		
		if($data['articles']) {
			$html[] = "<div class='row'>";
			for($i=0; $i<count($data['articles']); $i++) {
				$html[] = "<div class='col-lg-3 col-md-3 col-sm-12 '>";
					$html[] = "<div class='card mb-4' title='".$data['articles'][$i]['title']."'>";
						$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top bg-highlight' style='height:150px; background-image: url(".$data['articles'][$i]['banner'].");'></div>";
						$html[] = "<div class='card-body mb-0 pb-2'>";
							$html[] = "<div class='p-description' style='height:80px;'>";
								$html[] = "<h3 class='p-title card-title mb-1 fs-14' title='".$data['articles'][$i]['title']."'>".nicetrim($data['articles'][$i]['title'], 55)."</h3>";
								$html[] = "<p class='fs-12'>".nicetrim(strip_tags($data['articles'][$i]['content']), 100)."</p>";
							$html[] = "</div>";
						$html[] = "</div>";
						$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
							$html[] = "<a href='".url("ArticlesController@view", ["name" => $data['articles'][$i]['name']])."' class='stretched-link w-100'></a>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";
			}
			$html[] = "</div>";
		}else {
			$html[] = "<p>No article posted.</p>";
		}

		$html[] = "<div class='text-center mt-4'>";
			$html[] = "<a href='".url("ArticlesController@index")."' class='btn btn-primary'>View all articles</a>";
		$html[] = "</div>";
		
	$html[] = "</div>";
$html[] = "</div>";