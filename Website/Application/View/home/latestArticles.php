<?php

$html[] = "<h2>Articles</h2>";
$html[] = "<div class=''>";
	
	if($data['articles']) {
		$html[] = "<div class='row'>";
		for($i=0; $i<count($data['articles']); $i++) {
			$html[] = "<div class='col-lg-2 col-md-3 col-sm-12 '>";
				$html[] = "<div class='card mb-4' title='".$data['articles'][$i]['title']."'>";
					$html[] = "<div class='p-image img-responsive img-responsive-21x9 card-img-top' style='height:150px; background-image: url(".$data['articles'][$i]['banner'].");'></div>";
					$html[] = "<div class='card-body mb-0 pb-2'>";
						$html[] = "<div class='p-description' style='height:80px;'>";
							$html[] = "<h3 class='p-title card-title mb-1 fs-14' title='".$data['articles'][$i]['title']."'>".nicetrim($data['articles'][$i]['title'], 55)."</h3>";
							
						$html[] = "</div>";
					$html[] = "</div>";
					$html[] = "<div class='card-footer pt-0 mt-0 border-0'>";
						$html[] = "<a href='".url("ArticlesController@view", ["name" => $data['articles'][$i]['name']])."' class='btn btn-md btn-primary stretched-link w-100'>Read</a>";
					$html[] = "</div>";
				$html[] = "</div>";
			$html[] = "</div>";
		}
		$html[] = "</div>";
	}else {
		$html[] = "<p>No article posted.</p>";
	}
	
$html[] = "</div>";