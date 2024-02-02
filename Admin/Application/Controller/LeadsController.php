<?php

namespace Admin\Application\Controller;

class LeadsController extends \Main\Controller {
	
	private $doc;
	private $account_id;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['account_id'];
	}

	function index() {

		$this->doc->setTitle("Leads");
	
		if(isset($_REQUEST['search'])) {
			$filters[] = " (name LIKE '%".$_REQUEST['search']."%') OR (email LIKE '%".$_REQUEST['search']."%') OR (mobile_no LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();

		$filters[] = " account_id = ".$data['account_id'];
		
		$lead = $this->getModel("Lead");
		$lead->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" inquire_at DESC ");
		
		$lead->page['limit'] = 20;
		$lead->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$lead->page['target'] = url("LeadsController@index");
		$lead->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['leads'] = $lead->getList();

		if($data['leads']) {

			$listing = $this->getModel("Listing");

			for($i=0; $i<count($data['leads']); $i++) {
				$listing->column['listing_id'] = $data['leads'][$i]['listing_id'];
				$data['leads'][$i]['listing'] = $listing->getById();
			}

		}

		$this->setTemplate("leads/leads.php");
		return $this->getTemplate($data,$lead);
		
	}
	
	function edit($id) {
		
		$this->doc->setTitle("Update Lead Details");
		
		$account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();
		
		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$lead->and(" account_id = ".$data['account_id']);

		$data['leads'] = $lead->getById();
		
		if($data) {
			$this->setTemplate("leads/edit.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function view($id) {
		
		$this->doc->setTitle("View Leads");
		
		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$data = $lead->getById();

		$account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data['account'] = $account->getById();

		$listing = $this->getModel("Listing");
		$listing->column['listing_id'] = $data['listing_id'];
		$data['listing'] = $listing->getById();
		
		if($data) {
			$this->setTemplate("leads/view.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$lead = $this->getModel("Lead");
		$response = $lead->save($id,$_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function delete($id) {

		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$data = $lead->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$lead->deleteLead($id);

				$this->getLibrary("Factory")->setMsg("Lead permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Lead not found.","warning");
		}

		$this->setTemplate("leads/delete.php");
		return $this->getTemplate($data);

	}
	
}