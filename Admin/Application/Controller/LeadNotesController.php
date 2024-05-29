<?php

namespace Admin\Application\Controller;

class LeadNotesController extends \Main\Controller {
	
	public $doc;
	public $account_id;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
		$this->account_id = $this->session['account_id'];
	}

	function index($lead_id) {

		$notes = $this->getModel("LeadNote");
		$notes->page['limit'] = 1000;

		$notes->column['lead_id'] = $lead_id;
		$data = $notes->getByLeadId();

		if($data['leads']) {
			$this->setTemplate("leadNotes/notes.php");
			return $this->getTemplate($data, $notes);
		}

	}

	function saveNew($id) {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['created_at'] = DATE_NOW;
		$_POST['lead_id'] = $id;
		$_POST['account_id'] = $this->account_id;

		$notes = $this->getModel("LeadNote");
		$response = $leads->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		$notes->note_id = $response['id'];
		$data = $notes->getById();

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg(),
			"data" => $data
		));

	}

	function delete($id) {

		$notes = $this->getModel("LeadNote");
		$notes->column['note_id'] = $id;
		$data = $notes->getById();
		
		if($data) {

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				var id = ".$data['note_id'].";

				var detail = $('.row_leads_' + id + ' .btn-delete').data('content');
				$('.delete-name-container').text( detail.name );
				$('.delete-email-container').text( detail.email );
				$('.delete-mobile-number-container').text( detail.mobile_no );

			"));

			if(isset($_REQUEST['delete'])) {

				$notes->deleteLead($id);

				$this->getLibrary("Factory")->setMsg("Note deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Note not found.","warning");
		}

		$this->setTemplate("leads/delete.php");
		return $this->getTemplate($data);

	}
	
}