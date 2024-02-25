<?php

namespace Website\Application\Controller;

use Library\Encrypt;

class ListingsController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function buy() { return $this->index(); }
	function rent() { return $this->index(); }

	function index() {

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		if(url()->contains("/buy")) {
			$filters[] = " offer = 'for sale'";
		}

		if(url()->contains("/rent")) {
			$filters[] = " offer = 'for rent'";
		}

		$listings = $this->getModel("Listing");
		$listings->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" last_modified DESC ");

		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listings->page['target'] = url("ListingsController@index");
		$listings->page['uri'] = (isset($uri) ? $uri : []);

		$data = $listings->getList();
		
		$this->setTemplate("listings/index.php");
		return $this->getTemplate($data,$listings);

	}

	function view($name) {

		$listing = $this->getModel("Listing");
		$listing->column['name'] = $name;
		$data = $listing->getByName();

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['thumb_img']);
		$this->doc->setFacebookMetaData("og:description", "P".number_format($data['price'],0)." ".$data['type']." ".$data['category']." in ".$data['address']['municipality']." ".$data['address']['province']." with land area of ".$data['lot_area']);
		$this->doc->setFacebookMetaData("og:updated_time", $data['last_modified']);

		if($data) {
			
			/* $this->saveListingView($data['listing_id'], $data['account_id']); */

			$this->setTemplate("listings/view.php");
			return $this->getTemplate($data,$listing);

		}

	}
	
	private function saveListingView($listing_id, $account_id) {

		if(isset($_SESSION['listings']) && !in_array($listing_id, $_SESSION['listings'])) {

			$listing_view = $this->getModel("ListingView");
			$response = $listing_view->saveNew([
				"listing_id" => $listing_id,
				"account_id" => $account_id,
				"datetime" => DATE_NOW,
				"user_agent" => json_encode([])
			]);

		}

	}

	function comparativeAnalysis($uri) {

		$this->doc->setTitle("MLS System - Comparative Analysis Table");

		$uri = base64_decode($uri);
		
		$total = isset($_SESSION['compare']['listings']) ? count($_SESSION['compare']['listings']) : 0;
		
		if($total > 0) {
			
			$listing = $this->getModel("Listing");
			$listing->page['limit'] = 4;

			$data = $listing->where(" listing_id IN(".$uri['ids'].") ")->getList();
		}else { $data = false; $listing = false; }

		$this->setTemplate("listings/comparative.php");
		return $this->getTemplate($data,$listing);

	}

	function sendMessage($listing_id) {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['inquired_at'] = DATE_NOW;

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $listing_id;
		$data = $listing->getById();

		$_POST['name'] = Encrypt::getInstance()->encrypt($_POST['name']);
		$_POST['email'] = Encrypt::getInstance()->encrypt($_POST['email']);
		$_POST['mobile_no'] = Encrypt::getInstance()->encrypt($_POST['mobile_no']);
		$_POST['message'] = Encrypt::getInstance()->encrypt( $_POST['message']);

		$message = $this->getModel("Lead");
		$leads = $this->getModel("Lead");
		$response = $leads->saveNew($_POST);

		$notification = $this->getModel("Notification");
		$notification->saveNew(
			array(
				"account_id" => $data['account_id'],
				"status" => 1,
				"created_at" => DATE_NOW,
				"content" => array(
					"title" => "New Leads",
					"message" => $_POST['name']." inquired about ".$data['title'],
					"url" => MANAGE."leads/".$response['id']
				)
			)
		);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

}