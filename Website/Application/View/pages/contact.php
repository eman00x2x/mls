<?php

$html[] = "<div class='page-header d-print-none'>";
    $html[] = "<div class='container-xl'>";
        $html[] = "<div class='row g-2 align-items-center'>";
            $html[] = "<div class='col'>";
                $html[] = "<h2 class='page-title'>Contact</h2>";
            $html[] = "</div>";
        $html[] = "</div>";
    $html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='page-body mb-5'>";
	$html[] = "<div class='container-xl'>";

        $html[] = "<div class='row row-cards'>";
            $html[] = "<div class='col-md-8'>";
                $html[] = "<div class='card card-lg'>";
                    $html[] = "<div class='card-body'>";
                        $html[] = "<div class='markdown'>";

                            $html[] = "<div class='avatar w-100 mb-4' style='height:250px; background-image: url(".CDN."images/website/contact-image.jpg)'></div>";

                            $html[] = "<p>".$data['contact_info']['contact_page_text']."</p>";

                            $html[] = "<div class='mb-3'>";
                                $html[] = "<span><i class='ti ti-phone fs-14'></i> Contact Number</span>";
                                $html[] = "<p>".$data['contact_info']['mobile_number']."</p>";
                            $html[] = "</div>";

                            $html[] = "<div class='mb-3'>";
                                $html[] = "<span><i class='ti ti-address-book fs-14'></i> Office Address</span>";
                                $html[] = "<p>".$data['contact_info']['office_address']."</p>";
                            $html[] = "</div>";

                            $html[] = "<div class='mb-3'>";
                                $html[] = "<span><i class='ti ti-mail fs-14'></i> Email Address</span>";
                                $html[] = "<p>".$data['contact_info']['email']."</p>";
                            $html[] = "</div>";

                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";