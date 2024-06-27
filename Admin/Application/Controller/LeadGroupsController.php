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

		$groups->where(" account_id = ".$this->account_id." ")->orderby(" name DESC ");
		$data = $groups->getList();

		$this->setTemplate("leadGroups/index.php");
		return $this->getTemplate($data, $groups);
		
	}

	function groupSelection() {

		$filters[] = " account_id = ".$this->account_id." ";

		$groups = $this->getModel("LeadGroup");
		$groups->page['limit'] = 1000;

		$groups->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" name DESC ");
		$data = $groups->getList();

		$this->setTemplate("leadGroups/groupSelection.php");
		return $this->getTemplate($data, $groups);

	}

	function searchGroup() {

		if(isset($_REQUEST['search'])) {
			$filters[] = " (name LIKE '%".$_REQUEST['search']."%') ";
		}

		$filters[] = " account_id = ".$this->account_id." ";

		$groups = $this->getModel("LeadGroup");
		$groups->page['limit'] = 1000;

		$groups->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" name DESC ");
		$data = $groups->getList();

		$this->setTemplate("leadGroups/searchGroup.php");
		return $this->getTemplate($data, $groups);

	}

	function add() {

		$this->doc->setTitle("New Lead Group");

		$this->setTemplate("leadGroups/add.php");
		return $this->getTemplate();

	}

	function edit($id) {

		$this->doc->setTitle("Update Lead Group");

		$groups = $this->getModel("LeadGroup");
		$groups->column['lead_group_id'] = $id;
		$data = $groups->getById();

		$this->setTemplate("leadGroups/edit.php");
		return $this->getTemplate($data, $groups);

	}

	function saveNew() {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['created_at'] = DATE_NOW;
		$_POST['account_id'] = $this->account_id;

		$groups = $this->getModel("LeadGroup");
		$response = $groups->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$groups = $this->getModel("LeadGroup");
		$response = $groups->save($id, $_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}

	function delete($id) {

		$groups = $this->getModel("LeadGroup");
		$groups->column['lead_group_id'] = $id;
		$data = $groups->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$leads = $this->getModel("Lead");
				$leads->DBO->query("
					UPDATE mls_leads SET lead_group_id = 0 WHERE lead_group_id = $id
				");

				$groups->deleteLeadGroup($id);

				$this->getLibrary("Factory")->setMsg("Group deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);
			}

		}else {
			$this->getLibrary("Factory")->setMsg("Group not found.","warning");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}

		$this->setTemplate("leadGroups/delete.php");
		return $this->getTemplate($data);

	}
	
}