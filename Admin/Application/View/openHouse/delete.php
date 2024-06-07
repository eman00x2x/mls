<?php

if($data) {

	$html[] = "<div class=''>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Open House Announcement Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";

				$html[] = "<div class='text-center text-danger'>";
					$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle text-danger icon-lg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>';
				$html[] = "</div>";
				
				$html[] = "<p>Are you sure do you want to delete this Open House Announcement?</p>";
				
				$html[] = "<div class='border mb-3 p-4 rounded'>";

					$html[] = "<div class='img-responsive img-responsive-21x9 card-img-top' style='background-image: url(".$data['attachment'].");'></div>";

					$html[] = "<h3 class='mb-0 mt-3'>".$data['subject']."</h3>";
					$html[] = "<p class='fs-12 '>".$data['listing_title']."</p>";
					$html[] = "<ul class='list-group list-group-flush'>";
						$html[] = "<li class='list-group-item p-2'><i class='ti ti-map-pin fs-14'></i> ".$data['content']['address']."</li>";
						if($data['content']['details'] != "") {
							$html[] = "<li class='list-group-item p-2'><i class='ti ti-file-info fs-14'></i> ".$data['content']['details']."</li>";
						}
						$html[] = "<li class='list-group-item p-2'><i class='ti ti-calendar fs-14'></i> ".date("d M Y h:iA", strtotime($data['content']['date']))."</li>";
					$html[] = "</ul>";
				$html[] = "</div>";

				$html[] = "<p>Open House Announcement will be permanently deleted this action is not reversible. <br/><br/> Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("OpenHouseAnnouncementsController@delete",["id" => $data['announcement_id']], ["delete" => "true"])."' data-row='row_open_house_".$data['announcement_id']."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
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