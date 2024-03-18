<?php

namespace Website\Application\Controller;

class HomeController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration("
			(async () => {

				await fetch('".url("HomeController@popularLocations")."')
					.then( response => response.json() )
						.then( data => { 
							$('.popular-location-container').html(data.content);

							fetch('".url("HomeController@featuredPost")."')
								.then( response => response.json() )
									.then( data => {
										$('.featured-post-container').html(data.content);

											fetch('".url("HomeController@latestArticles")."')
												.then( response => response.json() )
													.then( data => {
														$('.latest-articles-container').html(data.content);
													});
									});

						});
				
			})();
				
		
		");

		$this->setTemplate("home/index.php");
		return $this->getTemplate();
	}

	function popularLocations() {
	
		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 10;
		$listings->select(" COUNT(JSON_EXTRACT(address, '$.municipality')) as total, JSON_EXTRACT(address, '$.municipality') as city, JSON_EXTRACT(address, '$.region') as region, JSON_EXTRACT(address, '$.province') as province ");
		/* $listings->where(" is_website = 1 "); */
		$listings->groupBy(" city ");
		$data = $listings->getList();

		$this->setTemplate("home/popularLocations.php");
		$data = $this->getTemplate($data, $listings);

		echo json_encode([
			"status" => "success",
			"content" => $data
		]);

		exit();

	}

	function featuredPost() {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 5;
		$listings->join(" l JOIN #__accounts a ON a.account_id = l.account_id");
		$listings->where(" is_website = 1 ");
		$data['listings'] = $listings->getList();

		if($data['listings']) {
			$total_listing = count($data['listings']);

			for($i=0; $i<$total_listing; $i++) {

				$images = $this->getModel("ListingImage");
				$images->page['limit'] = 50;

				$images->column['listing_id'] = $data['listings'][$i]['listing_id'];
				$total_image = $images->getByListingId();
				
				$data['listings'][$i]['total_images'] = 0;

				if($total_image) {
					$data['listings'][$i]['total_images'] = count($total_image);
				}
			}

			$this->setTemplate("home/featuredPost.php");
			$data = $this->getTemplate($data, $listings);

			echo json_encode([
				"status" => "success",
				"content" => $data
			]);

			exit();

		}

	}

	function latestArticles() {

		$articles = $this->getModel("Article");
		$articles->page['limit'] = 5;
		$data['articles'] = $articles->getList();

		$this->setTemplate("home/latestArticles.php");
		$data = $this->getTemplate($data, $articles);

		echo json_encode([
			"status" => "success",
			"content" => $data
		]);

		exit();

	}

}