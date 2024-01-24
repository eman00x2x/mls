<?php

if($data) {

	$html[] = "<div class='bg-red-lt'>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Listing Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete ".$data['title']." listing?</p>";
				
				$html[] = "<table class='table border-bottom-0'>";
				$html[] = "<tbody>";
				$html[] = "<tr>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Name</span> ".$data['title']."</td>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Category</span> ".$data['category']."</td>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Date Posted</span> ".date("F d, Y",$data['date_added'])."</td>";
				$html[] = "</tr>";
				$html[] = "</tbody>";
				$html[] = "</table>";

				$html[] = "<p>Listing will be permanently deleted and all of its images and files and this action is not reversible. <br/><br/> Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("ListingsController@delete",["id" => $data['listing_id']], ["delete" => "true"])."' data-row='row_listings_".$data['listing_id']."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
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