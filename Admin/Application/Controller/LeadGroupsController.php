<?php

namespace Admin\Application\Controller;

class LeadGroupsController extends \Main\Controller {
	
	public $doc;
	public $account_id;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
		$this->account_id = $this->session['account_id'];
	}

	function index() {

		$groups = $this->getModel("LeadGroup");
		$groups->page['limit'] = 1000;

		$groups->where(" account_id = ".$this->account_id." ")->orderby(" created_at DESC ");
		$data = $groups->getList();

		$this->setTemplate("leadGroups/index.php");
		return $this->getTemplate($data, $groups);
		
	}

	function saveNew() {

		/* parse_str(file_get_contents('php://input'), $_POST); */

		$_GET['created_at'] = DATE_NOW;
		$_GET['account_id'] = $this->account_id;

		$notes = $this->getModel("LeadNote");
		$response = $notes->saveNew($_GET);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function delete($lead_id, $id) {

		$notes = $this->getModel("LeadNote");
		$notes->column['note_id'] = $id;
		$data = $notes->getById();
		
		if($data) {

			$notes->deleteNote($id);

			$this->getLibrary("Factory")->setMsg("Note deleted!","success");
			return json_encode(
				array(
					"status" => 1,
					"message" => getMsg()
				)
			);

		}else {
			$this->getLibrary("Factory")->setMsg("Note not found.","warning");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}

	}
	
}