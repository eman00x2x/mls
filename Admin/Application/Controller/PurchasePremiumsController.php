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
        $doc->addScript("https://www.paypal.com/sdk/js?client-id=".$this->client_id."&currency=".$this->currency."&intent=order&commit=false&vault=true");
		$doc->addScriptDeclaration("

            $(document).ready(function() {

                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color:  'blue',
                        shape:  'rect',
                        label:  'paypal'
                    },

                    createOrder: function( data, actions ) {
                        $.post('".url("PurchasePremiumsController@createOrder_paypal")."', ".json_encode($data).", function( data ) {
                            console.log(data);
                        });
                    }
                }).render('#paypal-button-container');

            });
        

			$(document).on('click', '.btn-checkout', function() {
				$.get( $(this).data('url') , function ( data ) {
					console.log(data);
				});
			});

		");
        
        $this->setTemplate("purchasePremiums/selectedPremium.php");
		return $this->getTemplate($data,$premium);

    }

    function createOrder_paypal() {

		$auth = $this->generateAccessToken();

        $access_token = $auth['data']['access_token'];
        $access_type = $auth['data']['token_type'];
        $app_id = $auth['data']['app_id'];
        $expires_in = $auth['data']['expires_in'];
        $nonce = $auth['data']['nonce'];
        $paypal_request_id =  preg_match('/PayPal-Request-Id: (.*)/', $auth['header'], $matches) ? $matches[1] : null;

        $headers = array(
            "Content-Type: application/json",
            "Authorization: $access_type $access_token",
            "Paypal-Request-Id : $paypal_request_id"
        );

        $response = $this->request("POST", "/v2/checkout/orders", array(
            "intent" => "CAPTURE",
            "pruchase_units" => array(
                "amount" => array(
                    "currency_code" => $this->currency,
                    "value" => $_POST['cost']
                )
            )
        ), $headers);

		
		debug($response);


    }

    function request($method, $endpoint, $data, $headers = array()) {

        $url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url.$endpoint);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYEPEER, false);
		curl_setopt($handle, CURLOPT_CAINFO, "D:\wamp64\www\mls\Vendor\braintree\braintree_php\lib\ssl\api_braintreegateway_com.ca.crt");
		
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
            "response" => array(
                "header" => $header_info,
                "data" => json_decode($response, true)
            )
        );

    }

	function generateAccessToken() {
		
		$url = PAYPAL_ENVIRONMENT === "sandbox" ? "https://api-m.sandbox.paypal.com" : "https://api-m.paypal.com";

		$handle = curl_init($url."/v1/oauth2/token");
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($handle, CURLOPT_HTTPHEADER, ["Accept: application/json", "Accept-Lanugage: en_US"]);
		curl_setopt($handle, CURLOPT_USERPWD, base64_encode($this->client_id.":".$this->client_secret));
			
		
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