<?php

namespace Admin\Application\Controller;

class SettingsController extends \Main\Controller {

	private $doc;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}
	
	function index() {

		$this->doc->setTitle("Site Settings");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");

		$this->setTemplate("settings/settings.php");
		return $this->getTemplate();

	}

	function saveUpdate() {
	
		parse_str(file_get_contents('php://input'), $_POST);

		$id = 1;
		if($id) {

			$_POST['modified_at'] = DATE_NOW;
			$_POST['property_tags'] = json_encode($_POST['property_tags']);

			$setting = $this->getModel("Setting");
			$response = $setting->save($id,$_POST);
			
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(
				array(
					"status" => $response['status'],
					"message" => getMsg()
				)
			);
			
		}else {
			$this->getLibrary("Factory")->setMsg("Account Subscription not found!.","error");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}
		
	}
	
}