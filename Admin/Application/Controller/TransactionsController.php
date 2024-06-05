<?php

namespace Admin\Application\Controller;

Use Library\PayPal as PayPal;
Use Library\XendIt as XendIt;
use Library\Mailer;

class TransactionsController extends \Main\Controller {

    public	$doc;
	public $session;

	public $validation_url;
	public $payment_status_url;

	function __construct()  {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

    function index() {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Transactions");

		if(isset($_REQUEST['date'])) {

			switch($_REQUEST['date']) {
				case 'today':
					$q = " created_at >= '".strtotime(date("Y-m-d",DATE_NOW))."' ";
					break;

				case 'this-week':

					$day = date('w');
					$week_start = strtotime(date('Y-m-d', strtotime('-'.$day.' days')));
					$week_end = strtotime(date('Y-m-d', strtotime('+'.(6-$day).' days')));

					$q = " created_at >= '$week_start' AND  created_at <= '$week_end' ";
					break;

				case 'this-month':

					$first_day = strtotime(date('Y-m-01', DATE_NOW));
					$last_day = strtotime(date('Y-m-t', DATE_NOW));

					$q = " created_at >= '$first_day' AND  created_at <= '$last_day' ";
					break;

				case 'this-year':
					$first_day_of_year = strtotime("01/01");
					$last_day_of_year = strtotime("12/31");

					$q = " created_at >= '$first_day_of_year' AND  created_at <= '$last_day_of_year' ";
					break;

				case 'last-7-days':
					$last_7_days = strtotime("-7 days", DATE_NOW);
					$q = " created_at >= '$last_7_days' AND  created_at <= '".DATE_NOW."' ";
					break;

				case 'last-month': 
					$last_month = strtotime("-1 month", DATE_NOW);
					$first_day_last_month = strtotime(date('Y-m-01', $last_month));
					$last_day_last_month = strtotime(date('Y-m-t', $last_month));

					$q = " created_at >= '$first_day_last_month' AND  created_at <= '$last_day_last_month' ";
					break;

				case 'last-year':
					$last_year = date("Y",strtotime("-1 year", DATE_NOW));
					$first_day_of_year = strtotime($last_year.'-01-01');
					$last_day_of_year = strtotime($last_year.'-12-31');

					$q = " created_at >= '$first_day_of_year' AND  created_at <= '$last_day_of_year' ";
					break;
			}

			$filters[] = $q;
			$uri['date'] = $_REQUEST['date'];
		}

		$transaction = $this->getModel("Transaction");
		$transaction->join(" t JOIN #__accounts a ON a.account_id = t.account_id ");
		$transaction->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");

		$rows = 20;
		if(isset($_GET['rows'])) {
			$rows = $_GET['rows'];
			$uri['rows'] = $rows;
		}

		$transaction->page['limit'] = $rows;
		$transaction->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$transaction->page['target'] = url("TransactionsController@index");
		$transaction->page['uri'] = (isset($uri) ? $uri : []);

		$data['transactions'] = $transaction->getList();

		unset($_SESSION['export']);

		if($data['transactions']) {

			$data['reports']['total'] = 0;
			$data['reports']['total_gross_amount'] = 0;
			$data['reports']['total_tax_amount'] = 0;
			$data['reports']['total_net_amount'] = 0;

			$export[] = implode("|",[
				"ACCOUNT_ID|NAME|PREMIUM|PRICE|SOURCE|TRANSACTION_ID|PAYMENT_STATUS|PAID_GROSS_AMOUNT|TAX_AMOUNT|DATE"
			]);

			for($i=0; $i<count($data['transactions']); $i++) {
				$data['reports']['total']++;
				
				$data['reports']['total_gross_amount'] += $data['transactions'][$i]['premium_price'];

				if(isset($data['transactions'][$i]['transaction_details']['fees'])) {

					$key = array_search("tax", $data['transactions'][$i]['transaction_details']['fees']);
					if($key) {
						$tax_amount = $data['transactions'][$i]['transaction_details']['fees'][$key]['value'];
					}else {
						$tax_amount = 0;
					}

				}else {
					$tax_amount = $data['transactions'][$i]['transaction_details']['seller_receivable_breakdown']['net_amount']['value'] * 0.12;
				}

				$data['reports']['total_tax_amount'] += $tax_amount;
				$data['reports']['total_net_amount'] += $data['transactions'][$i]['transaction_details']['seller_receivable_breakdown']['gross_amount']['value'] - $tax_amount;

				$export[] = implode("|", [
					$data['transactions'][$i]['account_id'],
					$data['transactions'][$i]['account_name']['firstname']." ".$data['transactions'][$i]['account_name']['lastname']." ".$data['transactions'][$i]['account_name']['suffix'],
					$data['transactions'][$i]['premium_description'],
					$data['transactions'][$i]['premium_price'],
					$data['transactions'][$i]['payment_source'],
					$data['transactions'][$i]['payment_transaction_id'],
					$data['transactions'][$i]['payment_status'],
					$data['transactions'][$i]['transaction_details']['seller_receivable_breakdown']['gross_amount']['value'],
					$tax_amount,
					date("Y-m-d", $data['transactions'][$i]['created_at'])
				]);

			}

			$_SESSION['export'] = $export;

		}
		
		$this->setTemplate("transactions/index.php");
		return $this->getTemplate($data,$transaction);
		
    }

	function view($id) {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Transaction");

		$transaction = $this->getModel("Transaction");
		$transaction->column['transaction_id'] = $id;
		$data = $transaction->getById();

		if($data) {
			$account = $this->getModel("Account");
			$account->column['account_id'] = $data['account_id'];
			$data['account'] = $account->getById();

			$this->setTemplate("transactions/view.php");
			return $this->getTemplate($data,$transaction);
		}

		$this->response(404);

	}

	function cart($account_id, $premium_id) {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Cart");
		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).on('change', '#duration', function() {
				let duration = $(this).val();
				let cost = parseInt($('.amount').data('cost'));
				let total = 0;

				switch(duration) {
					case '365': total = cost * 12; break;
					case '730': total = cost * 24; break;
					default: total = (cost / 30) * duration; break;
				}

				$('.amount').text( parseFloat(total.toFixed(2)).toLocaleString() );
				$('#cost').val( total );
				$('#duration').val( duration );
			});

		"));

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

		$this->doc->setTitle("Cart");

		$this->setTemplate("transactions/cart.php");
		return $this->getTemplate($data,$premium);

	}

