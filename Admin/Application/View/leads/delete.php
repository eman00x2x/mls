<?php

if($data) {

	$html[] = "<div class='bg-red-lt'>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Lead Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete selected lead?</p>";
				
				$html[] = "<table class='table border-bottom-0'>";
				$html[] = "<tbody>";
				$html[] = "<tr><td class=' align-middle'><span class='small text-muted d-block'>Name</span> ".$data['name']."</tr></td>";
				$html[] = "<tr><td class=' align-middle'><span class='small text-muted d-block'>Mobile No</span> ".$data['mobile_no']."</tr></td>";
				$html[] = "<tr><td class=' align-middle'><span class='small text-muted d-block'>Email</span> ".$data['email']."</tr></td>";
				$html[] = "<tr><td class=' align-middle'><span class='small text-muted d-block'>Inquire At</span> ".date("M d, Y",$data['inquire_at'])."</tr></td>";
				$html[] = "</tbody>";
				$html[] = "</table>";
				
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("LeadsController@delete",["id" => $data['lead_id']], ["delete" => "true"])."' data-row='row_leads_".$data['lead_id']."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
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