<?php

if($data) {

	$html[] = "<div class='bg-red-lt'>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Subscription Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete ".$data['subscription']['name']." Subscription?</p>";
				
				$html[] = "<table class='table border-bottom-0'>";
				$html[] = "<tbody>";
				$html[] = "<tr>";
					$html[] = "<td class=' align-middle'>";
						$html[] = "<span class='small text-muted d-block'>Details</span> ".$data['subscription']['details'];
					$html[] = "</td>";
				$html[] = "</tr>";
				$html[] = "<tr>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Subscription Date</span> ".date("F d, Y",$data['subscription']['subscription_date'])."</td>";
				$html[] = "</tr>";
				$html[] = "<tr>";
					$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Subscription End</span> ".($data['subscription']['subscription_end_date'] == 0 ? "Permenant" : date("F d, Y",$data['subscription']['subscription_end_date']))."</td>";
				$html[] = "</tr>";
				$html[] = "</tbody>";
				$html[] = "</table>";

				$html[] = "<p>Subscription will be permanently removed in this account and this action is not reversible. <br/><br/> Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					
					$html[] = "<span data-url='".url("AccountSubscriptionController@delete",["id" => $data['subscription']['account_subscription_id']], ["delete" => true])."' data-row='row_subscription_".$data['subscription']['account_subscription_id']."' class='btn btn-outline-danger btn-continue-delete'><i class='ti ti-trash me-1'></i> Continue Delete</span>";
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