    function selectedPremium($account_id, $premium_id) {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		/* $paypal = new PayPal();
		$response = $paypal->validatePayment("81Y91742TA749304S");
		debug($response);
		exit(); */

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data['account'] = $account->getById();

		$data['duration'] = $_POST['duration'];

		$this->doc->setTitle("Checkout Premiums");

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			/* Show a loader on payment form processing */
			const setProcessing = (isProcessing) => {
				if (isProcessing) {
					$('.loader-container').removeClass('d-none');
					$('.cart-container').addClass('d-none');
				}
			};

		"));
        
		if(CONFIG['payment_gateway']['paypal'] == 1) {
			$paypal = new PayPal();
			$paypal->createOrder(
				$data,
				($this->validation_url != "" ? $this->validation_url : url("TransactionsController@checkoutValidate", ["account_id" => $account_id])),
				($this->payment_status_url != "" ? $this->payment_status_url : url("TransactionsController@paymentStatus"))
			);
		}

		if(CONFIG['payment_gateway']['xendit'] == 1) {
			$xendit = new XendIt();
			$xendit->requestInvoice(
				$data,
				rtrim(MANAGE, "/Manage").url("TransactionsController@paymentStatus"),
			);
		}
        
		$data['cost'] = $_POST['cost'];
        $this->setTemplate("transactions/checkouts.php");
		return $this->getTemplate($data,$premium);

    }

	function xenditCreateInvoce() {

		parse_str(file_get_contents('php://input'), $_POST);

		$xendit = new XendIt();
		$response = $xendit->createInvoice($_POST);

		$this->saveTransaction($response, $this->session['account_id']);
		/* unset($response['processed_data']); */

		echo json_encode($response);
		exit();

	}

