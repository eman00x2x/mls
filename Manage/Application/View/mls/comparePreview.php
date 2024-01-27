<?php

$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Compare Table List</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

    $html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";

            $html[] = "<ul class='list-group mb-3'>";
                if($data['listings']) {
                    foreach($data['listings'] as $key => $title) {
                        $html[] = "<li class='list-group-item'>".$title."</li>";
                    }
                }
            $html[] = "</ul>";

            $html[] = "<div class='text-center'>";
                $html[] = "<p>Total listings (<b>".$data['count']."</b>)</p>";
                $html[] = "<a href='".url("MlsController@compareListings")."' class='btn btn-primary'><i class='ti ti-layers-difference me-2'></i> Compare Now</a>";
            $html[] = "</div>";
        
        $html[] = "</div>";
    $html[] = "</div>";
$html[] = "</div>";