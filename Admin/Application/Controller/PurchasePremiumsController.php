<?php

namespace Admin\Application\Controller;

class PurchasePremiumsController extends \Main\Controller {

    private $doc;
    private $client_id = PAYPAL_CLIENT_ID;
    private $client_secret = PAYPAL_CLIENT_SECRET;
    private $currency = CURRENCY;
    private $environment = PAYPAL_ENVIRONMENT;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}

    function index() {

       $doc = $this->getLibrary("Factory")->getDocument();

		if(!PREMIUM) {
			$this->response(404);
		}

		if(!isset($_SESSION['permissions']['subscriptions'])) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to purchase a premium for this account","error");
			response()->redirect(url("DashboardController@index"));
		}
		
        $doc->setTitle("Premiums");
        
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

    function selectedPremium($premium_id) {

        $premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $premium_id;
		$data = $premium->getById();

        $doc = $this->getLibrary("Factory")->getDocument();
        $doc->addScript("https://www.paypal.com/sdk/js?client-id=".$this->client_id."&currency=".$this->currency."&intent=capture&commit=false&vault=true");
		$doc->addScriptDeclaration("

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
								\"premium_id\": \"".$data["premium_id"]."\",
								\"description\": \"".$data["name"]." - ".$data["details"]."\",
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

							var postData = {paypal_order_check: 1, order_id: orderData.id};
							fetch('".url("PurchasePremiumsController@checkoutValidate")."', {
								method: 'POST',
								headers: {'Accept': 'application/json'},
								body: encodeFormData(postData)
							})
							.then((response) => response.json())
							.then((result) => {

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

		$response = $this->generateAccessToken();

		if(!empty($response['data']['access_token'])) {
			
			try {
				$order_response = $this->request("","/v2/checkout/orders/".$_POST['order_id']);
			} catch(Exception $e) {  
				$api_error = $e->getMessage();  
			}

			debug($order_response);

			if(!empty($order_response)) {
				$order_id = $order_response['data']['id'];
				$intent = $order_response['intent'];
				$order_status = $order_response['status']; 
				$order_time = strtotime($order_response['create_time']); 

				if(!empty($order_response['purchase_units'][0])){ 
					$purchase_unit = $order_response['purchase_units'][0]; 
		
					$newData['premium_id'] = $purchase_unit['premium_id']; 
					$newData['premium_description'] = $purchase_unit['description']; 
					
					if(!empty($purchase_unit['amount'])){ 
						$newData['currency_code'] = $purchase_unit['amount']['currency_code']; 
						$newData['amount_value'] = $purchase_unit['amount']['value']; 
					} 
		
					if(!empty($purchase_unit['payments']['captures'][0])){ 
						$payment_capture = $purchase_unit['payments']['captures'][0]; 
						$newData['payment_transaction_id'] = $payment_capture['id']; 
						$newData['payment_status'] = $payment_capture['status']; 
					} 
		
					if(!empty($purchase_unit['payee'])){ 
						$payee = $purchase_unit['payee']; 
						$newData['payee_email_address'] = $payee['email_address']; 
						$newData['merchant_id'] = $payee['merchant_id']; 
					} 
				} 
		
				$newData['payment_source'] = ''; 
				if(!empty($order_response['payment_source'])){ 
					foreach($order_response['payment_source'] as $key => $value) { 
						$newData['payment_source'] = $key; 
					} 
				} 

				if(!empty($order_response['payer'])){ 
					$payer = $order_response['payer']; 
					$payer_id = $payer['payer_id']; 
					$payer_name = $payer['name']; 
					$payer_given_name = !empty($payer_name['given_name']) ? $payer_name['given_name'] : ''; 
					$payer_surname = !empty($payer_name['surname']) ? $payer_name['surname'] : ''; 
					$payer_full_name = trim($payer_given_name.' '.$payer_surname); 
					$newData['payer_full_name]'] = filter_var($payer_full_name, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH); 
		
					$newData['payer_email_address'] = $payer['email_address']; 
					$payer_address = $payer['address']; 
					$newData['payer_country_code'] = !empty($payer_address['country_code']) ? $payer_address['country_code'] : ''; 
				} 

				if(!empty($order_id) && $order_status == 'COMPLETED') { 

					$transaction = $this->getModel("Transaction");
					$transaction->column['payment_transaction_id'] = $payment_transaction_id;
					$data['transaction'] = $transaction->getByPaymentTransactionId();

					if(!$data['transaction']) {
						$response = $transaction->saveNew($newData);
						$data['transaction']['transaction_id'] = $response['id'];
					}

				}

				$response = array(
					'status' => 1, 
					'msg' => 'Transaction completed!', 
					'payment_transaction_id' => base64_encode($newData['payment_transaction_id'])
				); 
				 
			}

		}else {
			$response = array(
				'status' => 0, 
				'msg' => 'Transaction Failed!'
			); 
		}

		return json_encode($response);

	}

	function paymentStatus() {

		// Check whether the payment ID is not empty 
		if(!empty($_GET['checkout_ref_id'])){ 
			$payment_txn_id  = base64_decode($_GET['checkout_ref_id']); 
			
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

    function request($method, $endpoint, $data, $headers = array()) {

        $url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url.$endpoint);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		
		switch($method) {
			
			case 'POST':
				curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($data));
				break;
			
			default:
			
		}
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		if($response === false) {
			echo "cURL error" . curl_error($handle); 
			exit();
		} 

		$header_info = curl_getinfo($handle, CURLINFO_HEADER_OUT);
		curl_close($handle);
		
		return array(
            "header" => $header_info,
            "data" => json_decode($response, true)
        );

    }

	function generateAccessToken() {
		
		$url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url."/v1/oauth2/token");
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($handle, CURLOPT_HTTPHEADER, [
			"Content-Type: application/x-www-form-urlencoded",
			"Authorization: Basic ".base64_encode($this->client_id.":".$this->client_secret)
		]);
			
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		if($response === false) {
			echo "cURL error" . curl_error($handle); 
			exit();
		}
		
		$header_info = curl_getinfo($handle, CURLINFO_HEADER_OUT);
		curl_close($handle);

		return array(
			"headers" => $header_info,
			"data" => json_decode($response, true)
		);
	}

}