<?php

namespace Admin\Application\Controller;

class SettingsController extends \Main\Controller {

	private static $_instance = null;
	public $doc;
	public $session;
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}
	
	function index() {

		if(!$this->session['permissions']['settings']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Site Settings");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");

		$settings = $this->getModel("Setting");
		$settings->column['id'] = 1;
		$data = $settings->getById();

		$this->setTemplate("settings/settings.php");
		return $this->getTemplate($data, $settings);

	}

	function webSettings() {

		if(!$this->session['permissions']['web_settings']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Site Settings");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");

		$settings = $this->getModel("Setting");
		$settings->column['id'] = 1;
		$data = $settings->getById();

		$this->setTemplate("settings/webSettings.php");
		return $this->getTemplate($data, $settings);

	}

	function getConfig() {

		$settings = $this->getModel("Setting");
		$settings->column['id'] = 1;
		$data = $settings->getById();

		return $data;

	}

	function saveUpdate() {
	
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['show_vat'] = isset($_POST['show_vat']) ? $_POST['show_vat'] : 0;
		$_POST['enable_kyc_verification'] = isset($_POST['enable_kyc_verification']) ? $_POST['enable_kyc_verification'] : 0;
		$_POST['enable_premium'] = isset($_POST['enable_premium']) ? $_POST['enable_premium'] : 0;
		$_POST['enable_pin_access'] = isset($_POST['enable_pin_access']) ? $_POST['enable_pin_access'] : 0;

		$_POST['payment_gateway'] =  json_encode([
			"paypal" => isset($_POST['payment_gateway']['paypal']) ? $_POST['payment_gateway']['paypal'] : 0,
			"xendit" => isset($_POST['payment_gateway']['xendit']) ? $_POST['payment_gateway']['xendit'] : 0
		]);
		
		$_POST['kyc_options'] =  json_encode([
			"prevent_purchase_of_premium" => isset($_POST['kyc_options']['prevent_purchase_of_premium']) ? $_POST['kyc_options']['prevent_purchase_of_premium'] : 0,
			"hide_listings_if_kyc_expired" => isset($_POST['kyc_options']['hide_listings_if_kyc_expired']) ? $_POST['kyc_options']['hide_listings_if_kyc_expired'] : 0
		]);
		
		if(isset($_POST['websocket'])) {
			$_POST['websocket'] = json_encode($_POST['websocket']);
		}

		if(isset($_POST['privileges'])) { $_POST['privileges'] = json_encode($_POST['privileges']); }
		if(isset($_POST['paypal_credentials'])) { $_POST['paypal_credentials'] = json_encode($_POST['paypal_credentials']); }
		if(isset($_POST['contact_info'])) { $_POST['contact_info'] = json_encode($_POST['contact_info']); }
		if(isset($_POST['property_tags'])) { $_POST['property_tags'] = json_encode(explode(", ",$_POST['property_tags'])); }
		if(isset($_POST['email_address_responder'])) { $_POST['email_address_responder'] = json_encode($_POST['email_address_responder']); }

		$_POST['modified_at'] = DATE_NOW;

		$setting = $this->getModel("Setting");
		$response = $setting->save(1,$_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
	
	}

}