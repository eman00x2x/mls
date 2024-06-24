<?php

namespace Website\Application\Controller;

use Library\Helper as Helper;

class AccountsController extends \Admin\Application\Controller\AccountsController {

	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function profile($id, $name) {

        $accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		$account_name = strtolower(sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname']));

		if($account_name != $name) {
			$this->response(404);
		}

		$page_name = $data['account_name']['firstname']." ".$data['account_name']['lastname'];
		$description = $page_name." - " . nicetrim($data['profile']['about_me'], 120) . " - " . CONFIG["site_name"];

		$image = CDN."images/real-estate.jpg";
		if($data['logo'] != "") {
			$image = $data['logo'];
		}

        $this->doc->setTitle($page_name." Profile - ". CONFIG["site_name"]);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("Keywords", $description);

		$this->doc->setFacebookMetaData("og:url", DOMAIN. url("AccountsController@profile", ["id" => $data['account_id'], "name" => $account_name ] ));
		$this->doc->setFacebookMetaData("og:title", $data['account_name']['firstname']." ".$data['account_name']['lastname']." Profile - ". CONFIG["site_name"]);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': '$page_name Profile',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});

		"));

		if($data['reference_id'] > 1) {

			$reference = $this->getModel("LicenseReference");
			$reference->column['reference_id'] = $data['reference_id'];
			$reference->join("  ");
			$data['reference'] = $reference->getById();

			if($data['reference']) {
				$broker_account = $this->getModel("Account");
				$broker_account->column['real_estate_license_number'] = $data['reference']['broker_prc_license_id'];
				$data['broker'] = $broker_account->getByLicenseId();
			}

		}

		$data['social_media_buttons'] = Helper::socialMediadShareButtons([
			"title" => $data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix']." Profile - ".CONFIG['site_name'],
            "url" => DOMAIN.url(),
            "img" => CDN."images/accounts/".$data['logo'],
			"description" => ""
		]);

		$testimonials = $this->getModel("Testimonial");
		$testimonials->column['account_id'] = $id;
		$data['testimonials'] = $testimonials->getByAccountId();

		$this->setTemplate("accounts/profile.php");
		return $this->getTemplate($data);

    }

	function accountListings($id, $name) {

		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		$listings = $this->getModel("Listing");

		$address = $this->getModel("Address");
		$listings->address = $address->addressSelection((isset($_GET['address']) ? $_GET['address'] : null));

		if(isset($_GET['offer']) && $_GET['offer'] == "rent") {
			$filters[] = " offer = 'for rent'";
			$listings->page['uri']['offer'] = "for rent";
		}else {
			$listings->page['uri']['offer'] = "for sale";
			$filters[] = " offer = 'for sale'";
		}

		if(isset($_GET['category']) && $_GET['category'] != "") {
			$listings->page['uri']['category'] = $_GET['category'];
			$filters[] = " category LIKE '%".$_GET['category']."%'";
			$search[] = $_GET['category'];
		}

		if(isset($_GET['price']) && $_GET['price'] != "") {
			$listings->page['uri']['price'] = $_GET['price'];

			if(strpos($_GET['price'], "-") !== false) {
				$price = explode("-", $_GET['price']);
				$filters[] = "price BETWEEN ".$price[0]." AND ".$price[1]."";
			}else {
				$price = $_GET['price'];
				$filters[] = "price >= ".$price[0];
			}

		}

		if(isset($_GET['lot_area']) && $_GET['lot_area'] != "") {
			$listings->page['uri']['lot_area'] = $_GET['lot_area'];
			$filters[] = "lot_area >= ".$_GET['lot_area']."";
		}

		if(isset($_GET['floor_area']) && $_GET['floor_area'] != "") {
			$listings->page['uri']['floor_area'] = $_GET['floor_area'];
			$filters[] = "floor_area >= ".$_GET['floor_area']."";
		}

		if(isset($_GET['bedroom']) && $_GET['bedroom'] != "") {
			$listings->page['uri']['bedroom'] = $_GET['bedroom'];

			if($_GET['bedroom'] == "Studio") {
				$filters[] = " bedroom = '".$_GET['bedroom']."'";
			}else {
				$filters[] = " bedroom >= ".$_GET['bedroom'];
			}
		}

		if(isset($_GET['bathroom']) && $_GET['bathroom'] != "") {
			$listings->page['uri']['bathroom'] = $_GET['bathroom'];
			$filters[] = " bathroom >= ".$_GET['bathroom'];
		}

		if(isset($_GET['parking']) && $_GET['parking'] != "") {
			$listings->page['uri']['parking'] = $_GET['parking'];
			$filters[] = "parking = ".$_GET['parking']."";
		}

		if(isset($_GET['address']) && $_GET['address'] != "") {
			$listings->page['uri']['address'] = $_GET['address'];

			if(isset($_GET['address']['region']) && $_GET['address']['region'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.region') = '".str_replace("+", " ", $_GET['address']['region'])."'  ";
				$search[] = str_replace("+", " ", $_GET['address']['region']);
			}

			if(isset($_GET['address']['province']) && $_GET['address']['province'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.province') = '".str_replace("+", " ", $_GET['address']['province'])."'  ";
				$search[] = str_replace("+", " ", $_GET['address']['province']);
			}

			if(isset($_GET['address']['municipality']) && $_GET['address']['municipality'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.municipality') = '".str_replace("+", " ", $_GET['address']['municipality'])."'  ";
				$search[] = str_replace("+", " ", $_GET['address']['municipality']);
			}

			/* if(isset($_GET['address']['street']) && $_GET['address']['street'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.street') = '".str_replace("+", " ", $_GET['address']['street'])."'  ";
				$search[] = str_replace("+", " ", $_GET['address']['street']);
			}

			if(isset($_GET['address']['village']) && $_GET['address']['village'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.village') = '".str_replace("+", " ", $_GET['address']['village'])."'  ";
				$search[] = str_replace("+", " ", $_GET['address']['village']);
			} */

			if(!is_array($_GET['address'])) {
				$search[] = trim($_GET['address']);
			}

		}

		if(isset($_GET['amenities']) && $_GET['amenities'] != "") {
			
			if(!is_array($_GET['amenities'])) {
				$_GET['amenities'] = explode(",", $_GET['amenities']);
			}

			$listings->page['uri']['amenities'] = $_GET['amenities'];
			$search[] = implode(" ", $_GET['amenities']);
			
		}

		if(isset($_GET['tags']) && $_GET['tags'] != "") {
			$listings->page['uri']['tags'] = $_GET['tags'];
			$search[] = implode(" ", $_GET['tags']);
		}

		if(isset($_GET['foreclosed'])) {
			$listings->page['uri']['foreclosed'] = $_GET['foreclosed'];
			$filters[] = " foreclosed = 1 ";
		}

		$order = isset($_GET['order']) ? $_GET['order'] : " DESC";

		if(isset($_GET['sort'])) {
			$sort = $_GET['sort']." ".$order;
		}else {
			$sort = " post_score DESC ";
		}

		/* $filters[] = " a.status = 'active' "; */
		$filters[] = " l.status = 1 ";
		$filters[] = " display = 1 ";
		$filters[] = " is_website = 1 ";

		if(isset($search)) {
			$listings->select("
				l.listing_id, l.account_id, is_website, is_mls, is_mls_option, listing_type, offer, foreclosed, name, price, floor_area, lot_area, bedroom, bathroom, parking, thumb_img, modified_at, l.status, display, type, title, tags, long_desc, category, l.address, amenities, post_score,
				agent_name,
				CASE WHEN DATE(from_unixtime(modified_at)) >= DATE(NOW() - INTERVAL 7 DAY) THEN post_score + (1/14) END,
				MATCH( type, title, tags, long_desc, category, l.address, amenities )
				AGAINST( '" . implode(" ", $search) . "' IN BOOLEAN MODE ) AS match_score
			")->orderby(" match_score DESC, $sort ");
		}else {
			$listings
				->select(" 
					l.listing_id, l.account_id, is_website, is_mls, is_mls_option, listing_type, offer, foreclosed, name, price, floor_area, lot_area, bedroom, bathroom, parking, thumb_img, modified_at, l.status, display, type, title, tags, long_desc, category, l.address, amenities, post_score,
					
					CASE WHEN DATE(from_unixtime(modified_at)) >= DATE(NOW() - INTERVAL 7 DAY) THEN post_score + (1/14) END 
				")->orderby(" post_score DESC, $sort ");
		}

		if(KYC == 1) {
			$filters[] = " kyc_status = 1 ";
			$listings->join(" JOIN mls_accounts a ON a.account_id = l.account_id JOIN mls_kyc k ON k.account_id=a.account_id ");
		}else {
			$listings->join(" JOIN mls_accounts a ON a.account_id = l.account_id ");
		}

		$listings->and((isset($filters) ? implode(" AND ",$filters) : null));
		
		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;
		$listings->page['target'] = url("AccountsController@profile", ["id" => $data['account_id'], "name" => sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname']) ]);
		
		$data['listings'] = $listings->getAllAndHandshakeByAccountId($id);

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

		$listings->app = [
			"handshaked" => false,
			"comparative" => false,
			"url_path" => [
				"path" => "name",
				"value" => "name",
				"class_hint" => "ListingsController@view"
			],
			"uri" => [
				"ref" => base64_encode($data['account_id'])
			]
		];

		$this->setTempalteBasePath(ROOT."/Admin");
		$this->setTemplate("listings/listProperties.php");
		$listings->list = $this->getTemplate($data['listings'], $listings);

        $name = ($data['account_name']['nickname'] ?? $data['account_name']['firstname'])." ".$data['account_name']['lastname']." ".$data['account_name']['suffix'];
        $description = $name." - " . nicetrim($data['profile']['about_me'], 120) . " - " . CONFIG["site_name"];

		$image = CDN."images/real-estate.jpg";
		if($data['logo'] != "") {
			$image = $data['logo'];
		}

        $this->doc->setTitle($name." Listings - ". CONFIG["site_name"]);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("Keywords", $description);

		$this->doc->setFacebookMetaData("og:url", DOMAIN. url("AccountsController@accountListings", ["id" => $data['account_id'], "name" => sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname']) ] ));
		$this->doc->setFacebookMetaData("og:title", $name." Listings - ". CONFIG["site_name"]);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).on('click', '.btn-filter', function() {
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
			
			$(document).ready(function() {
				$('.listings-table .avatar').each(function() {
					thumb_image = $(this).attr('data-thumb-image');
					$(this).css('background-image', 'url(".CDN."images/item_default.jpg)');
					getImage(thumb_image, $(this));
				});
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': '$name Listings',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});

			async function getImage(thumb_image, element) {
				await fetch('".url("ListingsController@getThumbnail")."?url=' + thumb_image)
					.then( response => response.json() )
					.then(  (data) => {
						console.log(data);
						element.css('background-image', 'url('+data.url+')');
					});
				
			}

		"));

		$this->setTempalteBasePath(ROOT."/Website");
		$this->setTemplate("accounts/listings.php");
		return $this->getTemplate($data, $listings);

	}

	function memberDirectory() {

		$description = "The Philippine Association of Real Estate Boards Inc. (PAREB) is the foremost and largest national real estate service organization in the Philippines, encompassing 68 local member boards with a combined membership of 5,000 real estate practitioners.";

		$this->doc->setTitle("Members Directory - ".CONFIG['site_name']);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", DOMAIN. url("AccountsController@memberDirectory"));
		$this->doc->setFacebookMetaData("og:title", "Members Directory - ". CONFIG["site_name"]);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", CDN."images/real-estate.jpg");
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Pareb Members Directory',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});

		"));

		$this->setTempalteBasePath(ROOT."/Admin");
		return parent::memberDirectory();

	}

}