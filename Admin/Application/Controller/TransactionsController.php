<?php

namespace Admin\Application\Controller;

Use \Library\Paypal as Paypal;

class TransactionsController extends \Main\Controller {

    private	$doc;
	public $validation_url;
	public $payment_status_url;

	function __construct()  {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function index() {
		
		if(!PREMIUM) {
			$this->response(404);
		}

		if(!isset($_SESSION['permissions']['subscriptions'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to purchase a premium for this account","error");
			response()->redirect(url("DashboardController@index"));
		}
		
        $this->doc->setTitle("Premiums");
        
        $premium = $this->getModel("Premium");
		$premium->where(" visibility = 1 ");
		
		$premium->page['limit'] = 20;
		$premium->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$premium->page['target'] = url("PremiumsController@index");
		$premium->page['uri'] = (isset($uri) ? $uri : []);

		$data = $premium->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$list[$data[$i]['category']][] = $data[$i];
			}
        }
		
		$data['premiums'] = $list;

		$this->setTemplate("transactions/premiums.php");
		return $this->getTemplate($data,$premium);

    }

    function selectedPremium($account_id, $premium_id) {

		/* $_REQUEST['order_id'] = "81P68441X8030654W";
		$_REQUEST['paypal_order_check'] = 1;
		$this->checkoutValidate($account_id);
		exit(); */

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

		$this->doc->setTitle("Checkout Premiums");
        
		$paypal = new PayPal();
		$paypal->createOrder(
			$data,
			($this->validation_url != "" ? $this->validation_url : url("TransactionsController@checkoutValidate", ["account_id" => $account_id])),
			($this->payment_status_url != "" ? $this->payment_status_url : url("TransactionsController@paymentStatus"))
		);
        
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

				$new_data['transaction_details'] = json_encode($new_data['transaction_details']);
				$new_data['payer'] = json_encode($new_data['payer']);

				$new_data['payment_transaction_id'] = $new_data['payment_id'];
				$processed_data = $transaction->saveNew($new_data);
				$data['transaction']['transaction_id'] = $processed_data['id'];

				$premium = $this->getModel("Premium");
				$premium->column['premium_id'] = $new_data['premium_id'];
				$premium_data = $premium->getById();

				$account_subscription = $this->getModel("AccountSubscription");
				$account_subscription->saveNew([
					"account_id" => $account_id,
					"transaction_id" => $data['transaction']['transaction_id'],
					"premium_id" => $premium_data['premium_id'],
					"subscription_date" => $new_data['created_at'],
					"subscription_start_date" => $new_data['created_at'],
					"subscription_end_date" => strtotime("+".$premium_data['duration'], $new_data['created_at'])
				]);

			}

		}

		unset($response['processed_data']);

		echo json_encode($response);
		exit();

	}

	function paymentStatus() {

		$this->doc->setTitle("MLS - Payment Confirmation");

		// Check whether the payment ID is not empty 
		if(!empty($_GET['checkout_ref_id'])){ 
			$payment_transaction_id  = base64_decode($_GET['checkout_ref_id']); 
			
			$transaction = $this->getModel("Transaction");
			$transaction->column['payment_transaction_id'] = $payment_transaction_id;
			$data['transaction'] = $transaction->getByPaymentTransactionId();
		
			if($data['transaction']){
				$data['payment_status_message'] = 'Your Payment has been Successful!';
			}else{ 
				$data['payment_status_message'] = "Transaction has been failed!"; 
			} 

			$this->setTemplate("transactions/paymentStatus.php");
			return $this->getTemplate($data,$transaction);

		}

		$this->response(404);
	
	}

}