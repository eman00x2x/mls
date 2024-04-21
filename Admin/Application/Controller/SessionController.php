<?php

namespace Admin\Application\Controller;

class SessionController extends \Main\Controller {

    public $doc;
    public $session;

    function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
        $this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function saveTraffic() {

		$traffic = $this->getModel("Traffic");
		$traffic->select(" session_id, JSON_EXTRACT(traffic, '$.name') as name ");
		$traffic->column['session_id'] = $this->getLibrary("SessionHandler")->get("id");
		
		$response = $traffic->getBySessionId();

		if($response) {
			for($i=0; $i<count($response); $i++) {
				$arr[$response[$i]['session_id']][] = $response[$i]['name'];
			}
		}

		if(!isset($arr[ $traffic->column['session_id'] ]) || !in_array($_POST['name'], $arr[ $traffic->column['session_id'] ]) || !$response) {
			
			$traffic->select("");
			$traffic->saveNew(array(
				"traffic" => json_encode([
					"type" => $_POST['type'],
					"name" => $_POST['name'],
					"id" => $_POST['id'],
					"url" => $_POST['url'],
					"source" => $_POST['source']
				]),
				"account_id" => (isset($_POST['account_id']) ? $_POST['account_id'] : 0),
				"session_id" => $this->getLibrary("SessionHandler")->get("id"),
				"created_at" => DATE_NOW,
				"user_agent" => json_encode($_POST['client_info'])
			));

		}

	}


}