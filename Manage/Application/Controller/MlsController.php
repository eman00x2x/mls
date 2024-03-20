<?php

namespace Manage\Application\Controller;

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class MlsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	public $session;
	
	function __construct() {

        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();

		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
		$this->account_id = $this->session['account_id'];

		if(!isset($this->session['privileges']['mls_access']) && in_array($this->session['account_type'], ["Customer Service"])) {
			$this->getLibrary("Factory")->setMsg("Access to the MLS (Multiple Listing Service) requires premium privileges. Upgrade your subscription or subscribe to a premium to gain access.", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		if(!isset($_SESSION['compare']['listings'])) {
			$_SESSION['compare']['listings'] = [];
		}

	}
	
	function MLSIndex() {

        $this->doc->setTitle("MLS System");
		$this->doc->addScriptDeclaration("
			$(document).on('click','.btn-filter',function() {
				var formData = $('#filter-form').serialize();
				window.location = '".url('MlsController@MLSIndex')."?filter=' + btoa(formData);
			});

			$(document).on('click','.btn-filter-form',function() {
				
				$('.offcanvas-end').html('');
				$('.offcanvas-end').addClass('filter-form-canvas');
				var form = $('.filter-form').clone();
				html = \"<div class='offcanvas-body'></div>\";
				
				$('.offcanvas-end').html(html);
				$('.offcanvas-end .offcanvas-body').html(form);
				$('.form-container').html('');

				$('.offcanvas-end .offcanvas-header').append(\"<button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>\");

			});

			$(document).on('hide.bs.offcanvas', '.filter-form-canvas', function() {
				var form = $('.filter-form-canvas .filter-form').clone();
				$('.form-container').html(form);
				$('.form-container .offcanvas-header .btn-close').remove();
				$('.offcanvas-end').html('');
			});

		"); 

		if(isset($_GET['filter'])) {
			parse_str(urldecode(base64_decode($_GET['filter'])), $_GET);
		}

		/* $handshake = $this->getModel("Handshake");
		$handshake->column['requestor_account_id'] = $this->session['account_id'];
		$handshake->select("GROUP_CONCAT(listing_id) as listing_ids")->and(" handshake_status IN('pending','active')");
		$handshakeListings = $handshake->getByRequestorAccountId();
		
		if($handshakeListings['listing_ids'] != "") {
			$filters[] = " listing_id NOT IN(".$handshakeListings['listing_ids'].")";
		} */

		if(isset($_GET['offer']) && $_GET['offer'] != "") {
			$filters[] = " offer = '".$_GET['offer']."'";
			$uri['offer'] = $_GET['offer'];
		}else {
			$filters[] = " offer = 'for sale'";
			$uri['offer'] = "for sale";
		}

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

			if($_GET['address']['region'] != "") {
				$filters[] = " JSON_EXTRACT(address, '$.region') = '".$_GET['address']['region']."'  ";
				$search[] = $_GET['address']['region'];
			}

			if($_GET['address']['province'] != "") {
				$filters[] = " JSON_EXTRACT(address, '$.province') = '".$_GET['address']['province']."'  ";
				$search[] = $_GET['address']['province'];
			}

			if($_GET['address']['municipality'] != "") {
				$filters[] = " JSON_EXTRACT(address, '$.municipality') = '".$_GET['address']['municipality']."'  ";
				$search[] = $_GET['address']['municipality'];
			}

		}

		if(isset($_GET['amenities']) && $_GET['amenities'] != "") {
			$uri['amenities'] = $_GET['amenities'];
			$search[] = implode(" ", $_GET['amenities']);
		}

		#$filters[] = " account_id != ".$this->session['account_id'];
		$filters[] = " is_mls = 1 ";
		$filters[] = " l.status = 1 ";
		$filters[] = " display = 1";

		if(isset($_GET['region']) && $_GET['region'] != "") {
			$filters[] = " board_region = '".$_GET['region']."'";
			$uri['region'] = $_GET['region'];
		}else {

			$uri['region'] = "";

			if($this->session['board_region'] != "") {
				$filters[] = " board_region = '".$this->session['board_region']."'";
				$uri['region'] = $this->session['board_region'];
			}

		}

		if(isset($_GET['local']) && $_GET['local'] != "") {
			$filters[] = " local_board_name = '".$_GET['local']."'";
			$uri['local'] = $_GET['local'];
		}else {

			$uri['local'] = "";

			if($this->session['local_board_name'] != "") {
				$filters[] = " local_board_name = '".$this->session['local_board_name']."'";
				$uri['local'] = $this->session['local_board_name'];
			}
			
		}

		$address = $this->getModel("Address");
		$listings = $this->getModel("Listing");
		$listings->address = $address->addressSelection((isset($_GET['address']) ? $_GET['address'] : null));
		
		if(
			(isset($_GET['type']) && $_GET['type'] != "") || 
			(isset($_GET['tags']) && $_GET['tags'] != "") || 
			(isset($_GET['category']) && $_GET['category'] != "") || 
			(isset($_GET['address']) && $_GET['address'] != "") || 
			(isset($_GET['amenities']) && $_GET['amenities'] != "")
		) {
			
			$listings->select("
				listing_id, l.account_id, is_website, offer, foreclosed, name, price, floor_area, lot_area, unit_area, bedroom, bathroom, parking, thumb_img, last_modified, l.status, display, type, title, tags, long_desc, category, address, amenities,
				MATCH( type, title, tags, long_desc, category, address, amenities )
				AGAINST( '" . implode(" ", $search) . "' IN BOOLEAN MODE ) AS score
			")->orderby(" score DESC ");

		}else {
			/* $sort = isset($_GET['sort']) ? ($_GET['sort'] == "score") ? "last_modified" : $_GET['sort'] : " last_modified";
			$listings->orderby(" $sort $order "); */
		}

		$listings->join(" l JOIN #__accounts a ON a.account_id = l.account_id ");
		$listings->where((isset($filters) ? implode(" AND ",$filters) : null));
		
		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listings->page['target'] = url("MlsController@index");
		$listings->page['uri'] = (isset($uri) ? $uri : []);

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

		}

		$this->setTemplate("mls/list.php");
		return $this->getTemplate($data,$listings);

	}

	function handshakedIndex() {

		$this->doc->setTitle("MLS System");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$listing = $this->getModel("Listing");

		$handshake = $this->getModel("Handshake");
		$handshake->where(" requestor_account_id = ".$this->session['account_id']." OR requestee_account_id = ".$this->session['account_id'])
		->and(" handshake_status IN('pending','active') ")
		->orderby(" FIELD(handshake_status,'pending','active','done','denied'), handshake_status_date DESC ");
		
		$handshake->page['limit'] = 20;
		$handshake->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$handshake->page['target'] = url("MlsController@index");
		$handshake->page['uri'] = (isset($uri) ? $uri : []);

		$data = $handshake->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$listing->column['listing_id'] = $data[$i]['listing_id'];
				$data[$i]['listing'] = $listing->getById();

				if(!$data[$i]['listing']) {
					$handshake->deleteHandshake($data[$i]['handshake_id']);
					unset($data[$i]);
				}
			}
		}

		$this->setTemplate("mls/handshaked.php");
		return $this->getTemplate($data,$handshake);

	}

	function viewListing($id) {

		$this->setTempalteBasePath(ROOT."Admin");

		$this->doc->addStyleDeclaration("

			.btn-wrap {
				border-top: 2px solid #e1e1e1;
				padding: 15px 5px 25px 5px;
				background-color: #FFF;
			}

		");

		return parent::view($id);
	}

    function requestHandshake($listing_id) {

		$handshake = $this->getModel("Handshake");
		$handshake->column['requestor_account_id'] = $this->session['account_id'];
		$handshake->select("COUNT(listing_id) AS total_handshakes")
		->and(" handshake_status IN('pending','active') ");
		
		$handshakeListings = $handshake->getByRequestorAccountId();

		if($handshakeListings['total_handshakes'] >= $this->session['privileges']['handshake_limit']) {
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

					$account->column['account_id'] = $this->session['account_id'];
					$requestor = $account->getById();

					unset($requestor['account_type']);
					unset($requestor['uploads']);
					unset($requestor['preferences']);
					unset($requestor['privileges']);

					$handshake = $this->getModel("Handshake");
					$handshake->saveNew(array(
						"requestor_account_id" => $this->session['account_id'],
						"requestor_details" => json_encode($requestor, JSON_PRETTY_PRINT),
						"requestee_account_id" => $data['account_id'],
						"listing_id" => $data['listing_id'],
						"handshake_status" => "pending",
						"handshake_status_date" => DATE_NOW,
						"requested_date" => DATE_NOW
					));

					$notification = $this->getModel("Notification");
					$notification->saveNew(
						array(
							"account_id" => $data['account_id'],
							"status" => 1,
							"created_at" => DATE_NOW,
							"content" => array(
								"title" => $requestor['firstname']." ".$requestor['lastname']." requested a handshake",
								"message" => $data['title'],
								"url" => MANAGE."mls/handshaked"
							)
						)
					);

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
		$handshake->column['handshake_id'] = $id;
		$data = $handshake->getById();

		$handshake->save($id, array(
			"handshake_status" => "active",
			"handshake_status_date" => DATE_NOW
		));

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $data['listing_id'];
		$data['listing'] = $listing->getById();

		$account = $this->getModel("Account");
		$account->column['account_id'] = $data['requestee_account_id'];
		$data['requestee'] = $account->getById();

		$notification = $this->getModel("Notification");
		$notification->saveNew(
			array(
				"account_id" => $data['requestor_account_id'],
				"status" => 1,
				"created_at" => DATE_NOW,
				"content" => array(
					"title" => $data['requestee']['firstname']." ".$data['requestee']['lastname']." accepted your handshake request",
					"message" => $data['listing']['title'],
					"url" => MANAGE."mls/handshaked"
				)
			)
		);

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
		$handshake->column['handshake_id'] = $id;
		$data = $handshake->getById();

		$handshake->save($id, array(
			"handshake_status" => "denied",
			"handshake_status_date" => DATE_NOW
		));

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $data['listing_id'];
		$data['listing'] = $listing->getById();

		$account = $this->getModel("Account");
		$account->column['account_id'] = $data['requestee_account_id'];
		$data['requestee'] = $account->getById();

		$notification = $this->getModel("Notification");
		$notification->saveNew(
			array(
				"account_id" => $data['requestor_account_id'],
				"status" => 1,
				"created_at" => DATE_NOW,
				"content" => array(
					"title" => $data['requestee']['firstname']." ".$data['requestee']['lastname']." denied your handshake request",
					"message" => $data['listing']['title'],
					"url" => MANAGE."mls/".$data['listing_id']
				)
			)
		);

		$this->getLibrary("Factory")->setMsg("Handshake Denied!","info");
		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}

	function doneHandshake($id) {

		$handshake = $this->getModel("Handshake");
		$handshake->column['handshake_id'] = $id;
		$data = $handshake->getById();

		$handshake->save($id, array(
			"handshake_status" => "done",
			"handshake_status_date" => DATE_NOW
		));
		
		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $data['listing_id'];
		$data['listing'] = $listing->getById();

		$notification = $this->getModel("Notification");
		$notification->saveNew(
			array(
				"account_id" => ($this->session['account_id'] != $data['requestee_account_id'] ? $data['requestor_account_id'] : $data['requestee_account_id']),
				"status" => 1,
				"created_at" => DATE_NOW,
				"content" => array(
					"title" => $this->session['firstname']." ".$this->session['lastname']." mark done a handshake",
					"message" => $data['listing']['title'],
					"url" => MANAGE."mls/".$data['listing_id']
				)
			)
		);

		$this->getLibrary("Factory")->setMsg("Handshake Done!","info");
		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}

	function cancelHandshake($listing_id) {

		$handshake = $this->getModel("Handshake");
		$handshake->column['requestor_account_id'] = $this->session['account_id'];
		$handshake->and(" listing_id = $listing_id ");
		$data = $handshake->getByRequestorAccountId();

		if($data) {

			$handshake->and(" requestor_account_id = ".$this->session['account_id']);
			$handshake->deleteHandshake($listing_id,"listing_id");

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();

			$notification = $this->getModel("Notification");
			$notification->saveNew(
				array(
					"account_id" => ($this->session['account_id'] != $data['requestee_account_id'] ? $data['requestor_account_id'] : $data['requestee_account_id']),
					"status" => 1,
					"created_at" => DATE_NOW,
					"content" => array(
						"title" => $this->session['firstname']." ".$this->session['lastname']." canceled a handshake",
						"message" => $data['listing']['title'],
						"url" => MANAGE."mls/".$data['listing_id']
					)
				)
			);

			$this->getLibrary("Factory")->setMsg("Handshake Canceled!","info");

		}else {
			$this->getLibrary("Factory")->setMsg("Listing not yet engage in handshake!","warning");
		}

		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}
	
	function addToCompare() {

		parse_str(file_get_contents('php://input'), $_POST);

		$total = count($_SESSION['compare']['listings']);

		if($total >= 4) {
			$this->getLibrary("Factory")->setMsg("Maximum count of listings has been reached! Cannot add more in compare table!","info");
		}else {

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $_POST['listing_id'];
			$data = $listing->getById();

			$_SESSION['compare']['listings'][$_POST['listing_id']] = $data;

			$this->getLibrary("Factory")->setMsg("Listing added to compare table!","info");

		}

		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);

	}

	function removeFromCompare() {
		parse_str(file_get_contents('php://input'), $_POST);
		unset($_SESSION['compare']['listings'][$_POST['listing_id']]);
		
		$this->getLibrary("Factory")->setMsg("Listing remove from compare table!","info");

		return json_encode(
			array(
				"status" => 1,
				"message" => getMsg()
			)
		);
	}

	function comparePreview() {

		$data['listings'] = $_SESSION['compare']['listings'];
		$data['count'] = count($_SESSION['compare']['listings']);

		$this->setTemplate("mls/comparePreview.php");
		return $this->getTemplate($data);

	}

	function compareListings() {

		$this->doc->setTitle("MLS System - Comparative Analysis Table");
		
		$total = isset($_SESSION['compare']['listings']) ? count($_SESSION['compare']['listings']) : 0;

		if($total > 0) {
	
			$ids = array_keys($_SESSION['compare']['listings']);
			
			$listing = $this->getModel("Listing");
			$listing->page['limit'] = 20;
			$data['listing'] = $listing->where(" listing_id IN(".implode(",", $ids).") ")->getList();

			$this->doc->addScriptDeclaration("

				let ids = '".json_encode($ids)."';
				let base_url = '".WEBDOMAIN."comparative-analysis/';
				let html = '';

				$(document).on('click', '.btn-create-url', function() {

					let expiration_date = $('#expiration_date option:selected').val();
					let uri = '&expiration=' + expiration_date;
					url = base_url + btoa('id=' + ids + uri);

					let title = 'Compare Analysis Table';
					let description = 'A detailed comparative of different real estate properties';
					let img = '';

					let share_link_fb = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
					let share_link_twitter = 'https://twitter.com/intent/tweet?text=' + title + '&url=' + url + '&via=TWITTER-HANDLE';
					let share_link_linkedin = 'https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title + '&summary=' + description + '&source=' + url;
					let share_link_pinterest = 'https://pinterest.com/pin/create/button/?url=' + url + '&description=' + description + '&media=' + img;

					$('.share-fb').attr('href', share_link_fb);
					$('.share-twitter').attr('href', share_link_twitter);
					$('.share-linkedin').attr('href', share_link_linkedin);
					$('.share-pinterest').attr('href', share_link_pinterest);
					$('.share-link-input').val(url);

					$('.create-url-form').addClass('d-none');
					$('.share-link-container').removeClass('d-none');

				});

			");
			
			$this->setTemplate("mls/compare.php");
			return $this->getTemplate($data,$listing);

		}

		$this->response(404);

	}

	/* CRONJOB runs every day at 12am */
	function expiredHandshakeRequest() {

		/* Current time minus 30 days */
		$time = strtotime("-30 days",DATE_NOW);

		/* Handshake remains for 30 days only
		Removing expired data permanently */

		$handshake = $this->getModel("Handshake");
		$handshake->query(" DELETE FROM #__handshake WHERE date_created <= $time ");

	}

	function downloadPDFFormat($id)  {

		$this->setTempalteBasePath(ROOT."Admin");

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data['listing'] = $listing->getById();

		$listingImage = $this->getModel("ListingImage");
		$listingImage->column['listing_id'] = $id;
		$data['listing']['images'] = $listingImage->getByListingId();

		$this->setTemplate("listings/download.php");

		try {

			$filename = $data['listing']['name'].".pdf";

			ob_start();
				echo $this->getTemplate($data,$listing);
			$content = ob_get_clean();

			$pdf = new Html2Pdf('P', 'Letter',);
			$pdf->pdf->SetDisplayMode('fullpage');
			$pdf->writeHTML($content);
			$pdf->Output($filename);

		} catch (Html2PdfException $e) {
			$pdf->clean();

			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
		}

        exit();
		
	}
	
}