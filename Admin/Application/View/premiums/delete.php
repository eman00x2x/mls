<?php

$html[] = "<div class='bg-red-lt'>";
	$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Premium Deletion</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

	$html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";
			$html[] = "<p>Are you sure do you want to delete ".$data['name']." premium?</p>";
			
			$html[] = "<table class='table border-bottom-0'>";
			$html[] = "<tbody>";
			$html[] = "<tr>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Name</span> ".$data['name']."</td>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Details</span> ".$data['details']."</td>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Date Created</span> ".date("F d, Y",$data['date_added'])."</td>";
			$html[] = "</tr>";
			$html[] = "</tbody>";
			$html[] = "</table>";

			$html[] = "<p>Premium will be permanently deleted and this action is not reversible. <br/><br/>All Accounts subscribed to this premium will be removed.<br/><br/> Are you sure do you want to continue?</p>";
		$html[] = "</div>";

		$html[] = "<div class='deletion-response'></div>";

		$html[] = "<div class='btn-delete-controls'>";
			$html[] = "<div class='btn-list'>";
				$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
				$html[] = "<span data-url='".url("PremiumsController@delete",["id" => $data['premium_id']], ["delete" => "true"])."' data-url-proceed='".url("PremiumsController@index")."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
			$html[] = "</div>";
		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";