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

		$this->doc->setTitle("Properties Report");

		$this->listingPerCategoriesReport();

		$address = $this->getModel("Address");
		$address->selection = $address->addressSelection();

		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				$('.barangay-selection').hide();
			});

			$(document).on('change', '#region', function() {
				let val = $('#region option:selected').val();
				$.get('".url("ReportsController@listingPerProvince")."?loc='+val, function(data) {
					$('.location-continer').html(data);
				});
			});

			$(document).on('change', '#province', function() {
				let val = $('#province option:selected').val();
				$.get('".url("ReportsController@listingPerMunicipality")."?loc='+val, function(data) {
					$('.location-continer').html(data);
				});
			});

			$(document).on('change', '#municipality', function() {
				let val = $('#municipality option:selected').val();
				$.get('".url("ReportsController@listingPerBarangay")."?loc='+val, function(data) {
					$('.location-continer').html(data);
				});
			});

		");

		$this->setTemplate("reports/properties.php");
		return $this->getTemplate(null, $address);

	}

	function listingPerCategoriesReport($flag = "this_year") {

		$date_helper = \dateHelper($flag);

		$listing = $this->getModel("Listing");
		$listing->select(" category, COUNT(category) as total_listing ")
			->groupBy(" category ")
				#->where(" status = 1 AND created_at >= ".$date_helper['from']." AND created_at <= ".$date_helper['to']." ");
				->where(" status = 1  ");

		$listing->page['limit'] = 999999;

		$data = $listing->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$chart['labels'][] = $data[$i]['category'];
				$chart['series'][] = $data[$i]['total_listing'];
			}
		}

		$chart_data['labels'] = json_encode($chart['labels']);
		$chart_data['series'] = json_encode($chart['series']);

		$this->getLibrary("Charts")->getBarChart($chart_data, "getCategoriesChart_$flag", "Categories");
		
	}

	function listingPerRegion() {

		$listing = $this->getModel("Listing");
		$listing->select(" JSON_EXTRACT(address, '$.province') as province, COUNT(listing_id) as total_listing ")
			->groupBy(" province ")
				->where(" status = 1 AND JSON_EXTRACT(address, '$.region') = '".$_GET['loc']."' ");

		$listing->page['limit'] = 999999;

		$data = $listing->getList();

		$this->setTemplate("reports/listingPerRegion.php");
		return $this->getTemplate($data);
		
	}

	function listingPerProvince() {

		$listing = $this->getModel("Listing");
		$listing->select(" JSON_EXTRACT(address, '$.municipality') as municipality, COUNT(listing_id) as total_listing ")
			->groupBy(" municipality ")
				->where(" status = 1 AND JSON_EXTRACT(address, '$.province') = '".$_GET['loc']."' ");

		$listing->page['limit'] = 999999;

		$data = $listing->getList();

		$this->setTemplate("reports/listingPerProvince.php");
		return $this->getTemplate($data);
	}

	function listingPerMunicipality() {

		$listing = $this->getModel("Listing");
		$listing->select(" JSON_EXTRACT(address, '$.barangay') as barangay, COUNT(listing_id) as total_listing ")
			->groupBy(" barangay ")
				->where(" status = 1 AND JSON_EXTRACT(address, '$.municipality') = '".$_GET['loc']."' ");

		$listing->page['limit'] = 999999;

		$data = $listing->getList();
		
		$this->setTemplate("reports/listingPerMunicipality.php");
		return $this->getTemplate($data);
		
	}

	function listingPerBarangay() {

		$listing = $this->getModel("Listing");
		$listing->select(" JSON_EXTRACT(address, '$.barangay') as barangay, COUNT(listing_id) as total_listing ")
			->groupBy(" barangay ")
				->where(" status = 1 AND JSON_EXTRACT(address, '$.province') = '".$_GET['loc']."' ");

		$listing->page['limit'] = 999999;

		$data = $listing->getList();
		
		$this->setTemplate("reports/listingPerBarangay.php");
		return $this->getTemplate($data);
		
	}

} 
