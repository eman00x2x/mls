<?php

namespace Admin\Application\Controller;

class ReportsController extends \Main\Controller {

    function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");

		if(!isset($this->session['permissions']['reports']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}
	}

    function transactionsReport() {

		$this->doc->setTitle("Transactions Report");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (local_board_name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$cur_year = date("Y", DATE_NOW);

		if(isset($_REQUEST['year'])) {
			$cur_year = $_GET['year'];
		}

		$filters[] = " FROM_UNIXTIME(created_at, '%Y') = '$cur_year' ";
		$uri['year'] = $cur_year;

		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$transactions = $this->getModel("Transaction");
		$transactions
		->select(" FROM_UNIXTIME(created_at, '%Y') as year, FROM_UNIXTIME(created_at, '%M %Y') as month, SUM(JSON_EXTRACT(transaction_details, '$.seller_receivable_breakdown.net_amount.value')) as net_earnings, SUM(JSON_EXTRACT(transaction_details, '$.seller_receivable_breakdown.gross_amount.value')) as gross_earnings, SUM(JSON_EXTRACT(transaction_details, '$.seller_receivable_breakdown.platform_fee.value')) as platform_fee ")
			->join(" ")
				->where(isset($clause) ? implode(" ",$clause) : null)
					->groupBy(" year, month ")
						->orderby(" year DESC, month ASC ");

		$transactions->page['limit'] = 20;
		$transactions->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$transactions->page['target'] = url("ReportsController@subscribersReport");
		$transactions->page['uri'] = (isset($uri) ? $uri : []);

		$result = $transactions->getList();

		$data = [];

		if($result) {
			for($i=0; $i<count($result); $i++) {
				$data[ $result[$i]['year'] ][ date("F", strtotime($result[$i]['month'])) ][ 'gross_earnings' ] = $result[$i]['gross_earnings'];
				$data[ $result[$i]['year'] ][ date("F", strtotime($result[$i]['month'])) ][ 'platform_fee' ] = $result[$i]['platform_fee'];
				
				$tax = 0;
				if(VAT) {
					$tax = ($result[$i]['gross_earnings'] / 1.12) * 0.12;
					$data[ $result[$i]['year'] ][ date("F", strtotime($result[$i]['month'])) ][ 'tax' ] = $tax;
				}else {
					$data[ $result[$i]['year'] ][ date("F", strtotime($result[$i]['month'])) ][ 'tax' ] = 0;
				}

				$data[ $result[$i]['year'] ][ date("F", strtotime($result[$i]['month'])) ][ 'net_earnings' ] = $result[$i]['gross_earnings'] - $result[$i]['platform_fee'] - $tax;
			}
		}

		$this->setTemplate("reports/transactions.php");
		return $this->getTemplate($data, $transactions);

	}

	function subscribersReport() {

		$this->doc->setTitle("Subscribers Report");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (local_board_name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}

		$subscription = $this->getModel("AccountSubscription");
		$subscription
		->select(" board_region, local_board_name, COUNT(local_board_name) as total, SUM(JSON_EXTRACT(transaction_details, '$.seller_receivable_breakdown.net_amount.value')) as net_earnings ")
			->join(" s JOIN #__accounts a ON a.account_id = s.account_id JOIN #__transactions t ON s.transaction_id = t.transaction_id")
				->where(isset($clause) ? implode(" ",$clause) : null)
					->groupBy(" local_board_name ")
						->orderby(" board_region ASC ");

		$subscription->page['limit'] = 20;
		$subscription->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$subscription->page['target'] = url("ReportsController@subscribersReport");
		$subscription->page['uri'] = (isset($uri) ? $uri : []);

		$result = $subscription->getList();

		if($result) {
			for($i=0; $i<count($result); $i++) {
				$data[ $result[$i]['board_region']['region'] ][$i]['board'] = $result[$i]['local_board_name'];
				$data[ $result[$i]['board_region']['region'] ][$i]['total'] = $result[$i]['total'];
				$data[ $result[$i]['board_region']['region'] ][$i]['net_earnings'] = $result[$i]['net_earnings'];
			}
		}

		$this->setTemplate("reports/subscribers.php");
		return $this->getTemplate($data, $subscription);

	}

	function propertiesReport() {
		
		unset($_SESSION['export']);

		$this->doc->setTitle("Properties Report");

		$this->listingPerCategoriesReport();
		$this->getPriceRange();
		$data['location'] = $this->getPerLocation();

		$address = $this->getModel("Address");
		$address->selection = $address->addressSelection(isset($_GET['address']) ? $_GET['address'] : null);

		$this->doc->addScriptDeclaration("

			$(document).ready(function() {
				$('.barangay-selection').hide();
			});

			$(document).on('click', '.btn-create-report', function() {

				formData = $('#create_report').serialize();
				window.location = '?' + formData;

			});

		");

		$_SESSION['export'] = array_merge(
			(isset($_SESSION['export']['category']) ? $_SESSION['export']['category'] : []),
			(isset($_SESSION['export']['price_range']) ? $_SESSION['export']['price_range'] : []),
			(isset($_SESSION['export']['location']) ? $_SESSION['export']['location'] : []),
		);

		$this->setTemplate("reports/properties.php");
		return $this->getTemplate($data, $address);

	}

	function listingPerCategoriesReport() {

		$flag = "this_year";
		$date_helper = \dateHelper($flag);

		if(isset($_GET['status']) && $_GET['status'] != "") {
			$filter[] = " status = '".$_GET['status']."' ";
		}else {
			$filter[] = " status = 1 ";
		}

		/* $filter[] = " created_at >= ".$date_helper['from']." ";
		$filter[] = " created_at <= ".$date_helper['to']." "; */

		if(isset($_GET['offer']) && $_GET['offer'] != "") {
			$filter[] = " offer = '".$_GET['offer']."' ";
		}

		if(isset($_GET['address']['region']) && $_GET['address']['region'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."' ";
		}

		if(isset($_GET['address']['province']) && $_GET['address']['province'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.province') = '".$_GET['address']['province']."' ";
		}

		if(isset($_GET['address']['municipality']) && $_GET['address']['municipality'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.municipality') = '".$_GET['address']['municipality']."' ";
		}

		$listing = $this->getModel("Listing");
		$listing->select(" category, COUNT(category) as total_listing ")
			->groupBy(" category ")
				->where( implode(" AND ", $filter) );

		$listing->page['limit'] = 999999;

		$data = $listing->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$chart['labels'][] = $data[$i]['category'];
				$chart['series'][] = $data[$i]['total_listing'];
			}

			$chart_data['labels'] = json_encode($chart['labels']);
			$chart_data['series'] = json_encode($chart['series']);

			$this->getLibrary("Charts")->getBarChart($chart_data, "getCategoriesChart_$flag", "Categories");

			if($data) {
				$export[] = "CATEGORY|TOTAL";
				for($i=0; $i<count($data); $i++) {
					$export[] = implode("|", $data[$i]);
				}
			}

			$export[] = null;
			$export[] = null;
			$_SESSION['export']['category'] = $export;

		}

	}

	function getPerLocation() {

		$flag = "this_year";
		$date_helper = \dateHelper($flag);

		if(isset($_GET['status']) && $_GET['status'] != "") {
			$filter[] = " status = '".$_GET['status']."' ";
		}else {
			$filter[] = " status = 1 ";
		}

		/* $filter[] = " created_at >= ".$date_helper['from']." ";
		$filter[] = " created_at <= ".$date_helper['to']." "; */

		$listing = $this->getModel("Listing");
		$listing->page['limit'] = 999999;

		if(isset($_GET['offer']) && $_GET['offer'] != "") {
			$filter[] = " offer = '".$_GET['offer']."' ";
		}

		$listing->select(" JSON_EXTRACT(address, '$.region') as region, COUNT(listing_id) as total_listing ");
		$listing->groupBy(" region ");
		$this->setTemplate("reports/listingPerRegion.php");

		$index = "REGION";

		if(isset($_GET['address'])) {
			if($_GET['address']['region'] != "" && $_GET['address']['province'] == "" && $_GET['address']['municipality'] == "") {

				$filter[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."' ";

				$listing->select(" JSON_EXTRACT(address, '$.province') as province, COUNT(listing_id) as total_listing ");
				$listing->groupBy(" province ");
				$this->setTemplate("reports/listingPerProvince.php");

				$index = "PROVINCE";
			}

			if($_GET['address']['region'] != "" && $_GET['address']['province'] != "" && $_GET['address']['municipality'] == "") {

				$filter[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."' ";
				$filter[] = " JSON_EXTRACT(address, '$.province') = '".$_GET['address']['province']."' ";

				$listing->select(" JSON_EXTRACT(address, '$.municipality') as municipality, COUNT(listing_id) as total_listing ");
				$listing->groupBy(" municipality ");
				$this->setTemplate("reports/listingPerMunicipality.php");

				$index = "MUNICIPALITY";
			}

			if($_GET['address']['region'] != "" && $_GET['address']['province'] != "" && $_GET['address']['municipality'] != "") {

				$filter[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."' ";
				$filter[] = " JSON_EXTRACT(address, '$.province') = '".$_GET['address']['province']."' ";
				$filter[] = " JSON_EXTRACT(address, '$.municipality') = '".$_GET['address']['municipality']."' ";

				$listing->select(" JSON_EXTRACT(address, '$.barangay') as barangay, COUNT(listing_id) as total_listing ");
				$listing->groupBy(" barangay ");
				$this->setTemplate("reports/listingPerBarangay.php");

				$index = "BARANGAY";
			}
		}

		$listing->where( implode(" AND ", $filter) );
		$data = $listing->getList();

		if($data) {
			$export[] = "$index|TOTAL";
			for($i=0; $i<count($data); $i++) {
				$export[] = implode("|", $data[$i]);
			}
		}

		$export[] = null;
		$export[] = null;
		$_SESSION['export']['location'] = $export;
		
		return $this->getTemplate($data);
		
	}

	function getPriceRange() {

		/* $date_helper = \dateHelper($flag); */

		
		/* $filter[] = " created_at >= ".$date_helper['from']." ";
		$filter[] = " created_at <= ".$date_helper['to']." "; */

		if(isset($_GET['status']) && $_GET['status'] != "") {
			$filter[] = " status = '".$_GET['status']."' ";
		}else {
			$filter[] = " status = 1 ";
		}

		if(isset($_GET['offer']) && $_GET['offer'] != "") {
			$filter[] = " offer = '".$_GET['offer']."' ";
		}

		if(isset($_GET['address']['region']) && $_GET['address']['region'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."' ";
		}

		if(isset($_GET['address']['province']) && $_GET['address']['province'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.province') = '".$_GET['address']['province']."' ";
		}

		if(isset($_GET['address']['municipality']) && $_GET['address']['municipality'] != "") {
			$filter[] = " JSON_EXTRACT(address, '$.municipality') = '".$_GET['address']['municipality']."' ";
		}

		$listing = $this->getModel("Listing");

		$listing->select("
			(CASE
				WHEN price < 3000000 then '0 - 3M'
				WHEN price > 3000000 and price <= 6000000 then '3M - 6M'
				WHEN price > 6000000 and price <= 10000000 then '6M - 10M'
				WHEN price > 10000000 and price <= 15000000 then '10M - 15M'
				WHEN price > 15000000 and price <= 25000000 then '15M - 25M'
				WHEN price > 25000000 and price <= 35000000 then '25M - 35M'
				WHEN price > 35000000 and price <= 45000000 then '35M - 45M'
				WHEN price > 45000000 and price <= 50000000 then '45M - 50M'
				WHEN price > 50000000 and price <= 80000000 then '50M - 80M'
				WHEN price > 80000000 and price <= 100000000 then '80M - 100M'
				WHEN price > 100000000 and price <= 120000000 then '100M - 120M'
				WHEN price > 12000000 and price <= 140000000 then '120M - 140M'
				WHEN price > 14000000 and price <= 160000000 then '140M - 160M'
				WHEN price > 16000000 and price <= 180000000 then '160M - 180M'
				WHEN price > 18000000 and price <= 200000000 then '180M - 200M'
				WHEN price > 20000000 and price <= 230000000 then '200M - 230M'
				WHEN price > 23000000 and price <= 260000000 then '230M - 260M'
				WHEN price > 26000000 and price <= 290000000 then '260M - 290M'
				WHEN price > 26000000 and price <= 290000000 then '260M - 290M'
				WHEN price > 29000000 and price <= 310000000 then '290M - 310M'
				WHEN price > 31000000 and price <= 350000000 then '310M - 350M'
				WHEN price > 35000000 then '350M - Above'
			END) p_range, COUNT(price) as total
		")
			->groupBy(" p_range ")
				->where( implode(" AND ", $filter) )
					->orderBy(" p_range ");

		$data = $listing->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$chart['labels'][] = $data[$i]['p_range'];
				$chart['series'][] = $data[$i]['total'];
			}

			$chart_data['labels'] = json_encode($chart['labels']);
			$chart_data['series'] = json_encode($chart['series']);

			$this->getLibrary("Charts")->getBarChart($chart_data, "getPriceRangeChart", "Price Range Chart");

			if($data) {
				$export[] = "PRICE RANGE|TOTAL";
				for($i=0; $i<count($data); $i++) {
					$export[] = implode("|", $data[$i]);
				}
			}

			$export[] = null;
			$export[] = null;
			$_SESSION['export']['price_range'] = $export;

		}

	}

} 
