<?php

namespace Manage\Application\Controller;

class MlsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['account_id'];
	}
	
	function MLSIndex() {

        $this->doc->setTitle("MLS System");

		$handshake = $this->getModel("Handshake");
		$handshake->column['requestor_account_id'] = $_SESSION['account_id'];
		$handshake->select("GROUP_CONCAT(listing_id) as listing_ids")->and(" handshake_status IN('pending','active')");
		$handshakeListings = $handshake->getByRequestorAccountId();
		
		if($handshakeListings['listing_ids'] != "") {
			$filters[] = " listing_id NOT IN(".$handshakeListings['listing_ids'].")";
		}

		$filters[] = " account_id != ".$_SESSION['account_id'];
		$filters[] = " status = 1 ";

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		if(isset($_REQUEST['foreclosure'])) {
			$filters[] = " foreclosed = 1 ";
			$uri['foreclosure'] = 1;
		}

		if(isset($_REQUEST['offer'])) {
			$filters[] = " (offer LIKE '%".$_REQUEST['offer']."%')";
			$uri['offer'] = $_REQUEST['offer'];
		}

		if(isset($_REQUEST['type'])) {
			$filters[] = " (type LIKE '%".$_REQUEST['type']."%')";
			$uri['type'] = $_REQUEST['type'];
		}

		if(isset($_REQUEST['bedroom']) && $_REQUEST['bedroom'] != "") {
			$filters[] = " (bedroom = '".$_REQUEST['bedroom']."')";
			$uri['bedroom'] = $_REQUEST['bedroom'];
		}

		if(isset($_REQUEST['bathroom']) && $_REQUEST['bathroom'] != "") {
			$filters[] = " (bathroom = '".$_REQUEST['bathroom']."')";
			$uri['bathroom'] = $_REQUEST['bathroom'];
		}

		if(isset($_REQUEST['parking']) && $_REQUEST['parking'] != "") {
			$filters[] = " (parking = '".$_REQUEST['parking']."')";
			$uri['parking'] = $_REQUEST['parking'];
		}

		$listing = $this->getModel("Listing");
		$listing->addresses = $this->getModel("Address");
		$listing->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" last_modified DESC ");
		
		$listing->page['limit'] = 20;
		$listing->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listing->page['target'] = url("MlsController@index");
		$listing->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['listings'] = $listing->getList();

		if($data['listings']) {

			$account = $this->getModel("Account");

			for($i=0; $i<count($data['listings']); $i++) {
				
				$account->column['account_id'] = $data['listings'][$i]['account_id'];
				$data['listings'][$i]['account'] = $account->getById();

				unset($data['listings'][$i]['account_id']);

			}

		}

		$this->setTemplate("mls/list.php");
		return $this->getTemplate($data,$listing);

	}

	function handshakedIndex() {

		$this->doc->setTitle("MLS System");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$listing = $this->getModel("Listing");

		$handshake = $this->getModel("Handshake");
		$handshake->where(" requestor_account_id = ".$_SESSION['account_id']." OR requestee_account_id = ".$_SESSION['account_id'])->orderby(" FIELD(handshake_status,'pending','active','done','denied'), handshake_status_date DESC ");
		
		$handshake->page['limit'] = 20;
		$handshake->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$handshake->page['target'] = url("MlsController@index");
		$handshake->page['uri'] = (isset($uri) ? $uri : []);

		$data = $handshake->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$listing->column['listing_id'] = $data[$i]['listing_id'];
				$data[$i]['listing'] = $listing->getById();
			}
		}

		debug($data);

		$this->setTemplate("mls/handshaked.php");
		return $this->getTemplate($data,$listing);

	}

	function viewListing($id) {
		return parent::view($id);
	}

    function requestHandshake($listing_id) {

		$handshake = $this->getModel("Handshake");
		$handshake->column['requestor_account_id'] = $_SESSION['account_id'];
		$handshake->select("COUNT(listing_id) AS total_handshakes");
		$handshakeListings = $handshake->getByRequestorAccountId();

		if($handshakeListings['total_handshakes'] >= $_SESSION['privileges']['handshake_limit']) {
			$this->getLibrary("Factory")->setMsg("You have reached the limit of handshake request.","warning");
			$data = false;
		}else {

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $listing_id;
			$data = $listing->getById();
			
			if($data) {

				$account = $this->getModel("Account");
				$account->column['account_id'] = $data['account_id'];
				$data['account'] = $account->getById();

				if(isset($_REQUEST['confirm'])) {

					$account->column['account_id'] = $_SESSION['account_id'];
					$requestor = $account->getById();

					unset($requestor['account_type']);
					unset($requestor['uploads']);
					unset($requestor['preferences']);
					unset($requestor['privileges']);

					$handshake = $this->getModel("Handshake");
					$handshake->saveNew(array(
						"requestor_account_id" => $_SESSION['account_id'],
						"requestor_details" => json_encode($requestor, JSON_PRETTY_PRINT),
						"requestee_account_id" => $data['account_id'],
						"listing_id" => $data['listing_id'],
						"handshake_status" => "pending",
						"handshake_status_date" => DATE_NOW,
						"requested_date" => DATE_NOW
					));

					$this->getLibrary("Factory")->setMsg("Handshake Requested!","success");
					return json_encode(
						array(
							"status" => 1,
							"message" => getMsg()
						)
					);

				}

			}else {
				$this->getLibrary("Factory")->setMsg("Property listing not found.","warning");
			}

		}

		$this->setTemplate("mls/requestHandshake.php");
		return $this->getTemplate($data);

    }

	function acceptRequest($id) {

		$handshake = $this->getModel("Handshake");
		$handshake->save($id, array(
			"handshake_status" => "active",
			"handshake_status_date" => DATE_NOW
		));

		$this->getLibrary("Factory")->setMsg("Handshake Accepted!","success");
		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}

	function deniedRequest($id) {

		$handshake = $this->getModel("Handshake");
		$handshake->save($id, array(
			"handshake_status" => "active",
			"handshake_status_date" => DATE_NOW
		));

		$this->getLibrary("Factory")->setMsg("Handshake Accepted!","success");
		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}
	
	
}