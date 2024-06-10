<?php

namespace Website\Application\Controller;

class ListingsController extends \Admin\Application\Controller\ListingsController {

	function __construct() {
		parent::__construct();
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function buy() { return $this->index("buy"); }
	function rent() { return $this->index("rent"); }

	function index($offer = "buy") {

		$description = "PAREB Network proudly spearheads the Philippine real estate arena, commanding a robust presence through its 68 Local Member Boards. With a collective force of 5,000 skilled practitioners, PAREB Network stands as a cornerstone of excellence and integrity in the industry, driving forward innovation and shaping the future landscape of real estate across the nation";

		$this->doc->setTitle("Property Listings");
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", CDN."images/real-estate.jpg");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addStyleDeclaration("
			.btn-filter-holder {
				position: fixed;
				bottom: 0;
			}
		");

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
					'name': '".ucwords($offer) . " Property',
					'id': 0,
					'url': '".url("ListingsController@$offer")."',
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
						element.css('background-image', 'url('+data.url+')');
					});
				
			}

		"));

		$filters[] = " is_website = 1 ";
		$filters[] = " l.status = 1 ";
		$filters[] = " display = 1 ";

		$_GET['offer'] = $offer;
		$uri['offer'] = $offer;

		$address = $this->getModel("Address");
		$listings = $this->getModel("Listing");
		$listings->address = $address->addressSelection((isset($_GET['address']) ? $_GET['address'] : null));

		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;
		$listings->page['target'] = url("ListingsController@$offer");
		
		$listings->app = [
			"handshaked" => false,
			"comparative" => false,
			"featured_post" => $this->getFeaturedProperties($listings, $filters),
			"url_path" => [
				"path" => "name",
				"value" => "name",
				"class_hint" => "ListingsController@view"
			]
		];

		$response = $this->listProperties($listings, $filters);

		$this->setTempalteBasePath(ROOT."/Admin");
		$this->setTemplate("listings/listProperties.php");
		$listings->list = $this->getTemplate($response['data'],$response['model']);

		$this->setTempalteBasePath(ROOT."/Website");
		$this->setTemplate("listings/index.php");
		return $this->getTemplate($response['data'], $response['model']);

	}

	function view($name) {

		$this->doc->addScript(CDN."js/encryption.js");
		$this->doc->addScript(CDN."js/script.js");
		$this->doc->addScript(CDN."js/amortization.js");
		$this->doc->addScript(CDN."tabler/dist/libs/plyr/dist/plyr.min.js");
		$this->doc->addStylesheet(CDN."tabler/dist/libs/plyr/dist/plyr.css");

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
		    let privateKey;
		    let publicKey;
			let currencies;
			let currency_code;
			let monthly_dp;

			if(sessionStorage['currencies'] === undefined) {

				$.get('".url("ListingsController@getCurrencyConverter")."', function(data) {
					response = JSON.parse(data);

					sessionStorage.currencies = JSON.stringify(response);
					currencies = response.data;
					init(response);
				});
				
			}else {
				console.log('session data loaded successfully!');
				let data = JSON.parse(sessionStorage['currencies']);
				currencies = data.data;
				setTimeout(() => {
					init(data);
				}, 10);
			}

			document.addEventListener('DOMContentLoaded', function () {
				window.Plyr && (new Plyr('#player-youtube'));
			});

			$(document).on('change', '#currency-code-selection', function() {
				
				currency_code = $('#currency-code-selection option:selected').val();
				let price = parseInt($('.selling-price').data('price'));
				let rate = (1 / currencies[currency_code]['value']);

				let converterPrice = ( price / rate );
				$('.selling-price').html('<span class=\"fs-12\">' + currencies[currency_code]['code'] + '</span> ' + parseFloat(converterPrice.toFixed(2)).toLocaleString() );
				$('.currency-code').text( currencies[currency_code]['code'] );
				$('.base-currency-value').html('' + currencies[currency_code]['code'] + ' ' + ( 1 / currencies[currency_code]['value']) );

				convertAmortization();
			});

			$(document).on('change', '#mortgage-downpayment-selection, #mortgage-interest-selection, #mortgage-years-selection', function() {
				result = getAmortization();
				monthly_dp = result.monthly_payment;
				convertAmortization();
			});

			$(document).on('focus', '#name, #email, #mobile_no, #message', function() {
				$('.hidden-fields').removeClass('d-none');
				$('#inquiry-form .btn-close').trigger('click');
			});

			$(document).on('click', '.btn-description-toggle', function() {
				$('.description').css('height', 'auto');
				$('.description').removeClass('border-bottom');
				$('.btn-description-toggle').remove();
			});

			$(document).on('click', '.btn-send-message', function() {

				let form = $('#inquiry-form');
				let url = form.attr('action');
				let formData = new FormData(document.querySelector('#inquiry-form'));
				let code = $('#security_code').val();

				formData.append('security_code', code);

				$('.loader-container').removeClass('d-none');
				$('#inquiry-form').hide();

				fetch('".url("ListingsController@validateMessageInput")."', {
					method: 'POST',
					body: new URLSearchParams(formData).toString()
				}).then( response => response.json() )
				.then( response => {

					if(response.status == 1) {

						setKeys()
							.then( () => {
								encrypt(JSON.stringify({
									'name': formData.get('name'),
									'message': formData.get('message'),
									'mobile_no': formData.get('mobile_no'),
									'email': formData.get('email')
								}), publicKey, privateKey)
									.then( data => {
										formData.append('content', data.encrypted);
										formData.append('iv', data.iv);

										fetch(url, { 
											method: 'POST', 
											body: new URLSearchParams(formData).toString()
										}).then(response => response.json())
											.then(response => {

												form.trigger('reset');
												$('.response').html(response.message);

												$('.loader-container').addClass('d-none');
												$('.hidden-fields').addClass('d-none');
												$('#inquiry-form').show();

												rng = random(1000, 9999);
												$('#security_code').val( rng );
												$('.valid-security-code').text( rng );
											});

										
									});
							});

					}else {
						$('.loader-container').addClass('d-none');
						$('#inquiry-form').show();
						$('.response').html(response.message);
					}

				});
			});

			$(document).on('show.bs.offcanvas', '#offcanvasEnd', function() {
				let form = $('.inquiry-form-container');
				$(this).addClass('px-4 pt-4 pb-1');
				
				$(this).append(\"<div class='d-flex justify-content-end'><span class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></span></div>\");
				$(this).append(form.clone());
				form.remove();

				agent = $('.property-agent-container');
				$('.send-message-agent-container').html(agent.clone());
				$('.send-message-agent-container .property-agent-container').addClass('mb-3 pb-3 border-bottom');
			});

			$(document).on('hide.bs.offcanvas', '#offcanvasEnd', function() {
				let form = $('#offcanvasEnd .inquiry-form-container');
				$(this).removeClass('px-4 pt-4');
				$('.sidebar .agent-form').html(form.clone());
				$(this).html('');

				$('.send-message-agent-container .property-agent-container').remove();
			});

			async function init(data) {

				let date = new Date(data.meta.last_updated_at).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute:'2-digit' });

				let html = '';
				for (let key in currencies) {
					if (currencies.hasOwnProperty(key)) {
						sel = currencies[key].code == 'PHP' ? 'selected' : '';
						html += \"<option value='\" + currencies[key].code + \"' \" + sel + \">\" + currencies[key].code + \"</option>\";
					}
				}

				$('#currency-code-selection').append(html);
				$('.last-updated-at').html( date );
				$('.base-currency-value').html('' + currencies.PHP['code'] + ' ' + ( 1 / currencies.USD['value']) );

				currency_code = $('#currency-code-selection option:selected').val();
				let price = parseInt($('.selling-price').data('price'));

				let converterPrice = ( price / ( 1 / currencies[currency_code]['value']) );
				$('.selling-price').html('<span class=\"fs-12\">' + currency_code + '</span> ' + parseFloat(converterPrice.toFixed(2)).toLocaleString() );

				result = getAmortization();
				monthly_dp = result.monthly_payment;
				convertAmortization();
			}

			function convertAmortization() {
				let converted_dp = (monthly_dp / (1 / currencies[currency_code]['value']));
				$('.monthly_dp').html('<span class=\"fs-12\">' + currency_code + '</span> ' + parseFloat((converted_dp.toFixed(2))).toLocaleString()  );
			}

		"));

		$listing = $this->getModel("Listing");
		$listing->column['name'] = $name;
		$listing->where(" status = 1 ");
		
		if(isset($_GET['mls'])) {
			$listing->and(" display = 1 AND is_mls = 1 ");
		}else {
			$listing->and(" display = 1 AND is_website = 1 ");
		}

		$data = $listing->getByName();

		if($data) {

			$fields = explode(",", "listing_id,address,lot_area,price,category");
			foreach($fields as $value) {
				$uri[$value] = $data[ $value ];
			}

			$account = $this->getModel("Account");
			$account->column['account_id'] = $data['account_id'];
			$account_data = $account->getById();
			$data['listing_owner'] = $account_data;

			/** HANDSHAKED LISTINGS SHOW REQUESTOR DATA */
			if(isset($_GET['ref'])) {
				$ref_id = base64_decode($_GET['ref']);
				$account->column['account_id'] = $ref_id;
				$account_data = $account->getById();
			}

			/** REMOVE CONTACT INFO AND NAME FROM DESCRIPTION OF LISTING OWNER */
			$data['long_desc'] = removePhoneNumberFromString($data['long_desc'], "");
			$data['long_desc'] = removeEmailFromString($data['long_desc'], "");
			$data['long_desc'] = removeUrlFromString($data['long_desc'], "");
			$data['long_desc'] = str_ireplace($data['listing_owner']['account_name'], "", $data['long_desc']);
			$data['long_desc'] = str_ireplace($data['listing_owner']['real_estate_license_number'], "", $data['long_desc']);

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

				$(document).ready(function() {
					$('.barangay-selection').remove();

					result = getAmortization();
					$('.monthly_dp').html('&#8369; ' + result.monthly_payment_formated);

					if($('.description').height() > 300) {
						$('.description').addClass('border-bottom');
						$('.btn-description-toggle').removeClass('d-none');
					}

					$.get('".url("ListingsController@relatedProperties")."', ".json_encode($uri).", function(data) {
						$('.related-properties-container').html(data);

						$('.listings-table .avatar').each(function() {
							thumb_image = $(this).attr('data-thumb-image');
							$(this).css('background-image', 'url(".CDN."images/item_default.jpg)');
							getImage(thumb_image, $(this));
						});

					});

					$.post('".url("SessionController@saveTraffic")."', {
						'type': 'listing',
						'name': '".$data['title']."',
						'id': ".$data['listing_id'].",
						'url': '".url()."',
						'source': 'Website',
						'account_id': ".$account_data['account_id'].",
						'client_info': {
							'userAgent': userClient.userAgent,
							'geo': userClient.geo,
							'browser': userClient.browser
						},
						'csrf_token': '".csrf_token()."'
					});

				});

				async function setKeys() {
					privateKey = ".json_encode($account_data['message_keys']['privateKey']).";
					publicKey = ".json_encode($account_data['message_keys']['publicKey']).";
				}

				async function getImage(thumb_image, element) {
					await fetch('".url("ListingsController@getThumbnail")."?url=' + thumb_image)
						.then( response => response.json() )
						.then(  (data) => {
							element.css('background-image', 'url('+data.url+')');
						});
					
				}

			"));

			$images = $this->getModel("ListingImage");
			$images->page['limit'] = 50;
			$images->column['listing_id'] = $data['listing_id'];
			$images->and(" filename != '".basename($data['thumb_img'])."'");
			$data['images'] = $images->getByListingId();

			$data['page_title'] = $data['title'];
			$data['page_description'] = "P".number_format($data['price'],0)." ".$data['type']." ".$data['category']." in ".$data['address']['municipality']." ".$data['address']['province']." with land area of ".$data['lot_area'];
			$data['page_image'] = $data['thumb_img'];

			$this->doc->setTitle($data['page_title']);
			$this->doc->setDescription($data['page_description']);
			$this->doc->setMetaData("keywords", $data['page_description']);

			$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
			$this->doc->setFacebookMetaData("og:title", $data['page_title']);
			$this->doc->setFacebookMetaData("og:type", "website");
			$this->doc->setFacebookMetaData("og:image", $data['page_image']);
			$this->doc->setFacebookMetaData("og:description", $data['page_description']);
			$this->doc->setFacebookMetaData("og:updated_time", $data['modified_at']);
			
			$data['account'] = $account_data;

			$this->setTemplate("listings/view.php");
			return $this->getTemplate($data, $listing);

		}

		$this->response(404);

	}

	function comparativeAnalysis($uri) {

		$title = "Compartive Analysis Table ". CONFIG['site_name'];
		$description = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", CDN."images/real-estate.jpg");
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", date("Y-m-d" , DATE_NOW));

		parse_str(urldecode(base64_decode($uri)), $_GET);
		$this->doc->setTitle("MLS System - Comparative Analysis Table");

		$this->doc->addStyleDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			.page-body {
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
		"));
		
		$total = 0;
		if(isset($_GET['id']) && isset($_GET['expiration'])) {
			$_GET['id'] = json_decode($_GET['id'], true);
			$total = count($_GET['id']);
		}

		if(\DateTime::createFromFormat('Y-m-d', $_GET['expiration']) !== false || $total <= 0) {
			$this->response(404);
		}

		if(DATE_NOW < $_GET['expiration']) {
			$this->response(404);
		}

		$account = $this->getModel("Account");
		$account->select(" account_id, account_name, board_region, local_board_name, email, mobile_number, profession, real_estate_license_number, logo, company_name, registered_at ");
		$account->column['account_id'] = $_GET['account_id'];
		$data['account'] = $account->getById();

		$listing = $this->getModel("Listing");
		$listing->page['limit'] = 20;
		$data['listing'] = $listing->where(" listing_id IN(".implode(",", $_GET['id']).") ")->getList();

		$this->setTemplate("listings/comparative.php");
		return $this->getTemplate($data,$listing);

	}

	function validateMessageInput() {

		parse_str(file_get_contents('php://input'), $_POST);

		$v = $this->getLibrary("Validator");

		$v->validateGeneral($_POST['name'], "Your name is required.");
		$v->validateEmail($_POST['email'], "Provide a valid email address.");
		$v->validateMobileNumber($_POST['mobile_no'], "Provide a valid Philippine mobile number.");
		$v->validateGeneral($_POST['message'], "Your message is required.");
		$v->confirmPassword($_POST['input_security_code'], $_POST['security_code'], "Invalid Security Code");

		if($v->foundErrors()) {
			$message = "<br/> ". $v->listErrors("<br/> ");

			$this->getLibrary("Factory")->setMsg($message, "error");

			echo json_encode(array(
				"status" => (int) 2,
				"message" => getMsg()
			));
		}else {
			echo json_encode(array(
				"status" => (int) 1
			));
		}

		exit();

	}

	function sendMessage($listing_id) {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['inquire_at'] = DATE_NOW;
		$_POST['preferences'] = json_encode($_POST['preferences']);

		$leads = $this->getModel("Lead");
		$response = $leads->saveNew($_POST);

		$notification = $this->getModel("Notification");
		$notification->saveNew([
			"account_id" => $_POST['account_id'],
			"status" => 1,
			"created_at" => DATE_NOW,
			"content" => [
				"title" => "New Leads",
				"message" => $_POST['name']." inquired about ".$_POST['title'],
				"url" => MANAGE."leads/".$response['id']
			]
		]);
		
		$mail = $this->getLibrary("Mailer");
			$mail
				->build($this->mailLeads($_POST))
					->send([
						"to" => [
							$_POST['account_email']
						]
					], "You have new leads - " . CONFIG['site_name']);

		
		$this->getLibrary("Factory")->setMsg("<br/>Your message has been sent!", $response['type']);

		echo json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

		exit();

	}

	function mailLeads($data) {
		$this->setTemplate("listings/MAIL_leads.php");
		return $this->getTemplate($data);
	}

	function relatedProperties() {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 10;
		$listings->app = [
			"handshaked" => false,
			"comparative" => false,
			"url_path" => [
				"path" => "name",
				"value" => "name",
				"class_hint" => "ListingsController@view"
			]
		];
		
		$filters[] = " listing_id != ".$_GET['listing_id'];
		$filters[] = " l.status = 1";
		$filters[] = " display = 1";
		$filters[] = " is_website = 1";

		$response = parent::listProperties($listings, $filters);

		$this->setTempalteBasePath(ROOT."/Admin");
		$this->setTemplate("listings/listProperties.php");
		return $this->getTemplate($response['data'],$response['model']);

	}

}