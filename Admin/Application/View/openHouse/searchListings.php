<?php

$html[] = "<div class=''>";
	$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Attach Listing to Open House Announcement</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";
	$html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";
            
            $html[] = "<div class='table-responsive'>";
                $html[] = "<table class='table table-hover'>";
                $html[] = "<tr>";
                    $html[] = "<th>Listing Name</th>";
                $html[] = "</tr>";
                    if($data) {
                        for($i=0; $i<count($data); $i++) {
                            $html[] = "<tr>";
                                $html[] = "<td class='cursor-pointer selected' data-id='".$data[$i]['listing_id']."' data-title='".$data[$i]['title']."' data-thumb-image='".$data[$i]['thumb_img']."'>";
                                    $html[] = "<div class='d-flex lh-2 text-reset'>";
                                        $html[] = "<span class='avatar avatgar-sm flex-fill flex-grow-1' style='background-image: url(".$data[$i]['thumb_img'].")'></span>";
                                        $html[] = "<div class='ps-2'>".$data[$i]['title']."</div>";
                                    $html[] = "</div>";
                                $html[] = "</td>";
                            $html[] = "</tr>";
                        }
                    }
                $html[] = "</table>";
            $html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

