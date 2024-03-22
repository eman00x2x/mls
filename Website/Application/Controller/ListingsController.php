<?php

namespace Website\Application\Controller;

class ListingsController extends \Admin\Application\Controller\ListingsController {

	function __construct() {
		parent::__construct();
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

		$filters[] = " is_website = 1 ";
		$filters[] = " l.status = 1 ";
		$filters[] = " display = 1 ";

		$uri['offer'] = $offer;

		$address = $this->getModel("Address");
		$listings = $this->getModel("Listing");
		$listings->address = $address->addressSelection((isset($_GET['address']) ? $_GET['address'] : null));

		$listings->page['limit'] = 20;
		$listings->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listings->page['target'] = url("ListingsController@$offer");
		$listings->page['uri'] = (isset($uri) ? $uri : []);

		$listings->app = [
			"handshaked" => false,
			"comparative" => false,
			"featured_post" => true,
			"url_path" => [
				"path" => "name",
				"value" => "name",
				"class_hint" => "ListingsController@view"
			]
		];

		$response = $this->listProperties($listings, $filters);
		
		$this->setTempalteBasePath(ROOT."Admin");
		$this->setTemplate("listings/listProperties.php");
		$listings->list = $this->getTemplate($response['data'],$response['model']);

		$this->setTempalteBasePath(ROOT."Website");
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

				currency_codes = '&currencies[]=EUR&currencies[]=USD&currencies[]=PHP&currencies[]=JPY&currencies[]=AUD';
				currency_codes += '&currencies[]=BHD&currencies[]=CAD&currencies[]=ILS&currencies[]=KRW&currencies[]=KWD';
				currency_codes += '&currencies[]=SGD&currencies[]=THB&currencies[]=AED&currencies[]=GBP&currencies[]=CNY';
				
				fetch('https://api.currencyapi.com/v3/latest?base_currency=PHP' + currency_codes, {
					method: 'GET',
					headers: {
						'apikey': 'cur_live_va2sfTCkkZypiRPLMmH3vJy5tG7rd2POwtSfLY6R'
					}
				})
					.then( res => res.json() )
						.then( data => {
							/* localStorage.setItem('currencies', JSON.Stringify(data)); */

							sessionStorage.currencies = JSON.stringify(data);
							currencies = data.data;
							init(data);
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

			$(document).on('focus', '#name, #email', function() {
				$('.hidden-fields').removeClass('d-none');
			});

			$(document).on('click', '.btn-description-toggle', function() {
				$('.description').css('height', 'auto');
				$('.description').removeClass('border-bottom');
				$('.btn-description-toggle').remove();
			});

			$(document).on('click', '.btn-send-message', function() {

				$('.error-message').addClass('d-none');
				$('.security-message').addClass('d-none');
				$('.success-message').addClass('d-none');

				let name = $('#name').val();
				let email = $('#email').val();
				let mobile_no = $('#mobile_no').val();
				let message = $('#message').val();
				let input_security_code = $('#input_security_code').val();
				let code = $('#input_security_code').data('code');

				if(name == '' || email == '' || mobile_no == '' || message == '') {
					$('.error-message').removeClass('d-none');
				}else if(input_security_code != code) {
					$('.security-message').removeClass('d-none');
				}else {

					let form = $('#inquiry-form');
					let url = form.attr('action');
					let formData = new FormData(document.querySelector('#inquiry-form'));
					
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
											$('.success-message').removeClass('d-none');
											form.trigger('reset');
											$('#input_security_code').val('');
											console.log(response);
										});

									
								});
						});

				}
				
					
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
				$('.sidebar .card-body').html(form.clone());
				$(this).html('');

				$('.send-message-agent-container .property-agent-container').remove();
			});

			async function init(data) {

				let date = new Date(data.meta.last_updated_at);

				let html = '';
				for (let key in currencies) {
					if (currencies.hasOwnProperty(key)) {
						sel = currencies[key].code == 'PHP' ? 'selected' : '';
						html += \"<option value='\" + currencies[key].code + \"' \" + sel + \">\" + currencies[key].code + \"</option>\";
					}
				}

				$('#currency-code-selection').append(html);
				$('.last-updated-at').html( date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) );
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

			$account = $this->getModel("Account");
			$account->column['account_id'] = $data['account_id'];
			$data['account'] = $account->getById();

			$this->doc->addScriptDeclaration("

				$(document).ready(function() {
					$('.barangay-selection').remove();

					result = getAmortization();
					$('.monthly_dp').html('&#8369; ' + result.monthly_payment_formated);

					if($('.description').height() > 300) {
						$('.description').addClass('border-bottom');
						$('.btn-description-toggle').removeClass('d-none');
					}

					$.get('".url("ListingsController@relatedProperties")."', ".json_encode($data).", function(data) {
						$('.related-properties-container').html(data);
					})

				});

				async function setKeys() {
					let keys = await generateKey();
					privateKey = keys.privateKey;
					publicKey = ".json_encode($data['account']['message_keys']['publicKey']).";
				}

			");

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

			$this->doc->setFacebookMetaData("og:url", url());
			$this->doc->setFacebookMetaData("og:title", $data['page_title']);
			$this->doc->setFacebookMetaData("og:type", "website");
			$this->doc->setFacebookMetaData("og:image", $data['page_image']);
			$this->doc->setFacebookMetaData("og:description", $data['page_description']);
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
		$account->select(" account_id, account_name, board_region, local_board_name, email, mobile_number, profession, real_estate_license_number, logo, company_name, registration_date ");
		$account->column['account_id'] = $_GET['account_id'];
		$data['account'] = $account->getById();

		$listing = $this->getModel("Listing");
		$listing->page['limit'] = 20;
		$data['listing'] = $listing->where(" listing_id IN(".implode(",", $_GET['id']).") ")->getList();

		$this->setTemplate("listings/comparative.php");
		return $this->getTemplate($data,$listing);

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

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		echo json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

		exit();

	}

	function relatedProperties($app = [], $filters = []) {
		
		$filters[] = " listing_id != ".$_GET['listing_id'];
		$filters[] = " l.status = 1";
		$filters[] = " display = 1";
		$filters[] = " is_website = 1";

		$this->setTempalteBasePath(ROOT."Admin");
		return parent::relatedProperties([
			"handshaked" => false,
			"comparative" => false,
			"url_path" => [
				"path" => "name",
				"value" => "name",
				"class_hint" => "ListingsController@view"
			]
		], $filters);
		
	}

	
}