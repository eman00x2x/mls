<?php

namespace Admin\Application\Controller;

class SettingsController extends \Main\Controller {

	private static $_instance = null;
	private $doc;
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}
	
	function index() {

		$this->doc->setTitle("Site Settings");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");

		$settings = $this->getModel("Setting");
		$settings->column['id'] = 1;
		$data = $settings->getById();

		$this->setTemplate("settings/settings.php");
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
		$_POST['privileges'] = json_encode($_POST['privileges']);

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