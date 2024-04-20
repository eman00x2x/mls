<?php

$html[] = "<div class='page-header d-print-none'>";
    $html[] = "<div class='container-xl'>";
        $html[] = "<div class='px-2'>";
            $html[] = "<div class='row g-2 align-items-center'>";
                $html[] = "<div class='col'>";
                    $html[] = "<h2 class='page-title'>About</h2>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";
    $html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body mb-5'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='px-2'>";
            $html[] = "<div class='row row-cards'>";
                $html[] = "<div class='col-md-8'>";
                    $html[] = "<div class='card card-lg'>";
                        $html[] = "<div class='card-body'>";
                            $html[] = "<div class='markdown'>";
                                $html[] = $data['about'];
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";