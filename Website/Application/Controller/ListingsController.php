<?php

namespace Website\Application\Controller;

class ListingsController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

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

		$listing = $this->getModel("Listing");
		
		debug($listing);
		

	}

	function view($id) {

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data = $listing->getById();

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['thumb_img']);
		$this->doc->setFacebookMetaData("og:description", "P".number_format($data['price'],0)." ".$data['type']." ".$data['category']." in ".$data['address']['municipality']." ".$data['address']['province']." with land area of ".$data['lot_area']);
		$this->doc->setFacebookMetaData("og:updated_time", $data['last_modified']);

		if($data) {
			
			$this->saveListingView($data['listing_id'], $data['account_id']);

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

}