	function xenditPaymentConfirmation() {
		/** XENDIT PAYOUT WEBHOOK */

		if(isset($_SERVER['HTTP_X_CALLBACK_TOKEN']) && $_SERVER['HTTP_X_CALLBACK_TOKEN'] == "fU0NYRK7swFYG4vgaIJ90eUy0sVMkAO5Zho2Awno04gtVcie") {
		
			$response = json_decode(file_get_contents('php://input'), true);

			if(isset($response['status']) && in_array($response['status'], ["PAID", "COMPLETED", "SUCCESS", "SUCCEEDED"])) {
				
				$transaction = $this->getModel("Transaction");
				$transaction->column['payment_transaction_id'] = $response['external_id'];
				$data = $transaction->getByPaymentTransactionId();

				if($data) {

					unset($response['available_banks']);
					unset($response['available_retail_outlets']);
					unset($response['available_ewallets']);
					unset($response['available_qr_codes']);
					unset($response['available_direct_debits']);
					unset($response['available_paylaters']);
					unset($response['should_exclude_credit_card']);
					unset($response['should_send_email']);
					unset($response['success_redirect_url']);
					unset($response['failure_redirect_url']);

					$data['transaction_details']['status'] = $response['status'];
					$data['transaction_details']['create_time'] = $response['paid_at'];
					$data['transaction_details']['update_time'] = $response['updated'];
					$data['transaction_details']['payment_details'] = $response;

					$transaction->save($data['transaction_id'], [
						"payment_status" => "COMPLETED",
						"payer" => json_encode($data['payer']),
						"transaction_details" => json_encode($data['transaction_details']),
					]);

					$this->saveSubscription($data['account_id'], [
						"account_id" => $data['account_id'],
						"transaction_id" => $data['transaction_id'],
						"premium_id" => $data['premium_id'],
						"subscription_date" => strtotime($response['paid_at']),
						"subscription_start_at" => strtotime($response['paid_at']),
						"subscription_end_at" => strtotime("+".$data['duration']." days", strtotime($response['paid_at'])),
						"payment_transaction_id" => $data['payment_transaction_id']
					]);

					echo json_encode([
						"message" => "Payment successfully recorded for external_id ".$response['external_id']." with id ".$response['id']."!"
					]);

					response()->httpCode(200);
					exit();

				}

				echo json_encode([
					"message" => "Invoice expired and has been removed from ".CONFIG['site_name']
				]);

				response()->httpCode(200);
				exit();

			}
		}

		response()->httpCode(404);
		exit();
	}

	function checkoutValidate($account_id) {

		$paypal = new PayPal();
		$response = $paypal->validatePayment($_REQUEST['order_id']);

		$this->saveTransaction($response, $account_id);
		unset($response['processed_data']);

		echo json_encode($response);
		exit();

	}

	function saveTransaction($response, $account_id) {

		if($response['status'] == 1) {

			$new_data = $response['processed_data'];
			$new_data['account_id'] = $account_id;

			$transaction = $this->getModel("Transaction");
			$transaction->column['payment_transaction_id'] = $new_data['payment_id'];
			$data['transaction'] = $transaction->getByPaymentTransactionId();

			if($data['transaction'] === false) { $data['transaction'] = [];

				$premium = $this->getModel("Premium");
				$premium->column['premium_id'] = $new_data['premium_id'];
				$premium_data = $premium->getById();

				$new_data['transaction_details'] = json_encode($new_data['transaction_details']);
				$new_data['payer'] = json_encode($new_data['payer']);

				$new_data['payment_transaction_id'] = $new_data['payment_id'];
				$new_data['premium_description'] = "[".$premium_data['name']."] ".$premium_data['details']."";

				$processed_data = $transaction->saveNew($new_data);
				$data['transaction']['transaction_id'] = $processed_data['id'];

				if(in_array($response['processed_data']['payment_status'], ["COMPLETED", "SUCCESS", "PAID"])) {
					$this->saveSubscription($account_id, [
						"account_id" => $account_id,
						"transaction_id" => $data['transaction']['transaction_id'],
						"premium_id" => $premium_data['premium_id'],
						"subscription_date" => $new_data['created_at'],
						"subscription_start_at" => $new_data['created_at'],
						"subscription_end_at" => strtotime("+".$new_data['duration']." days", $new_data['created_at']),
						"payment_transaction_id" => $new_data['payment_transaction_id']
					]);
				}

			}

		}

	}

