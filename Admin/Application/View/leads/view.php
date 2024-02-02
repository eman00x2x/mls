<?php

$html[] = "<div class='row justify-content-center'>";
	$html[] = "<div class='col-md-6 col-12'>";

        $html[] = "<div class='page-header d-print-none text-white'>";
            $html[] = "<div class='container-xl'>";

                $html[] = "<div class='row g-2 '>";
                    $html[] = "<div class='col'>";
                        $html[] = "<div class='page-pretitle'>Inquiries from website</div>";
                        $html[] = "<h1 class='page-title'><i class='ti ti-users me-2'></i> Leads</h1>";
                    $html[] = "</div>";

                    $html[] = "<div class='col-auto ms-auto d-print-none'>";
                        $html[] = "<div class='d-none d-sm-inline'>";
                            $html[] = "<div class='btn-list'>";
                                
                            $html[] = "</div>";
                        $html[] = "</div>";
                    $html[] = "</div>";
                $html[] = "</div>";

            $html[] = "</div>";
        $html[] = "</div>";

        $html[] = "<div class='page-body'>";
            $html[] = "<div class='container-xl'>";

                $html[] = "<div class='response'>";
                    $html[] = getMsg();
                $html[] = "</div>";

                $html[] = "<div class='box-container mb-3'>";

                    $html[] = "<table class='table'>";
                    $html[] = "<tr>";
                        $html[] = "<td class='w-20'>Name</td>";
                        $html[] = "<td>".$data['name']."</td>";
                    $html[] = "</tr>";
					$html[] = "<tr>";
					    $html[] = "<td>Mobile Number</td>";
					    $html[] = "<td>".$data['mobile_no']."</td>";
					$html[] = "</tr>";
					$html[] = "<tr>";
					    $html[] = "<td>Email</td>";
					    $html[] = "<td>".$data['email']."</td>";
					$html[] = "</tr>";
					$html[] = "<tr>";
					    $html[] = "<td>Message</td>";
					    $html[] = "<td>".$data['message']."</td>";
					$html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>Inquire At</td>";
                        $html[] = "<td>".date("M d, Y g:ia",$data['inquire_at'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

					$html[] = "<div class='listing_wrap my-5'>";

						$html[] = "<h3>Subject Listing</h3>";

						$html[] = "<div class='d-flex'>";
							$html[] = "<div class=''>";
								$html[] = "<span class='avatar avatar-xl' style='background-image: url(".$data['listing']['thumb_img'].")'></span>";
							$html[] = "</div>";
							$html[] = "<div class='ps-2'>";
								$html[] = "<span class='d-block'>".$data['listing']['title']."</span>";
								$html[] = "<span class='d-block'>".$data['listing']['category']."</span>";
								$html[] = "<span class='d-block'>".$data['listing']['address']['municipality']." ".$data['listing']['address']['province']."</span>";
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";