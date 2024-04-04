<?php

if($data) {

	if($data['featured'] == 1) {
		$featured = " <b>unset this listing to featured</b> ";
		$is_featured = 0;
	}else {
		$featured = " <b>set this listing to featured</b> ";
		$is_featured = 1;
	}

	$html[] = "<div class=''>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Featured Listing Settings</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";

				$html[] = "<p>Are you sure do you want to $featured?</p>";
				
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

				$html[] = "<p>Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='featured-response'></div>";

			$html[] = "<div class='btn-featured-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("ListingsController@setFeatured",["id" => $data['listing_id']], ["is_featured" =>  $is_featured])."' data-row='row_listings_".$data['listing_id']."' class='btn btn-primary btn-continue-featured'><i class='ti ti-rubber-stamp me-2'></i> Continue &nbsp; $featured</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";

}else {
	$html[] = "<div class='page-body'>";
		$html[] = "<div class='container-xl'>";

			$html[] = "<div class='featured-response'>".getMsg()."</div>";
			$html[] = "<div class='btn-featured-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Close</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
}