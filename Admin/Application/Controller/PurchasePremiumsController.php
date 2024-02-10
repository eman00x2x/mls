<?php

namespace Admin\Application\Controller;

class PurchasePremiumsController extends \Main\Controller {

    private	$doc;
	private	$client_id = PAYPAL_CLIENT_ID;
    private	$client_secret = PAYPAL_CLIENT_SECRET;
    private	$currency = CURRENCY;
    private	$environment = PAYPAL_ENVIRONMENT;

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

		$this->setTemplate("purchasePremiums/premiums.php");
		return $this->getTemplate($data,$premium);

    }

    function selectedPremium($account_id, $premium_id) {

		/* $_REQUEST['order_id'] = "81P68441X8030654W";
		$_REQUEST['paypal_order_check'] = 1;
		$_REQUEST['account_id'] = $_SESSION['account_id'];
		debug($this->checkoutValidate()); */

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

		$this->doc->setTitle("Checkout Premiums");
        $this->doc->addScript("https://www.paypal.com/sdk/js?client-id=".$this->client_id."&currency=".$this->currency."&intent=capture&commit=false&vault=true");
		$this->doc->addScriptDeclaration("

			var paymentPageLink;
			var order_id;

            $(document).ready(function() {

                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color:  'blue',
                        shape:  'rect',
                        label:  'paypal'
                    },

                    createOrder: function( data, actions ) {

						return actions.order.create({
							\"intent\": \"CAPTURE\",
							\"purchase_units\": [{
								\"reference_id\": \"".$data["premium_id"]."\",
								\"description\": \"".$data["name"]." [".$data["details"]."]\",
								\"amount\": {
									\"currency_code\": \"".$this->currency."\",
									\"value\": ".$data["cost"]."
								}
							}]
						});

                    },

					onApprove: function( data, actions ) {

						return actions.order.capture().then(function(orderData) {
							setProcessing(true);

							var postData = {account_id: $account_id, paypal_order_check: 1, order_id: orderData.id};
							fetch('".url("PurchasePremiumsController@checkoutValidate")."', {
								method: 'POST',
								headers: {'Accept': 'application/json'},
								body: encodeFormData(postData)
							})
							.then((response) => response.json())
							.then((result) => {

								console.log(result);

								if(result.status == 1){
									window.location.href = '".url("PurchasePremiumsController@paymentStatus")."?checkout_ref_id='+result.payment_transaction_id;
								}else{
									$('.response').html(result.msg);
								}

								setProcessing(false);
							})
							.catch(error => console.log(error));
						});

					},

					onCancel: function( data ) {
						alert('Order cancelled');
					}

                }).render('#paypal-button-container');

            });

			const encodeFormData = (data) => {
				var form_data = new FormData();

				for ( var key in data ) {
					form_data.append(key, data[key]);
				}
				return form_data;   
			}

			// Show a loader on payment form processing
			const setProcessing = (isProcessing) => {
				if (isProcessing) {
					$('.overlay').removeClass('d-none');
				} else {
					$('.overlay').addClass('d-none');
				}
			}  
			
		");
        
        $this->setTemplate("purchasePremiums/selectedPremium.php");
		return $this->getTemplate($data,$premium);

    }

	function checkoutValidate() {

		if(isset($_REQUEST['paypal_order_check']) && isset($_REQUEST['order_id'])) {

			$response = $this->generateAccessToken();
		
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Bearer '. $response['data']['access_token']
			);
			
			try {
				$order_response = $this->request("GET","/v2/checkout/orders/".$_REQUEST['order_id'], null, $headers);
			} catch(Exception $e) {  
				$api_error = $e->getMessage();  
			}

			if(!empty($order_response)) {
				
				$intent = $order_response['data']['intent'];
				$order_status = $order_response['data']['status'];

				$newData['account_id'] = $_REQUEST['account_id'];
				$newData['created_at'] = strtotime($order_response['data']['create_time']);
				$newData['modified_at'] = DATE_NOW;

				if(!empty($order_response['data']['purchase_units'][0])){ 
					$purchase_unit = $order_response['data']['purchase_units'][0]; 
		
					$newData['premium_id'] = $purchase_unit['reference_id'];
					$newData['premium_description'] = $purchase_unit['description'];
					
					if(!empty($purchase_unit['amount'])){
						$newData['premium_price'] = $purchase_unit['amount']['value'];
					} 
		
					if(!empty($purchase_unit['payments']['captures'][0])){ 
						$payment_capture = $purchase_unit['payments']['captures'][0]; 
						$newData['payment_transaction_id'] = $payment_capture['id']; 
						$newData['payment_status'] = $payment_capture['status'];
						$newData['transaction_details'] = json_encode($payment_capture);
					} 
		
					if(!empty($purchase_unit['payee'])){ 
						$payee = $purchase_unit['payee']; 
						$newData['merchant_email'] = $payee['email_address']; 
						$newData['merchant_id'] = $payee['merchant_id']; 
					} 
				} 
		
				$newData['payment_source'] = ''; 
				if(!empty($order_response['data']['payment_source'])){ 
					foreach($order_response['data']['payment_source'] as $key => $value) { 
						$newData['payment_source'] = $key; 
					} 
				} 

				if(!empty($order_response['data']['payer'])){
					$newData['payer'] = json_encode($order_response['data']['payer']);
				} 

				if(!empty($order_response['data']['id']) && $order_status == 'COMPLETED') { 

					$transaction = $this->getModel("Transaction");
					$transaction->column['payment_transaction_id'] = $newData['payment_transaction_id'];
					$data['transaction'] = $transaction->getByPaymentTransactionId();

					if($data['transaction'] === false) {
						$response = $transaction->saveNew($newData);
						$data['transaction']['transaction_id'] = $response['id'];
					}

				}

				$response = array(
					"status" => 1, 
					"msg" => 'Transaction completed!',
					"payment_transaction_id" => base64_encode($newData['payment_transaction_id'])
				); 
				 
			}else {
				$response = array(
					"status" => 0,
					"msg" => $api_error
				);
			}

		}else {
			$response = array(
				"status" => 0, 
				"msg" => 'Transaction Failed!'
			); 
		}

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

			$this->setTemplate("purchasePremiums/paymentStatus.php");
			return $this->getTemplate($data,$transaction);

		}

		$this->response(404);
	
	}

    function request($method, $endpoint, $data = null, $headers = array()) {

        $url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url.$endpoint);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		switch($method) {
			
			case 'POST':
				curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($data));
				break;
			
			default:
				curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
			
		}
		
		$response = json_decode(curl_exec($handle), true);
		
		$http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		$header_info = curl_getinfo($handle, CURLINFO_HEADER_OUT);
		curl_close($handle);

		if ($http_code != 200 && !empty($response['error'])) {
			throw new Exception('Error '.$response['error'].': '.$response['error_description']);
        }

		return array(
			"headers" => $header_info,
			"data" => $response
		);

    }

	function generateAccessToken() {
		
		$url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url."/v1/oauth2/token");
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_USERPWD, $this->client_id.":".$this->client_secret);
		curl_setopt($handle, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		
		$response = json_decode(curl_exec($handle), true);
		
		$http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		$header_info = curl_getinfo($handle, CURLINFO_HEADER_OUT);
		curl_close($handle);

		if ($http_code != 200 && !empty($response['error'])) {
			throw new Exception('Error '.$response['error'].': '.$response['error_description']);
        }

		return array(
			"headers" => $header_info,
			"data" => $response
		);

	}

}