<?php

$html[] = "<div class='page-header border-bottom'>";
	$html[] = "<div class='row g-2 '>";
		$html[] = "<div class='col'>";
			$html[] = "<h1 class='page-title mb-3 text-blue'><i class='ti ti-layers-union me-3'></i> Premiums</h1>";
		$html[] = "</div>";
		$html[] = "<div class='col'>";
			$html[] = "<div class='page-options text-end'>";
				$html[] = "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
			$html[] = "</div>";
		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

if(!isset($_REQUEST['premium_id'])) {
	$html[] = "<div class='' style='max-height:500px; overflow-x:auto;'>";
		if($data['premiums']) {
			$html[] = "<div class='table-responsive'>";
				$html[] = "<table class='table'>";
				$html[] = "<thead>";
					$html[] = "<tr>";
						$html[] = "<th class='text-center'>#</th>";
						$html[] = "<th>Details</th>";
						$html[] = "<th class='text-end'>Amount</th>";
						$html[] = "<th></th>";
					$html[] = "</tr>";
				$html[] = "</thead>";
				$html[] = "<tbody>";
					$c=0;
					for($i=0; $i<count($data['premiums']); $i++) { $c++;
						$html[] = "<tr>";
							$html[] = "<td class='align-middle text-muted text-center'>$c</td>";
							$html[] = "<td class='align-middle' style='width:400px;'>".$data['premiums'][$i]['name']."<span class='text-muted small d-block'>".$data['premiums'][$i]['details']."</span></td>";
							$html[] = "<td class='align-middle text-end'>".number_format($data['premiums'][$i]['cost'],2)."</td>";
							$html[] = "<td class='align-middle text-end'><span class='btn btn-outline-success btn-subscription-select' data-id='".$data['premiums'][$i]['premium_id']."' data-url='".url("AccountsController@subscriptionSelectionNew",["id" => $data['account_id']],["premium_id" => $data['premiums'][$i]['premium_id']])."'><i class='ti ti-click me-2'></i> select</span></td>";
						$html[] = "</tr>";
					}
				$html[] = "</tbody>";
				$html[] = "</table>";
			$html[] = "</div>";
		}
	$html[] = "</div>";
}else {

	$html[] = "<div class='card mb-3'>";
		$html[] = "<div class='card-header'>";
			$html[] = "<h3 class='card-title'>".$data['premium']['name']."</h3>";
			$html[] = "<div class='card-actions'>";
				$html[] = "<span class='fw-bold text-success'>&#8369; ".number_format($data['premium']['cost'],2)."</span>";
			$html[] = "</div>";
		$html[] = "</div>";
		$html[] = "<div class='card-body'>";
			$html[] = "<p class='mb-0'>".$data['premium']['details']."</p>";
		$html[] = "</div>";
	$html[] = "</div>";

	$html[] = "<input type='hidden' name='save_url' id='save_url' value='".url("AccountSubscriptionController@saveNew")."' />";
	$html[] = "<form id='form'>";
		$html[] = "<input type='hidden' name='_method' id='_method' value='post' />";
		$html[] = "<input type='hidden' name='account_id' id='account_id' value='".$data['account_id']."' />";
		$html[] = "<input type='hidden' name='premium_id' id='premium_id' value='".$data['premium']['premium_id']."' />";
		$html[] = "<input type='hidden' name='subscription_date' id='subscription_date' value='".DATE_NOW."' />";
		$html[] = "<input type='hidden' name='duration' id='duration' value='".$data['premium']['duration']."' />";
		
		/** INVOICE */
		$html[] = "<input type='hidden' name='details' id='details' value='".$data['premium']['name']." - ".$data['premium']['details']."' />";
		$html[] = "<input type='hidden' name='payment_gateway' id='payment_gateway' value='Service' />";
		$html[] = "<input type='hidden' name='payment_gateway_fee' id='payment_gateway_fee' value='0.000' />";
		$html[] = "<input type='hidden' name='invoice_amount' id='invoice_amount' value='0.000' />";
		$html[] = "<input type='hidden' name='invoice_date' id='invoice_date' value='".DATE_NOW."' />";

		$html[] = "<div class='mb-3'>";
			$html[] = "<label class='form-label'>When will this subscription start?</label>";
			$html[] = "<input type='datetime-local' name='subscription_start_date' id='subscription_start_date' value='".DATE_NOW."' class='form-control' />";
		$html[] = "</div>";
	$html[] = "</form>";

	$html[] = "<div class='text-end'>";
		$html[] = "<span class='btn btn-outline-primary btn-save btn-save-subscription'><i class='ti ti-device-floppy me-1'></i> Subscribe to Premium</span>";
	$html[] = "</div>";

}