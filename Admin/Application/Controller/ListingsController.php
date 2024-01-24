<?php

namespace Admin\Application\Controller;

class ListingsController extends \Main\Controller {
	
	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index($account_id) {

		$this->doc->setTitle("Property Listings");
	
		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();

		$filters[] = " account_id = $account_id ";
		
		$listing = $this->getModel("Listing");
		$listing->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" last_modified DESC ");
		
		$listing->page['limit'] = 20;
		$listing->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listing->page['target'] = url("ListingsController@index");
		$listing->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['listings'] = $listing->getList();

		$this->setTemplate("listings/listings.php");
		return $this->getTemplate($data,$listing);
		
	}
	
	function edit($account_id, $listing_id) {
		
		$this->doc->setTitle("Update Property Listing");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScript(CDN."js/photo-uploader.js");
		$this->doc->addScript(CDN."tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1695847769");

		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				if (localStorage.getItem('items') !== null) {
					localStorage.clear();
				}
			});

			$(document).on('click','.selection-tab',function() {
				link = $(this).data('link');
				$('.nav-tabs a[href=\"' + link + '\"]').tab('show');
			});
		");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();
		
		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $listing_id;
		$listing->and(" account_id = $account_id ");

		$listing->addresses = $this->getModel("Address");

		$data['listing'] = $listing->getById();
		
		$listingImage = $this->getModel("ListingImage");
		$listingImage->column['listing_id'] = $listing_id;
		$data['listing']['images'] = $listingImage->getByListingId();

		if($data) {
			$this->setTemplate("listings/edit.php");
			return $this->getTemplate($data,$listing);
		}

		$this->response(404);
		
	}
	
	function add($account_id) {

		$this->doc->setTitle("New Property Listings");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScript(CDN."js/photo-uploader.js");
		$this->doc->addScript(CDN."tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1695847769");

		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				if (localStorage.getItem('items') !== null) {
					localStorage.clear();
				}
			});
		");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();

		$listing = $this->getModel("Listing");
		$listing->addresses = $this->getModel("Address");

		$this->setTemplate("listings/add.php");
		return $this->getTemplate($data, $listing);
	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);
		
		$_POST['name'] = sanitize($_POST['title']);
		$_POST['date_added'] = DATE_NOW;
		$_POST['last_modified'] = DATE_NOW;
		$_POST['thumb_img'] = $_POST['thumb_img'] != "" ? CDN."/images/listings/".$_POST['thumb_img'] : null;

		if(isset($_POST['address'])) { $_POST['address'] = json_encode($_POST['address']); }
		if(isset($_POST['tags'])) { $_POST['tags'] = json_encode($_POST['tags']); }
		if(isset($_POST['amenities'])) {$_POST['amenities'] = implode(",",$_POST['amenities']); }
	
		$listing = $this->getModel("Listing");
		$response = $listing->saveNew($_POST);

		if($response['status'] == 1) {

			if(isset($_POST['listing_image_filename'])) {
				$listingImage = $this->getModel("ListingImage");
				$listingImage->saveImages($response['id'],$_POST['listing_image_filename']);
				
				unset($_POST['listing_image_url']);
				unset($_POST['listing_image_filename']);
			}

		}

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['name'] = sanitize($_POST['title']);
		$_POST['last_modified'] = DATE_NOW;
		$_POST['thumb_img'] = $_POST['thumb_img'] != "" ? CDN."/images/listings/".$_POST['thumb_img'] : null;
		$_POST['foreclosed'] = isset($_POST['foreclosed']) ? $_POST['foreclosed'] : "0";

		if(isset($_POST['address'])) { $_POST['address'] = json_encode($_POST['address']); }
		if(isset($_POST['tags'])) { $_POST['tags'] = json_encode($_POST['tags']); }
		if(isset($_POST['amenities'])) {$_POST['amenities'] = implode(",",$_POST['amenities']); }

		$listing = $this->getModel("Listing");
		$response = $listing->save($id,$_POST);
		
		if(isset($_POST['listing_image_filename'])) {
			$listingImage = $this->getModel("ListingImage");
			$listingImage->saveImages($id,$_POST['listing_image_filename']);
		}

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function uploadImages($account_id) {

		if(isset($_FILES['ImageBrowse'])) {
			$listing = $this->getModel("Listing");
			return $listing->uploadImage($_FILES['ImageBrowse']);
		}else {
			$this->getLibrary("Factory")->setMsg("There was something wrong, Please try selecting your image again.","info");
			$uploadedImages[] = array(
				"status" => 2,
				"message" => getMsg()
			);

			return json_encode($uploadedImages);
		}
		
	}
	
	function delete($id) {

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data = $listing->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$listing_image = $this->getModel("ListingImage");
				$listing_image->deleteListingImages($id);
				$listing->deleteListing($id);

				$this->getLibrary("Factory")->setMsg("Listing permanently deleted!","success");
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

		$this->setTemplate("listings/delete.php");
		return $this->getTemplate($data);

	}
	
}