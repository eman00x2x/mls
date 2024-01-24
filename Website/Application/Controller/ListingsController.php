<?php

namespace Website\Application\Controller;

class ListingsController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function view($id) {

		$listing = $this->getModel("Listing");
		$listing->listing_id = $id;
		$data = $listing->getById();

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