<?php

$html[] = "<div class=''>";
	$html[] = "<div class='offcanvas-header'>";
		$html[] = "<h2 class='offcanvas-title text-danger' id='offcanvasEndLabel'>Premium Deletion</h2>";
		$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
	$html[] = "</div>";

	$html[] = "<div class='offcanvas-body'>";
		$html[] = "<div class='response-body'>";

			$html[] = "<div class='text-center text-danger'>";
				$html[] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle text-danger icon-lg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>';
			$html[] = "</div>";

			$html[] = "<p class='text-center'>Are you sure you want to delete this ".$data['name']." premium?</p>";
			
			$html[] = "<table class='table border-bottom-0'>";
			$html[] = "<tbody>";
			$html[] = "<tr>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Name</span> ".$data['name']."</td>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Details</span> ".$data['details']."</td>";
				$html[] = "<td class=' align-middle'><span class='small text-muted d-block'>Date Created</span> ".date("F d, Y",$data['date_added'])."</td>";
			$html[] = "</tr>";
			$html[] = "</tbody>";
			$html[] = "</table>";

			$html[] = "<p>The premium will be permanently deleted, and this action cannot be reversed.. <br/><br/>All accounts subscribed to this premium will be removed.<br/><br/> Are you sure you wish to continue?</p>";
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