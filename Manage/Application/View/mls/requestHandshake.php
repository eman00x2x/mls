<?php

if($data) {
    $html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Request Handshake</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

    $html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";
            $html[] = "<table class='table'>";
                /* $html[] = "<tr>";
                    $html[] = "<td class='align-top text-center'><span class='avatar avatar-md' style='background-image: url(".$data['account']['logo'].")'></span></td>";
                    $html[] = "<td class='align-top'>";
                        $html[] = "<span class='d-block fw-bold'>".$data['account']['firstname']." ".$data['account']['lastname']."</span>";
                        $html[] = "<span class='d-block'>".$data['account']['email']."</span>";
                        $html[] = "<span class='d-block'>Registered since: ".date("F d, Y",$data['account']['registration_date'])."</span>";
                    $html[] = "</td>";
                $html[] = "</tr>"; */
                $html[] = "<tr>";
                    $html[] = "<td colspan='2'>";
                        /* $html[] = "<span class='d-block fw-bold'>Requesting Property Listing</span>"; */

                        $html[] = "<div class='my-2'>";
                            $html[] = "<span class='avatar avatar-xxl' style='background-image: url(".$data['thumb_img'].")'></span>";
                        $html[] = "</div>";
                        $html[] = "<span class='d-block mb-2'>".$data['title']."</span>";

                        $html[] = "<div class='d-flex flex-wrap'>";
							$html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fw-bold fs-20'><label class='text-start d-block text-muted small fs-10 fw-normal'>Price</label>&#8369;".number_format($data['price'],0)."</span>";
							if($data['floor_area'] > 0) {   $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Floor Area</label>".number_format($data['floor_area'],0)." sqm</span>"; }
							if($data['lot_area'] > 0) {     $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Lot Area</label>".number_format($data['lot_area'],0)." sqm</span>"; }
							if($data['bedroom'] > 0) {      $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bedroom</label>".$data['bedroom']."</span>"; }
							if($data['bathroom'] > 0) {     $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Bathroom</label>".$data['bathroom']."</span>"; }
							if($data['parking'] > 0) {      $html[] = "<span class='mb-2 d-block border me-2 p-2 text-center fs-16'><label class='text-start d-block text-muted fs-10'>Car Garage</label>".$data['parking']."</span>"; }
						$html[] = "</div>";

                    $html[] = "</td>";
                $html[] = "</tr>";
            $html[] = "</table>";

            $html[] = "<span class='btn btn-success btn-handshake-confirm' data-row='row_listings_".$data['listing_id']."' data-url='".url("MlsController@requestHandshake",["listing_id" => $data['listing_id']],["confirm" => true])."'><i class='ti ti-check me-2'></i> Confirm Request</span>";
        $html[] = "</div>";

        $html[] = "<div class='request-response'></div>";

    $html[] = "</div>";

}else {
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='request-response'>".getMsg()."</div>";
			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Close</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
}