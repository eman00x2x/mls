<?php

namespace Admin\Application\Controller;

class HandshakesController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

	function edit($id, $account_id) {

		$this->doc->setTitle("Update Handshake Listing");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");

		$handshake = $this->getModel("Handshake");
		$handshake->column['handshake_id'] = $id;
		$handshake->and(" requestor_account_id  = " . $account_id . " AND handshake_status_at = 'accepted'" );
		$data = $handshake->getById();

		if($data) {

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$listing->and(" account_id = " . $data['requestee_account_id'] );
			$data['listing'] = $listing->getById();

			$this->setTemplate("handshakes/edit.php");
			return $this->getTemplate($data, $listing);

		}
			
		$this->response(404);

	}

	function saveUpdate($id) {

		parse_str(file_get_contents('php://input'), $_POST);

		$handshake = $this->getModel("Handshake");
		$response = $handshake->save($id, [
			"requestor_listing_details" => $_POST['requestor_listing_details']
		]);

		$this->getLibrary("Factory")->setMsg($response['message'], $response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

}