<?php

if($data) {

	$html[] = "<div class='bg-red-lt'>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Account Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete ".$data['firstname']." ".$data['lastname']." account?</p>";
				
				$html[] = "<table class='table border-bottom-0'>";
				$html[] = "<tbody>";
				$html[] = "<tr>";
					$html[] = "<td class='w-1 align-middle'>";
						if($data['logo'] != "") {$html[] = "<span class='avatar avatar-sm' style='background-image: url(".$data['logo'].")'></span>";
						}else {$html[] = "<span class='avatar avatar-sm' style='background-image: url(".CDN."images/blank-profile.png)'></span>"; }
					$html[] = "</td>";
				
					$html[] = "<td class=' align-middle'>";
						$html[] = "<span class='small text-muted d-block'>Account Name</span> ".$data['firstname']." ".$data['lastname'];
					$html[] = "</td>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Registration Date</span> ".date("F d, Y",$data['registration_date'])."</td>";
				$html[] = "</tr>";
				$html[] = "</tbody>";
				$html[] = "</table>";

				$html[] = "<p>All data related to this account will be permanently deleted and this action is not reversible. <br/><br/> Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("AccountsController@delete",["id" => $data['account_id']], ["delete" => "true"])."' data-url-proceed='".url("AccountsController@index")."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
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