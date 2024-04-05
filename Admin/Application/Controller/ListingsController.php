<?php

namespace Admin\Application\Controller;

class ListingsController extends \Main\Controller {
	
	public $doc;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();

		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");

	}

	function index($account_id) {

		if(!isset($this->session['permissions']['properties']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Property Listings");
	
		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();

		$filters[] = " account_id = $account_id ";
		$filters[] = " status IN(0, 1) ";
		
		$listing = $this->getModel("Listing");
		$listing->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" modified_at DESC ");
		
		$listing->page['limit'] = 20;
		$listing->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listing->page['target'] = url("ListingsController@index");
		$listing->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['listings'] = $listing->getList();

		$this->setTemplate("listings/listings.php");
		return $this->getTemplate($data,$listing);
		
	}
	
	function edit($account_id, $listing_id) {

		if(!isset($this->session['permissions']['properties']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

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
			
			$(document).on('change', '#is_mls_local_board, #is_mls_local_region, #is_mls_all', function() {
				if(this.checked) {
					$('#is_mls').prop('checked', true);
				}
			})

			$(document).on('change', '#status', function() {
				if($('#status option:selected').val() == 2) {
					$('.sold-price-input').removeClass('d-none');
				}else {
					$('.sold-price-input').addClass('d-none');
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
		
		if($data['listing']) {

			$listingImage = $this->getModel("ListingImage");
			$listingImage->column['listing_id'] = $listing_id;
			$data['listing']['images'] = $listingImage->getByListingId();

			$this->setTemplate("listings/edit.php");
			return $this->getTemplate($data,$listing);
		}

		$this->response(404);
		
	}
	
	function add($account_id) {

		if(!$this->session['permissions']['properties']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

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

			$(document).on('change', '#is_mls_local_board, #is_mls_local_region, #is_mls_all', function() {
				if(this.checked) {
					$('#is_mls').prop('checked', true);
				}
			})
		");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();

		$listing = $this->getModel("Listing");
		
		$listing->select(" COUNT(listing_id) AS total ");
		$listing->column['account_id'] = $account_id;
		$listing->and(" status = 1 ");
		$data['listings'] = $listing->getByAccountId();

		$subscription = $this->getModel("AccountSubscription");
		$subscription->column['account_id'] = $account_id;
		$privileges = $subscription->getSubscription();

		if($privileges === false) {
			$data['privileges'] = $data['privileges'];
		}else {
			$data['privileges'] = $privileges;
		}

		if($data['privileges']['max_post'] <= $data['listings'][0]['total']) {
			$this->getLibrary("Factory")->setMsg("Maximum postings have been reached. You cannot add any more property listings. Subscribe to our premium package to increase your maximum postings allowance", "warning");
			if($_SESSION['domain'] == ADMIN) {
				response()->redirect(url("ListingsController@index",["id" => $data['account_id']]));
			}else {
				response()->redirect(url("ListingsController@listingIndex"));
			}
		}else {

			$listing->addresses = $this->getModel("Address");

			$this->setTemplate("listings/add.php");
			return $this->getTemplate($data, $listing);
			
		}
		
	}

	function view($listing_id) {

		if(!$this->session['permissions']['properties']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("View Property Listing");

		$this->doc->addScript(CDN."js/amortization.js");
		$this->doc->addScript(CDN."tabler/dist/libs/plyr/dist/plyr.min.js");
		$this->doc->addStylesheet(CDN."tabler/dist/libs/plyr/dist/plyr.css");

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $listing_id;
		
		$data['listing'] = $listing->getById();

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

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

			$(document).ready(function() {
				
				if($('.description').height() > 300) {
					$('.description').addClass('border-bottom');
					$('.btn-description-toggle').removeClass('d-none');
				}

				$.get('".url("MlsController@relatedProperties")."', ".json_encode($data['listing']).", function(data) {
					$('.related-properties-container').html(data);
				})

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
			
			document.addEventListener('DOMContentLoaded', function () {
				window.Plyr && (new Plyr('#player-youtube'));
			});

			$(document).on('change', '#mortgage-downpayment-selection, #mortgage-interest-selection, #mortgage-years-selection', function() {
				result = getAmortization();
				monthly_dp = result.monthly_payment;
				convertAmortization();
			});

			$(document).on('click', '.btn-description-toggle', function() {
				$('.description').css('height', 'auto');
				$('.description').removeClass('border-bottom');
				$('.btn-description-toggle').remove();
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
		
		if($data) {

			$account = $this->getModel("Account");
			$account->select(" account_id, logo, profession, real_estate_license_number, account_name, mobile_number, email, registered_at");
			$account->column['account_id'] = $data['listing']['account_id'];
			$data['account'] = $account->getById();

			$listingImage = $this->getModel("ListingImage");
			$listingImage->page['limit'] = 100;
			$listingImage->column['listing_id'] = $listing_id;
			$listingImage->and(" filename != '".basename($data['listing']['thumb_img'])."' ");
			$data['listing']['images'] = $listingImage->getByListingId();

			if(!$data['listing']['images']) {
				$data['listing']['images'] = [];
			}

			$handshake = $this->getModel("Handshake");
			$handshake->column['requestor_account_id'] = $_SESSION['user_logged']['account_id'];
			$handshake->and(" listing_id = ".$listing_id." AND handshake_status NOT IN('done','cancel','denied')");
			$data['handshake'] = $handshake->getByRequestorAccountId();

			if($data['listing']['account_id'] !== $this->session['account_id']) {
				$this->saveTraffic([
					"type" => "listing",
					"name" => $data['listing']['title'],
					"id" => $listing_id,
					"url" => rtrim(MANAGE, '/') . url("MLSController@view", ["id" => $listing_id]),
					"account_id" => $data['account']['account_id'],
					"source" => "mls"
				]);
			}

			$this->setTemplate("listings/view.php");
			return $this->getTemplate($data,$listing);
		}

		$this->response(404);
		
	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);
		
		$_POST['name'] = sanitize($_POST['title']);
		$_POST['created_at'] = DATE_NOW;
		$_POST['modified_at'] = DATE_NOW;
		$_POST['thumb_img'] = $_POST['thumb_img'] != "" ? CDN."/images/listings/".$_POST['thumb_img'] : null;
		$_POST['foreclosed'] = isset($_POST['foreclosed']) ? $_POST['foreclosed'] : 0;
		$_POST['is_mls'] = isset($_POST['is_mls']) ? $_POST['is_mls'] : 0;
		$_POST['is_website'] = isset($_POST['is_website']) ? $_POST['is_website'] : 0;
		
		$_POST['payment_details'] = json_encode([
			"option_money_duration" => $_POST['payment_details']['option_money_duration'],
			"payment_mode" => $_POST['payment_details']['payment_mode'],
			"tax_allocation" => $_POST['payment_details']['tax_allocation'],
			"bank_loan" => isset($_POST['payment_details']['bank_loan']) ? 1 : 0,
			"pagibig_loan" => isset($_POST['payment_details']['pagibig_loan']) ? 1 : 0,
			"assume_balance" => isset($_POST['payment_details']['assume_balance']) ? 1 : 0
		]);

		$_POST['other_details'] = json_encode([
			"authority_type" => $_POST['authority_type'],
			"authority_to_sell_expiration" => strtotime($_POST['authority_to_sell_expiration']),
			"com_share" => $_POST['com_share']
		]);
		
		if(isset($_POST['address'])) { $_POST['address'] = json_encode($_POST['address']); }
		if(isset($_POST['tags'])) { $_POST['tags'] = json_encode($_POST['tags']); }
		if(isset($_POST['amenities'])) {$_POST['amenities'] = implode(",",$_POST['amenities']); }

		$_POST['is_mls_option'] = json_encode([
			"local_board" => isset($_POST['mls_local_board']) ? 1 : 0,
			"local_region" => isset($_POST['mls_local_region']) ? 1 : 0,
			"all" => isset($_POST['mls_all']) ? 1 : 0
		]);
	
		$listing = $this->getModel("Listing");
		$response = $listing->saveNew($_POST);

		if($response['status'] == 1) {

			if(isset($_POST['listing_image_filename'])) {
				$listingImage = $this->getModel("ListingImage");
				$_POST['image_score'] = $listingImage->saveImages($response['id'],$_POST['listing_image_filename']);
				
				unset($_POST['listing_image_url']);
				unset($_POST['listing_image_filename']);
			}

		}

		$_POST["posting_score"] = $this->computeScore($_POST);

		$listing->save($response['id'], $_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function saveUpdate($id) {

		parse_str(file_get_contents('php://input'), $_POST);

		if($_POST['status'] == 1) {
			$listing = $this->getModel("Listing");
			$listing->select(" COUNT(listing_id) as total ")->where(" account_id = $id AND status = 1 ");
			$total_listing = $listing->getList();

			if($total_listing[0]['total'] >= $_SESSION['user_logged']['privileges']['max_post']) {
				$this->getLibrary("Factory")->setMsg("This account has already reached the maximum number of listings; therefore, the property cannot activate", "warning");

				return json_encode(
					array(
						"status" => 2,
						"message" => getMsg()
					)
				);
			}
		}
		
		$_POST['name'] = sanitize($_POST['title']);
		$_POST['modified_at'] = DATE_NOW;
		$_POST['thumb_img'] = $_POST['thumb_img'] != "" ? CDN."images/listings/".$_POST['thumb_img'] : null;
		$_POST['foreclosed'] = isset($_POST['foreclosed']) ? 1 : 0;
		$_POST['is_mls'] = isset($_POST['is_mls']) ? 1 : 0;
		$_POST['is_website'] = isset($_POST['is_website']) ? 1 : 0;

		$_POST['payment_details'] = json_encode([
			"option_money_duration" => $_POST['payment_details']['option_money_duration'],
			"payment_mode" => $_POST['payment_details']['payment_mode'],
			"tax_allocation" => $_POST['payment_details']['tax_allocation'],
			"bank_loan" => isset($_POST['payment_details']['bank_loan']) ? 1 : 0,
			"pagibig_loan" => isset($_POST['payment_details']['pagibig_loan']) ? 1 : 0,
			"assume_balance" => isset($_POST['payment_details']['assume_balance']) ? 1 : 0
		]);
		
		$_POST['other_details'] = json_encode([
			"authority_type" => $_POST['authority_type'],
			"authority_to_sell_expiration" => strtotime($_POST['authority_to_sell_expiration']),
			"com_share" => $_POST['com_share']
		]);

		$_POST['is_mls_option'] = json_encode([
			"local_board" => isset($_POST['mls_local_board']) ? 1 : 0,
			"local_region" => isset($_POST['mls_local_region']) ? 1 : 0,
			"all" => isset($_POST['mls_all']) ? 1 : 0
		]);

		if(isset($_POST['address'])) { $_POST['address'] = json_encode($_POST['address']); }
		if(isset($_POST['tags'])) { $_POST['tags'] = json_encode($_POST['tags']); }
		if(isset($_POST['amenities'])) {$_POST['amenities'] = implode(",",$_POST['amenities']); }

		if(isset($_POST['listing_image_filename'])) {
			$listingImage = $this->getModel("ListingImage");
			$_POST['image_score'] = $listingImage->saveImages($id,$_POST['listing_image_filename']);
		}

		$_POST['posting_score'] = $this->computeScore($_POST);

		$listing = $this->getModel("Listing");
		unset($_POST['listing_image_filename']);
		$response = $listing->save($id,$_POST);

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

		if(!$this->session['permissions']['properties']['delete']) {
			$this->getLibrary("Factory")->setMsg("You do not have permissions to access this content.", "warning");
			return getMsg();
		}

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

	function setFeatured($id) {

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data = $listing->getById();
		
		if($data) {

			if(isset($_GET['is_featured'])) {

				$listing = $this->getModel("Listing");
				$listing->select(" COUNT(*) as total ");
				$listing->where(" account_id = ".$data['account_id']." ");
				$listing->and(" status = 1 AND featured = 1 ");
				$total = $listing->getList();

				if($this->session['privileges']['featured_ads'] > $total[0]['total']) {
					$response = [
						"type" => "error",
						"message" => " Maximum Featured Ads has been reached, you cannot continue setting this as featured ads "
					];
				}else {

					$listing = $this->getModel("Listing");
					$listing->save($id, [
						"name" => $data['name'],
						"category" => $data['category'],
						"type" => $data['type'],
						"offer" => $data['offer'],
						"other_details" => json_encode($data['other_details']),
						"address" => json_encode($data['address']),
						"featured" => $_GET['is_featured']
					]);

					$response = [
						"type" => "success",
						"message" => "Listing featured setting successfully save!"
					];
				}

				$this->getLibrary("Factory")->setMsg($response['message'], $response['type']);

				return json_encode([
					"status" => 1,
					"featured" => $_GET['is_featured'],
					"message" => getMsg()
				]);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Property listing not found.","warning");
		}

		$this->setTemplate("listings/featured.php");
		return $this->getTemplate($data);

	}

	function soldSettings($id) {

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data = $listing->getById();
		
		if($data) {

			$this->setTemplate("listings/sold.php");
			return $this->getTemplate($data);

		}else {
			$this->getLibrary("Factory")->setMsg("Property listing not found.","warning");
			
			return json_encode([
				"status" => 1,
				"message" => getMsg()
			]);

		}

	}

	function setSold($id) {

		parse_str(file_get_contents('php://input'), $_POST);

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $id;
		$data = $listing->getById();

		$response = $listing->save($id,[
			"name" => $data['name'],
			"category" => $data['category'],
			"type" => $data['type'],
			"offer" => $data['offer'],
			"other_details" => json_encode($data['other_details']),
			"address" => json_encode($data['address']),
			"sold_price" => $_POST['sold_price'],
			"status" => 2,
			"featured" => 0,
			"is_website" => 0,
			"is_mls" => 0,
			"modified_at" => DATE_NOW
		]);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function listProperties(\Main\Model\ListingModel $model, $filters = []) {

		if(isset($_GET['offer']) && $_GET['offer'] == "buy") {
			$filters[] = " offer = 'for sale'";
			$model->page['uri']['offer'] = "for sale";
		}

		if(isset($_GET['offer']) && $_GET['offer'] == "rent") {
			$filters[] = " offer = 'for rent'";
			$model->page['uri']['offer'] = "for rent";
		}

		if(isset($_GET['category']) && $_GET['category'] != "") {
			$model->page['uri']['category'] = $_GET['category'];
			$filters[] = " category LIKE '%".$_GET['category']."%'";
			$search[] = $_GET['category'];
		}

		if(isset($_GET['price']) && $_GET['price'] != "") {
			$model->page['uri']['price'] = $_GET['price'];
			$filters[] = "price >= ".$_GET['price']."";
		}

		if(isset($_GET['lot_area']) && $_GET['lot_area'] != "") {
			$model->page['uri']['lot_area'] = $_GET['lot_area'];
			$filters[] = "lot_area >= ".$_GET['lot_area']."";
		}

		if(isset($_GET['floor_area']) && $_GET['floor_area'] != "") {
			$model->page['uri']['floor_area'] = $_GET['floor_area'];
			$filters[] = "floor_area >= ".$_GET['floor_area']."";
		}

		if(isset($_GET['bedroom']) && $_GET['bedroom'] != "") {
			$model->page['uri']['bedroom'] = $_GET['bedroom'];

			if($_GET['bedroom'] == "Studio") {
				$filters[] = " bedroom = '".$_GET['bedroom']."'";
			}else {
				$filters[] = " bedroom >= ".$_GET['bedroom'];
			}
		}

		if(isset($_GET['bathroom']) && $_GET['bathroom'] != "") {
			$model->page['uri']['bathroom'] = $_GET['bathroom'];
			$filters[] = " bathroom >= ".$_GET['bathroom'];
		}

		if(isset($_GET['parking']) && $_GET['parking'] != "") {
			$model->page['uri']['parking'] = $_GET['parking'];
			$filters[] = "parking >= ".$_GET['parking']."";
		}

		if(isset($_GET['address']) && $_GET['address'] != "") {
			$model->page['uri']['address'] = $_GET['address'];

			if(isset($_GET['address']['region']) && $_GET['address']['region'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.region') = '".$_GET['address']['region']."'  ";
				$search[] = $_GET['address']['region'];
			}

			if(isset($_GET['address']['province']) && $_GET['address']['province'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.province') = '".$_GET['address']['province']."'  ";
				$search[] = $_GET['address']['province'];
			}

			if(isset($_GET['address']['municipality']) && $_GET['address']['municipality'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.municipality') = '".$_GET['address']['municipality']."'  ";
				$search[] = $_GET['address']['municipality'];
			}

			if(isset($_GET['address']['street']) && $_GET['address']['street'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.street') = '".$_GET['address']['street']."'  ";
				$search[] = $_GET['address']['street'];
			}

			if(isset($_GET['address']['village']) && $_GET['address']['village'] != "") {
				$filters[] = " JSON_EXTRACT(l.address, '$.village') = '".$_GET['address']['village']."'  ";
				$search[] = $_GET['address']['village'];
			}

			if(!is_array($_GET['address'])) {
				$search[] = trim($_GET['address']);
			}

		}

		if(isset($_GET['amenities']) && $_GET['amenities'] != "") {
			
			if(!is_array($_GET['amenities'])) {
				$_GET['amenities'] = explode(",", $_GET['amenities']);
			}

			$model->page['uri']['amenities'] = $_GET['amenities'];
			$search[] = implode(" ", $_GET['amenities']);
			
		}

		if(isset($_GET['tags']) && $_GET['tags'] != "") {
			$model->page['uri']['tags'] = $_GET['tags'];
			$search[] = implode(" ", $_GET['tags']);
		}

		$order = isset($_GET['order']) ? $_GET['order'] : " DESC";

		if(isset($search)) {
			$model->select("
				listing_id, l.account_id, is_website, is_mls, is_mls_option, offer, foreclosed, name, price, floor_area, lot_area, bedroom, bathroom, parking, thumb_img, modified_at, l.status, display, type, title, tags, long_desc, category, l.address, amenities,
				CASE WHEN DATE(from_unixtime(modified_at)) >= DATE(NOW() - INTERVAL 7 DAY) THEN post_score + (1/14) END,
				MATCH( type, title, tags, long_desc, category, l.address, amenities )
				AGAINST( '" . implode(" ", $search) . "' IN BOOLEAN MODE ) AS match_score
			")->orderby(" match_score DESC, post_score DESC ");
		}else {
			$sort = isset($_GET['sort']) ? ($_GET['sort'] == "match_score" ? "post_score" : $_GET['sort']) : "post_score";
			$model
				->select(" 
					listing_id, l.account_id, is_website, is_mls, is_mls_option, offer, foreclosed, name, price, floor_area, lot_area, bedroom, bathroom, parking, thumb_img, modified_at, l.status, display, type, title, tags, long_desc, category, l.address, amenities,
					CASE WHEN DATE(from_unixtime(modified_at)) >= DATE(NOW() - INTERVAL 7 DAY) THEN post_score + (1/14) END 
				")->orderby(" $sort $order ");
		}
		
		$model->join(" l JOIN #__accounts a ON a.account_id = l.account_id ");
		$model->where((isset($filters) ? implode(" AND ",$filters) : null));
		$data = $model->getList();

		if($data) {

			$total_listing = count($data);

			for($i=0; $i<$total_listing; $i++) {

				$images = $this->getModel("ListingImage");
				$images->page['limit'] = 50;

				$images->column['listing_id'] = $data[$i]['listing_id'];
				$total_image = $images->getByListingId();
				
				$data[$i]['total_images'] = 0;

				if($total_image) {
					$data[$i]['total_images'] = count($total_image);
				}
				
			}

		}

		return [
			"data" => $data,
			"model" => $model
		];

	}

	private function computeScore($data) {

		$fields_with_score = [
			"title", "tags", "long_desc", "category", "address", "price", "reservation", 
			"payment_details", "lot_area", "thumb_img", "video", "amenities ", "other_details ", "modified_at" 
		];

		$score = $data['image_score'];
		$field_score = 0;

		foreach($data as $field => $value) {
			switch($field) {
				case 'amenities':
					if(strripos($value, ",") !== false) {
						$amenities = explode(",",$value);
						$field_score += count($amenities) / 10;
					}
					break;

				case 'address':
					$address = json_decode($value, true);
					if($address['municipality'] != "") { $field_score += (1 / 6); }
					if($address['barangay'] != "") { $field_score += (1 / 6); }
					if($address['street'] != "") { $field_score += (1 / 6); }
					if($address['village'] != "") { $field_score += (1 / 6); }

					/** region and province are not scoreable */
					break;

				case 'payment_details':
					$payment_details = json_decode($value, true);
					if($payment_details['option_money_duration'] != "" || $payment_details['option_money_duration'] > 0) { $field_score += (1 / 3); }
					if($payment_details['payment_mode'] != "") { $field_score += (1 / 3); }
					if($payment_details['tax_allocation'] != "") { $field_score += (1 / 3); }

					/** bank_loan, pagibig_loan, assume_balance are not scoreable */
					break;

				case 'other_details':
					$other_details = json_decode($value, true);
					if($other_details['authority_type'] != "") { $field_score += (1 / 3); }
					if($other_details['authority_to_sell_expiration'] != "") { $field_score += (1 / 3); }
					if($other_details['com_share'] != "") { $field_score += (1 / 3); }
					break;

				default:
                    if(in_array($field, $fields_with_score)) {
						if($value != "") { 
							$field_score += (1 / count($fields_with_score));
						}
                    }
                    break;
			}
		}

		return $score + $field_score;

	}

	public function saveTraffic($data) {

		$traffic = $this->getModel("Traffic");
		$traffic->select(" session_id, JSON_EXTRACT(traffic, '$.name') as name ");
		$traffic->column['session_id'] = $this->getLibrary("SessionHandler")->get("id");
		
		$response = $traffic->getBySessionId();

		if($response) {
			for($i=0; $i<count($response); $i++) {
				$arr[$response[$i]['session_id']][] = $response[$i]['name'];
			}
		}

		if(!isset($arr[ $traffic->column['session_id'] ]) || !in_array($data['name'], $arr[ $traffic->column['session_id'] ]) || !$response) {
			$traffic->select("");
			$traffic->saveNew(array(
				"traffic" => json_encode([
					"type" => $data['type'],
					"name" => $data['name'],
					"id" => $data['id'],
					"url" => $data['url'],
					"source" => $data['source']
				]),
				"account_id" => $data['account_id'],
				"session_id" => $this->getLibrary("SessionHandler")->get("id"),
				"created_at" => DATE_NOW,
				"user_agent" => json_encode($this->getLibrary("SessionHandler")->get("user_agent"))
			));
		}

	}
	
}