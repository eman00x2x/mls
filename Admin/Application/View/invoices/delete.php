<?php

if($data) {

	$html[] = "<div class='bg-red-lt'>";
		$html[] = "<div class='offcanvas-header'>";
			$html[] = "<h2 class='offcanvas-title' id='offcanvasEndLabel'>Invoice Deletion</h2>";
			$html[] = "<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
		$html[] = "</div>";

		$html[] = "<div class='offcanvas-body'>";
			$html[] = "<div class='response-body'>";
				$html[] = "<p>Are you sure do you want to delete this invoice?</p>";
				
				$html[] = "<table class='table border-bottom-0'>";
				$html[] = "<tr>";
					$html[] = "<th>Particulars</th>";
					$html[] = "<th class='text-end'>Amount</th>";
				$html[] = "</tr>";
				$html[] = "<tr>";
					$html[] = "<td>".$data['invoice']['details']."</td>";
					$html[] = "<td class='text-end'>".number_format($data['invoice']['invoice_amount'],2)."</td>";
				$html[] = "</tr>";
				$html[] = "<tr>";
					$html[] = "<th>Invoice Date</th>";
					$html[] = "<th class='text-end'>".date("F d, Y",$data['invoice']['invoice_date'])."</th>";
				$html[] = "</tr>";
				$html[] = "</table>";

				$html[] = "<p>Invoice will be permanently deleted and this action is not reversible. <br/><br/> Are you sure do you want to continue?</p>";
			$html[] = "</div>";

			$html[] = "<div class='deletion-response'></div>";

			$html[] = "<div class='btn-delete-controls'>";
				$html[] = "<div class='btn-list'>";
					$html[] = "<span class='btn text-dark bg-transparent' data-bs-dismiss='offcanvas'><i class='ti ti-x me-2'></i> Cancel</span>";
					$html[] = "<span data-url='".url("InvoicesController@delete",["id" => $data['invoice']['invoice_id']], ["delete" => true])."' data-row='row_invoice_".$data['invoice']['invoice_id']."' class='btn btn-danger btn-continue-delete'><i class='ti ti-trash me-2'></i> Continue Deletion</span>";
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