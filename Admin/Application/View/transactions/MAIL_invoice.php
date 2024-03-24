<?php

$html[] = "<h1 style='margin-bottom: 2rem;' class='mb-5'>Invoice</h1>";

$html[] = "<div style='display: flex; gap: 0.5rem; justify-content: space-between !important;'>";

	$html[] = "<table style='width:100%;'>";
	$html[] = "<tr><td>";
		$html[] = "<p>";
			$html[] = "<div style='color:#667382; font-size: 12px;'>Account #".$data['account']['account_id']."</div>";
			$html[] = "<div style='display: block; font-weight: bold; font-size: 18px;'>".$data['account']['account_name']['prefix']." ".$data['account']['account_name']['firstname']." ".$data['account']['account_name']['middlename']." ".$data['account']['account_name']['lastname']." ".$data['account']['account_name']['suffix']."</div>";
			$html[] = "<div style='color:#667382;'>".$data['account']['email']."</div>";
		$html[] = "</p>";
	$html[] = "</td><td style='text-align:right;'>";
		$html[] = "<br/><p>";
			#$html[] = "<span class='d-block text-muted fs-11 text-end'>Transaction Date</span>";
			$html[] = "<div style='display: block;' class='d-block'>".date("F d, Y", $data['transaction']['created_at'])."</div>";
			$html[] = "<div style='display: block;'>Transaction #".$data['transaction']['transaction_id']."</div>";
		$html[] = "</p>";
	$html[] = "</td></tr>";
	$html[] = "</table>";
$html[] = "</div>";

if($data['transaction']['payment_source'] == "paypal") {
	$html[] = "<br/><div style='display: flex; gap: 0.5rem; justify-content: space-between !important;'>";
		$html[] = "<p>";
			$html[] = "<div style='color:#667382; font-size: 12px;' class='text-muted fs-11'>Payer</div>";
			$html[] = "<div style='display:block; font-weight:bold; font-size: 18px;'>".$data['transaction']['payer']['name']['given_name']." ".$data['transaction']['payer']['name']['surname']."</div>";
			$html[] = "<div style='color:#667382;'>".$data['transaction']['payer']['email_address']."</div>";
		$html[] = "</p>";
		$html[] = "<p>";
		$html[] = "</p>";
	$html[] = "</div>";
}


$html[] = "<br/><div style='color: #667382 !important; padding: 1.5rem !important; margin-bottom: 1rem !important; border:1px solid #e1e1e1; background-color:#f5f5f5;'>";
	$html[] = "<table style='width:100%; display: table; text-indent: initial; border-spacing: 2px; vertical-align: top; margin-bottom:0; border-color:#f5f5f5; overflow-x: auto; -webkit-overflow-scrolling: touch;'>";
	$html[] = "<thead style='border-color: inherit; border-style: solid; border-width: 0;'>";
		$html[] = "<tr>";
			$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align:center;'>Payment Source</th>";
			$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align:center;'>Transaction Id</th>";
			$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align:center;'>Payment Status</th>";
			$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align:center;'>Date</th>";
		$html[] = "</tr>";
	$html[] = "</thead>";
	$html[] = "<tr>";
		$html[] = "<td style='color: #182433 !important; text-align: center;'>".strtoupper($data['transaction']['payment_source'])."</td>";
		$html[] = "<td style='color: #182433 !important; text-align: center;'>".$data['transaction']['payment_transaction_id']."</td>";
		$html[] = "<td style='color: #182433 !important; text-align: center;'>".$data['transaction']['payment_status']."</td>";
		$html[] = "<td style='color: #182433 !important; text-align: center;'>".date("F d, Y g:i a",strtotime($data['transaction']['transaction_details']['create_time']))."</td>";
	$html[] = "</tr>";
	$html[] = "</table>";
$html[] = "</div><br/>";


$html[] = "<br/><table style='width:100%; display: table; text-indent: initial; border-spacing: 2px; vertical-align: top; margin-bottom:0; border-color:#04204524; overflow-x: auto; -webkit-overflow-scrolling: touch;'>";
$html[] = "<thead style='border-color: inherit; border-style: solid; border-width: 0;'>";
	$html[] = "<tr>";
		$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align: center;'></th>";
		$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align: left; width:300px;'>Product</th>";
		$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align: center;'>Duration</th>";
		$html[] = "<th style='font-size: .625rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; line-height: 1rem; color: #667382; padding-bottom: .5rem; white-space: nowrap; padding-top:0; text-align: right;'>Amount</th>";
	$html[] = "</tr>";
$html[] = "</thead>";

$html[] = "<tr>";
	$html[] = "<td style='color:#667382; text-align: center; '>1</td>";
	$html[] = "<td style='width:600px;'>".$data['transaction']['premium_description']."</td>";
	$html[] = "<td style='text-align: center; width: 10px;' class='text-center w-1'>".$data['transaction']['duration']." days</td>";
	$html[] = "<td style='text-align: right;'>&#8369;".number_format($data['transaction']['premium_price'],2)."</td>";
$html[] = "</tr>";
if(VAT) {
	$html[] = "<tr>";
		$html[] = "<td colspan='3' style='border-color: #182433; font-weight: bold; text-transform: uppercase; text-align: right; color: #667382;'>12% VAT</td>";
		$html[] = "<td style='border-color: #182433; text-align: right;'>&#8369;".number_format($data['vat'],2)."</td>";
	$html[] = "</tr>";
}
$html[] = "<tr>";
	$html[] = "<td colspan='3' style='color:#667382; text-align: right; text-transform: uppercase; font-weight: bold;' >Total</td>";
	$html[] = "<td style='text-align: right;'>&#8369;".number_format($data['total'],2)."</td>";
$html[] = "</tr>";
$html[] = "</table><br/>";