	function saveSubscription($account_id, $data) {

		$account_subscription = $this->getModel("AccountSubscription");
		$account_subscription->saveNew([
			"account_id" => $data['account_id'],
			"transaction_id" => $data['transaction_id'],
			"premium_id" => $data['premium_id'],
			"subscription_date" => $data['subscription_date'],
			"subscription_start_at" => $data['subscription_start_at'],
			"subscription_end_at" => $data['subscription_end_at']
		]);

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$account_data = $account->getById();

		$mail = new Mailer();
		$mail
			->build($this->mailInvoice($account_id, $data['transaction_id']))
				->send([
					"to" => [
						$account_data['email']
					]
				], CONFIG['site_name'] . " Premium Subscription Invoice - Transaction ID ". $data['payment_transaction_id']);

	}

	function paymentStatus() {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("MLS - Payment Confirmation");

		// Check whether the payment ID is not empty 
		if(!empty($_GET['checkout_ref_id'])) {
			
			$payment_transaction_id  = $_GET['checkout_ref_id']; 
			
			$transaction = $this->getModel("Transaction");
			$transaction->column['payment_transaction_id'] = $payment_transaction_id;
			$data['transaction'] = $transaction->getByPaymentTransactionId();
		
			if($data['transaction']){
				$data['payment_status_message'] = '';
			}else{ 
				$data['payment_status_message'] = ""; 
			}

			$this->setTemplate("transactions/paymentStatus.php");
			return $this->getTemplate($data,$transaction);

		}

		$this->response(404);
	
	}

	function mailInvoice($account_id, $transaction_id) {

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data['account'] = $account->getById();

		$transaction = $this->getModel("Transaction");
		$transaction->column['transaction_id'] = $transaction_id;
		$data['transaction'] = $transaction->getById();

		if(VAT) {
			$data['transaction']['premium_price'] = ($data['transaction']['premium_price'] / 1.12);
			$data['vat'] = $data['transaction']['premium_price'] * 0.12;
			$data['total'] = $data['transaction']['premium_price'] + $data['vat'];
		}else {
			$data['total'] = $data['transaction']['premium_price'];
		}

		$this->setTemplate("transactions/MAIL_invoice.php");
		return $this->getTemplate($data,$transaction);

	}

	function invoices($account_id, $transaction_id) {

		if(!isset($this->session['permissions']['transactions']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permission to access the Transactions Report", "warning");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Invoice");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data['account'] = $account->getById();

		$transaction = $this->getModel("Transaction");
		$transaction->column['transaction_id'] = $transaction_id;
		$data['transaction'] = $transaction->getById();

		if($data['transaction']) {
			if(VAT) {
				$data['transaction']['premium_price'] = ($data['transaction']['premium_price'] / 1.12);
				$data['vat'] = $data['transaction']['premium_price'] * 0.12;
				$data['total'] = $data['transaction']['premium_price'] + $data['vat'];
			}else {
				$data['total'] = $data['transaction']['premium_price'];
			}

			$this->setTemplate("transactions/invoice.php");
			return $this->getTemplate($data,$transaction);
		}
		
		$this->response(404);

	}

	function delete($id) {

		$this->doc->addStyleDeclaration("
			.icon-tabler-alert-triangle {
				color: red;
				width: 132px;
				height: 132px;
				stroke-width: 1.25;
			}

		");

		$transaction = $this->getModel("Transaction");
		$transaction->column['transaction_id'] = $id;
		$data['transaction'] = $transaction->getById();

		if($data) {
			if(isset($_REQUEST['delete'])) {
				$response = $transaction->deleteTransaction($id);

				$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);
			}

		}else {
			$this->getLibrary("Factory")->setMsg("Transaction not found.","warning");
		}

		$this->setTemplate("transactions/delete.php");
		return $this->getTemplate($data);

	}

}