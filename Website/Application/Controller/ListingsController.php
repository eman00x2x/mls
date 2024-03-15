<?php

namespace Website\Application\Controller;

class ListingsController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function buy() { return $this->index("buy"); }
	function rent() { return $this->index("rent"); }

	function index($offer = "buy") {

		$this->doc->setTitle("Property Listings");

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addStyleDeclaration("
			.btn-filter-holder {
				position: fixed;
				bottom: 0;
			}
		");

		$this->doc->addScriptDeclaration("

			$(document).ready(function() {

			});

			$(document).on('click', '.btn-filter', function() {
				/* let formData = new FormData(document.querySelector('#filter-form')); let object = {};
				formData.forEach((value, key) => {
					if(!Reflect.has(object, key)){ object[key] = value;return; }
					if(!Array.isArray(object[key])){ object[key] = [object[key]]; }
					object[key].push(value);
				}); let json = JSON.stringify(object); window.location = '?' + btoa(json); */
				
				formData = $('#filter-form').serialize();
				window.location = '?' + formData;
			});

			$(document).on('show.bs.offcanvas', '#offcanvasEnd', function() {
				let form = $('.filter-box');
				$(this).addClass('px-4 pt-4 pb-1');
				
				$(this).append(\"<div class='d-flex justify-content-end'><span class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></span></div>\");
				$(this).append(form.clone());
				form.remove();
			});

			$(document).on('hide.bs.offcanvas', '#offcanvasEnd', function() {
				let form = $('#offcanvasEnd .filter-box');
				$(this).removeClass('px-4 pt-4');
				$('.sidebar').html(form.clone());
				$(this).html('');
			});

		");

		if(isset($_GET[0])) {
			$get = array_keys($_GET);
			$_GET = json_decode(base64_decode($get[0]), true);
			debug($_GET);
		}

		if($offer == "buy") {
			$filters[] = " offer = 'for sale'";
			$uri['offer'] = "for sale";
		}

		if($offer == "rent") {
			$filters[] = " offer = 'for rent'";
			$uri['offer'] = "for rent";
		}

		$filters[] = " status = 1";
		$filters[] = " display = 1";
		$filters[] = " is_website = 1";

		if(isset($_GET['price']) && $_GET['price'] != "") {
			$uri['price'] = $_GET['price'];

			$price = explode("-", $uri['price']);

			if($price[1] == "00") {
				$filters[] = "price >= ".$price[0]."";
			}else {
				$filters[] = "(price BETWEEN ".$price[0]." AND ".$price[1].")";
			}
			
		}


		if(isset($_GET['lot_area']) && $_GET['lot_area'] != "") {
			$uri['lot_area'] = $_GET['lot_area'];

			$lot_area = explode("-", $uri['lot_area']);

			if($lot_area[1] == "00") {
				$filters[] = "lot_area >= ".$lot_area[0]."";
			}else {
				$filters[] = "(lot_area BETWEEN ".$lot_area[0]." AND ".$lot_area[1].")";
			}
			
		}

		if(isset($_GET['floor_area']) && $_GET['floor_area'] != "") {
			$uri['floor_area'] = $_GET['floor_area'];

			$floor_area = explode("-", $uri['floor_area']);

			if($floor_area[1] == "00") {
				$filters[] = "floor_area >= ".$floor_area[0]."";
			}else {
				$filters[] = "(floor_area BETWEEN ".$floor_area[0]." AND ".$floor_area[1].")";
			}
			
		}

		if(isset($_GET['bedroom']) && $_GET['bedroom'] != "") {
			$uri['bedroom'] = $_GET['bedroom'];

			if($_GET['bedroom'] == 6) {
				$filters[] = " bedroom >= ".$_GET['bedroom'];
			}else {
				$filters[] = " bedroom = '".$_GET['bedroom']."'";
			}
		}

		if(isset($_GET['bathroom']) && $_GET['bathroom'] != "") {
			$uri['bathroom'] = $_GET['bathroom'];

			if($_GET['bathroom'] == 6) {
				$filters[] = " bathroom >= ".$_GET['bathroom'];
			}else {
				$filters[] = " bathroom = '".$_GET['bathroom']."'";
			}
		}

		if(isset($_GET['type']) && $_GET['type'] != "") {
			$uri['type'] = $_GET['type'];
			$search[] = $_GET['type'];
		}

		if(isset($_GET['tags']) && $_GET['tags'] != "") {
			$uri['tags'] = $_GET['tags'];
			$search[] = implode(" ", $_GET['tags']);
		}

		if(isset($_GET['category']) && $_GET['category'] != "") {
			$uri['category'] = $_GET['category'];
			$filters[] = " category LIKE '%".$_GET['category']."%'";
			$search[] = $_GET['category'];
		}

		if(isset($_GET['address']) && $_GET['address'] != "") {
			$uri['address'] = $_GET['address'];
			$filters[] = " address LIKE '%".$_GET['address']."%'";
			$search[] = $_GET['address'];
		}

		if(isset($_GET['amenities']) && $_GET['amenities'] != "") {
			$uri['amenities'] = $_GET['amenities'];
			$search[] = implode(" ", $_GET['amenities']);
		}

		$listings = $this->getModel("Listing");

		$order = isset($_GET['order']) ? $_GET['order'] : " DESC";
		
		if(
			(isset($_GET['type']) && $_GET['type'] != "") || 
			(isset($_GET['tags']) && $_GET['tags'] != "") || 
			(isset($_GET['category']) && $_GET['category'] != "") || 
			(isset($_GET['address']) && $_GET['address'] != "") || 
			(isset($_GET['amenities']) && $_GET['amenities'] != "")
		) {
			$sort = isset($_GET['sort']) ? $_GET['sort'] : " score";
			$listings->select("
				listing_id, account_id, is_website, offer, foreclosed, name, price, floor_area, lot_area, unit_area, bedroom, bathroom, parking, thumb_img, last_modified, status, display, type, title, tags, long_desc, category, address, amenities,
				MATCH( type, title, tags, long_desc, category, address, amenities )
				AGAINST( '" . implode(" ", $search) . "' IN BOOLEAN MODE ) AS score
			")->orderby(" score DESC ");
		}else {
			$sort = isset($_GET['sort']) ? ($_GET['sort'] == "score") ? "last_modified" : $_GET['sort'] : " last_modified";
			$listings->orderby(" $sort $order ");
		}

		$listings->where((isset($filters) ? implode(" AND ",$filters) : null));

		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listings->page['target'] = url();
		$listings->page['uri'] = (isset($uri) ? $uri : []);

		$data['listings'] = $listings->getList();

		$this->setTemplate("listings/index.php");
		return $this->getTemplate($data, $listings);

	}

	function view($name) {

		/* $this->doc->addScript(CDN."js/fslightbox/fslightbox.js");
		$this->doc->addScriptDeclaration("
			
		"); */

		$listing = $this->getModel("Listing");
		$listing->column['name'] = $name;
		$listing->where(" status = 1 ");
		$listing->and(" display = 1 AND is_website = 1 ");
		$data = $listing->getByName();

		if($data) {

			$images = $this->getModel("ListingImage");
			$images->page['limit'] = 50;
			$images->column['listing_id'] = $data['listing_id'];
			$data['images'] = $images->getList();

			$title = $data['title'];
			$description = "P".number_format($data['price'],0)." ".$data['type']." ".$data['category']." in ".$data['address']['municipality']." ".$data['address']['province']." with land area of ".$data['lot_area'];
			$image = $data['thumb_img'];

			$this->doc->setTitle($title);
			$this->doc->setDescription($description);
			$this->doc->setMetaData("keywords", $description);

			$this->doc->setFacebookMetaData("og:url", url());
			$this->doc->setFacebookMetaData("og:title", $title);
			$this->doc->setFacebookMetaData("og:type", "website");
			$this->doc->setFacebookMetaData("og:image", $image);
			$this->doc->setFacebookMetaData("og:description", $description);
			$this->doc->setFacebookMetaData("og:updated_time", $data['last_modified']);
			
			$this->saveListingView($data);

			$this->setTemplate("listings/view.php");
			return $this->getTemplate($data, $listing);

		}

		$this->response(404);

	}
	
	private function saveListingView($data) {

		$traffic = $this->getModel("ListingView");
		$traffic->column['session_id'] = $this->getLibrary("SessionHandler")->get("id");
		
		if(!$traffic->getBySessionId()) {
			$traffic->saveNew(array(
				"listing_id" => $data['listing_id'],
				"account_id" => $data['account_id'],
				"session_id" => $this->getLibrary("SessionHandler")->get("id"),
				"created_at" => DATE_NOW,
				"user_agent" => json_encode($this->getLibrary("SessionHandler")->get("user_agent"))
			));
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