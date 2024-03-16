<?php

$html[] = "<div class='page-header d-print-none'>";
    $html[] = "<div class='container-xl'>";
        $html[] = "<div class='row g-2 align-items-center'>";
            $html[] = "<div class='col'>";
                $html[] = "<h2 class='page-title'>Data Privacy</h2>";
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
                            $html[] = $data['data_privacy'];

                            $html[] = "<h3>Contact Us</h3>";
                            $html[] = "<p>For any comment, question or complaint regarding this Privacy Policy, you may contact our Data Protection Officer at:</p>";
                            $html[] = "<table>";
                            $html[] = "<tbody>";
                            $html[] = "<tr>";
                                $html[] = "<td>Postal Address:</td>";
                                $html[] = "<td>".CONFIG['contact_info']['office_address']."</td>";
                            $html[] = "</tr>";
                            $html[] = "<tr>";
                                $html[] = "<td>Mobile Number:</td>";
                                $html[] = "<td>".CONFIG['contact_info']['mobile_number']."</td>";
                            $html[] = "</tr>";
                            $html[] = "<tr>";
                                $html[] = "<td>Email Address:</td>";
                                $html[] = "<td>".CONFIG['contact_info']['email']."</td>";
                            $html[] = "</tr>";
                            $html[] = "</tbody>";
                            $html[] = "</table>";
                            
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";
            $html[] = "</div>";
        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";