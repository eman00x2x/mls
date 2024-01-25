<?php

$html[] = "<div class='page-header d-print-none text-white'>";
	$html[] = "<div class='container-xl'>";

		$html[] = "<div class='row g-2 '>";
			$html[] = "<div class='col'>";
				$html[] = "<div class='page-pretitle'></div>";
				$html[] = "<h1 class='page-title'><i class='ti ti-building-estate me-2'></i> MLS System</h1>";
			$html[] = "</div>";

			$html[] = "<div class='col-auto ms-auto d-print-none'>";
				$html[] = "<div class='d-none d-sm-inline'>";
					$html[] = "<div class='btn-list'>";
						
						$html[] = "<a class='ajax btn btn-dark' href=''><i class='ti ti-user-plus me-2'></i> Handshaked</a>";
						$html[] = "<span class='btn btn-dark filter-btn' href=''><i class='ti ti-filter me-2'></i> Filter Result</span>";
						
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

		$html[] = "<div class='row'>";

            $html[] = "<div class='col-md-3 col-12'>";
                $html[] = "<div class='box-container mb-3'>";
                    $html[] = "<h3 class=''>Broker Details</h3>";
                    $html[] = "<div class='avatar avatar-lg' style='background-image: url(".$data['account']['logo'].")'></div>";

                    $html[] = "<table class='table'>";
                    $html[] = "<tr>";
                        $html[] = "<td>Name</td>";
                        $html[] = "<td>".$data['account']['firstname']." ".$data['account']['lastname']."</td>";
                    $html[] = "</tr>";
					$html[] = "<tr>";
                        $html[] = "<td>Registration Date</td>";
                        $html[] = "<td>".date("F d, Y",$data['account']['registration_date'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";


                    $status[1] = "Available";
                    $status[2] = "Sold";

                    $html[] = "<h3 class='mt-3 mb-0'>Posting Details</h3>";
                    $html[] = "<table class='table'>";
                    $html[] = "<tr>";
                        $html[] = "<td>Status</td>";
                        $html[] = "<td>".$status[$data['listing']['status']]."</td>";
                    $html[] = "</tr>";
                    $html[] = "<tr>";
                        $html[] = "<td>Last Modified</td>";
                        $html[] = "<td>".date("F d, Y",$data['listing']['last_modified'])."</td>";
                    $html[] = "</tr>";
                    $html[] = "</table>";

					$html[] = "<div class='text-center'>";
						$html[] = "<div class='btn-list'>";
							$html[] = "<span class='btn btn-sm btn-primary'>Request Handshake</span>";
							$html[] = "<span class='btn btn-sm btn-danger'><i class='ti ti-x'></i> Cancel Request</span>";
						$html[] = "</div>";
	                $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

			$html[] = "<div class='col-md-9 col-12'>";
                $html[] = "<div class='box-container mb-3'>";

                    $html[] = "<h3>".$data['listing']['title']." <small class='d-block fw-normal'>".ucwords($data['listing']['offer'])." ".$data['listing']['category']." in ".$data['listing']['address']['municipality'].", ".$data['listing']['address']['province']."</small></h3>";

                    $html[] = "<div class='mb-3'>";
                        $html[] = "<div class='d-flex'>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Floor Area</label>".number_format($data['listing']['floor_area'],0)." sqm</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Lot Area</label>".number_format($data['listing']['lot_area'],0)." sqm</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Unit Area</label>".number_format($data['listing']['unit_area'],0)." sqm</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Bedroom</label>".$data['listing']['bedroom']."</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Bathroom</label>".$data['listing']['bathroom']."</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Car Garage</label>".$data['listing']['parking']."</span>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<h3 class='mb-0'>Amenities</h3>";
                    $html[] = str_replace(",",", ", ucwords($data['listing']['amenities']));

                    $html[] = "<h3 class='mt-3 mb-2'>Pricing</h3>";
                    $html[] = "<div class='mb-3'>";
                        $html[] = "<div class='d-flex'>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Price</label>".number_format($data['listing']['price'],0)."</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Reservation</label>".number_format($data['listing']['reservation'],0)."</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Monthly Down Payment</label>".number_format($data['listing']['monthly_downpayment'],0)."</span>";
                            $html[] = "<span class='d-block border me-2 p-2 text-center'><label class='d-block text-muted small'>Monthly Amortization</label>".number_format($data['listing']['monthly_amortization'],0)."</span>";
                        $html[] = "</div>";
                    $html[] = "</div>";

                    $html[] = "<h3 class='mt-3 mb-2'><i class='ti ti-tag'></i> Tags</h3>";
                    $html[] = implode(", ",$data['listing']['tags']);

                    $html[] = "<h3 class='mt-3 mb-2'><i class='ti ti-edit'></i> Description</h3>";
                    $html[] = "<div class='mt-2'>";
                        $html[] = $data['listing']['long_desc'];
                    $html[] = "</div>";

                $html[] = "</div>";
            $html[] = "</div>";

        $html[] = "</div>";

    $html[] = "</div>";
$html[] = "</div>";