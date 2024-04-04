<?php

if($data) {

	$html[] = "<div class=''>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Listing Sold Settings</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete ".$data['title']." listing?</p>";
				
				$html[] = "<div class='d-flex gap-3 align-items-center flex-wrap'>";
					$html[] = "<div class='mb-2'>";
						$html[] = "<span class='avatar avatar-xxl' style='background-image: url(".$data['thumb_img'].")'></span>";
					$html[] = "</div>";

					$html[] = "<div class='mb-2'>";
						$html[] = "<span class='small text-muted d-block'>Name</span> ".$data['title']."";
					$html[] = "</div>";

					$html[] = "<div class='mb-4'>";
						$html[] = "<span class='small text-muted d-block'>Category</span> ".$data['category']."";
					$html[] = "</div>";

					$html[] = "<div class='mb-4'>";
						$html[] = "<span class='small text-muted d-block'>Date Posted</span> ".date("F d, Y",$data['created_at'])."";
					$html[] = "</div>";
				$html[] = "</div>";

				$html[] = "<input type='hidden' name='save_url' id='save_url' value='".url("ListingsController@setSold", ["id" => $data['listing_id']])."' />";
				$html[] = "<input type='hidden' name='status' id='status' value='2' />";
				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input type='hidden' name='csrf_token' value='".csrf_token()."' />";
					
					$html[] = "<div class='form-floating mb-3'>";
						$html[] = "<input type='number' name='sold_price' id='sold_price' value='".($data['sold_price'] >= 0 ? $data['sold_price'] : $data['price'])."' class='form-control' required />";
						$html[] = "<label for='sold_price'>Sold Price</label>";
					$html[] = "</div>";
				$html[] = "</form>";

			$html[] = "</div>";

			$html[] = "<div class='response'></div>";

			$html[] = "<p>Are you sure you want to mark this property as sold? Once marked, this property will be hidden and inaccessible.</p>";

			$html[] = "<div class='btn-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-row='row_listings_".$data['listing_id']."' class='btn btn-primary btn-save'><i class='ti ti-device-floppy me-1'></i> Mark Sold</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";

}else {
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='deletion-response'>".getMsg()."</div>";
			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Close</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
}