<?php

namespace Library;

// no direct access

defined( 'ACCESS' ) or die( 'Restricted access' );

class PayPal {

    private $doc;
    private	$client_id = PAYPAL_CLIENT_ID;
    private	$client_secret = PAYPAL_CLIENT_SECRET;
    private	$currency = CURRENCY;
    private	$environment = PAYPAL_ENVIRONMENT;

    function __construct() {
        $this->doc =  \Library\Factory::getDocument();
    }

    function createOrder($data, $validation_url, $payment_status_url) {

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
							
							var postData = {paypal_order_check: 1, order_id: orderData.id};
							fetch('".$validation_url."', {
								method: 'POST',
								headers: {'Accept': 'application/json'},
								body: encodeFormData(postData)
							})
							.then((response) => response.json())
							.then((result) => {

								if(result.status == 1){
									window.location.href = '".$payment_status_url."?checkout_ref_id='+result.payment_id;
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

    }

	function validatePayment($order_id) {

		if(isset($order_id)) {

			$response = $this->generateAccessToken();
		
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Bearer '. $response['data']['access_token']
			);
			
			try {
				$order_response = $this->request("GET","/v2/checkout/orders/".$order_id, null, $headers);
			} catch(Exception $e) {  
				$api_error = $e->getMessage();  
			}

			if(!empty($order_response)) {
				
				$intent = $order_response['data']['intent'];
				$order_status = $order_response['data']['status'];

				$new_data['modified_at'] = DATE_NOW;

				if(!empty($order_response['data']['purchase_units'][0])){ 
					$purchase_unit = $order_response['data']['purchase_units'][0]; 
		
					$new_data['premium_id'] = $purchase_unit['reference_id'];
					$new_data['premium_description'] = $purchase_unit['description'];
					
					if(!empty($purchase_unit['amount'])){
						$new_data['premium_price'] = $purchase_unit['amount']['value'];
					} 
		
					if(!empty($purchase_unit['payments']['captures'][0])){ 
						$payment_capture = $purchase_unit['payments']['captures'][0]; 
						$new_data['created_at'] = strtotime($payment_capture['create_time']);
						$new_data['payment_id'] = $payment_capture['id']; 
						$new_data['payment_status'] = $payment_capture['status'];
						$new_data['transaction_details'] = $payment_capture;
					} 
		
					if(!empty($purchase_unit['payee'])){ 
						$payee = $purchase_unit['payee']; 
						$new_data['merchant_email'] = $payee['email_address']; 
						$new_data['merchant_id'] = $payee['merchant_id']; 
					} 
				} 
		
				$new_data['payment_source'] = ''; 
				if(!empty($order_response['data']['payment_source'])){ 
					foreach($order_response['data']['payment_source'] as $key => $value) { 
						$new_data['payment_source'] = $key; 
					} 
				} 

				if(!empty($order_response['data']['payer'])){
					$new_data['payer'] = $order_response['data']['payer'];
				} 

				if(!empty($order_response['data']['id']) && $order_status == 'COMPLETED') {

					$response = array(
						"status" => 1,
						"msg" => 'Transaction Completed!',
						"payment_id" => base64_encode($new_data['payment_id']),
						"processed_data" => $new_data
					);

				}

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

		return $response;

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