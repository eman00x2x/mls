<?php

namespace Admin\Application\Controller;

Use Library\Paypal as Paypal;
use Library\Mailer;

class TransactionsController extends \Main\Controller {

    public	$doc;
	public $session;

	public $validation_url;
	public $payment_status_url;

	function __construct()  {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

    function index($account_id) {

		$this->doc->setTitle("Transactions");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data['account'] = $account->getById();

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

		$filters[] = " account_id = ".$account_id;

		$transaction = $this->getModel("Transaction");
		$transaction->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");

		$transaction->page['limit'] = 10;
		$transaction->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$transaction->page['target'] = url("TransactionsController@index", ["account_id" => $account_id]);
		$transaction->page['uri'] = (isset($uri) ? $uri : []);

		$data['account']['transaction'] = $transaction->getList();
		
		$this->setTemplate("transactions/transactions.php");
		return $this->getTemplate($data,$transaction);
		
    }

	function cart($account_id, $premium_id) {

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

		/* $paypal = new PayPal();
		$response = $paypal->validatePayment("81Y91742TA749304S");
		debug($response);
		exit(); */

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

		$data['duration'] = $_POST['duration'];

		$this->doc->setTitle("Checkout Premiums");
        
		$paypal = new PayPal();
		$paypal->createOrder(
			$data,
			($this->validation_url != "" ? $this->validation_url : url("TransactionsController@checkoutValidate", ["account_id" => $account_id])),
			($this->payment_status_url != "" ? $this->payment_status_url : url("TransactionsController@paymentStatus"))
		);
        
		$data['cost'] = $_POST['cost'];
        $this->setTemplate("transactions/checkouts.php");
		return $this->getTemplate($data,$premium);

    }

	function checkoutValidate($account_id) {

		$paypal = new PayPal();
		$response = $paypal->validatePayment($_REQUEST['order_id']);
		
		if($response['status'] == 1) {

			$new_data = $response['processed_data'];
			$new_data['account_id'] = $account_id;

			$transaction = $this->getModel("Transaction");
			$transaction->column['payment_transaction_id'] = $new_data['payment_id'];
			$data['transaction'] = $transaction->getByPaymentTransactionId();

			if($data['transaction'] === false) {

				$premium = $this->getModel("Premium");
				$premium->column['premium_id'] = $new_data['premium_id'];
				$premium_data = $premium->getById();

				$new_data['transaction_details'] = json_encode($new_data['transaction_details']);
				$new_data['payer'] = json_encode($new_data['payer']);

				$new_data['payment_transaction_id'] = $new_data['payment_id'];
				$new_data['premium_description'] = "[".$premium_data['name']."] ".$premium_data['details']."";

				$processed_data = $transaction->saveNew($new_data);
				$data['transaction']['transaction_id'] = $processed_data['id'];

				$account_subscription = $this->getModel("AccountSubscription");

				/**
				 * Check if the account has current package subscription
				 * if the account does not have current package subscription use $new_data['created_at'] in subscription_start_date
				 * else get the current subscription_end_date and add +1 in subscription_start_date for this subscription
				 */


				$account_subscription->saveNew([
					"account_id" => $account_id,
					"transaction_id" => $data['transaction']['transaction_id'],
					"premium_id" => $premium_data['premium_id'],
					"subscription_date" => $new_data['created_at'],
					"subscription_start_date" => $new_data['created_at'],
					"subscription_end_date" => strtotime("+".$new_data['duration']." days", $new_data['created_at'])
				]);

				$mail = new Mailer();
				$mail
					->build($this->mailInvoice($account_id, $data['transaction']['transaction_id']))
						->send([
							"to" => [
								$this->session['email']
							]
						], CONFIG['site_name'] . " Premium Subscription Invoice - Transaction ID ". $new_data['payment_transaction_id']);

			}

		}

		unset($response['processed_data']);

		echo json_encode($response);
		exit();

	}

	function paymentStatus() {

		$this->doc->setTitle("MLS - Payment Confirmation");

		// Check whether the payment ID is not empty 
		if(!empty($_GET['checkout_ref_id'])) {
			
			$payment_transaction_id  = base64_decode($_GET['checkout_ref_id']); 
			
			$transaction = $this->getModel("Transaction");
			$transaction->column['payment_transaction_id'] = $payment_transaction_id;
			$data['transaction'] = $transaction->getByPaymentTransactionId();
		
			if($data['transaction']){
				$data['payment_status_message'] = '';
				$data['transaction_status'] = true;
			}else{ 
				$data['payment_status_message'] = ""; 
				$data['transaction_status'] = false;
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

		$this->doc->setTitle("Invoice");

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

		$this->setTemplate("transactions/invoice.php");
		return $this->getTemplate($data,$transaction);
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