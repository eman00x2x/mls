<?php

namespace Admin\Application\Controller;

class LeadsController extends \Main\Controller {
	
	public $doc;
	public $account_id;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
		$this->account_id = $this->session['account_id'];
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
		$lead->select(" lead_id, listing_id, account_id, content as user_message, iv, inquire_at ");
		$lead->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" inquire_at DESC ");
		
		$lead->page['limit'] = 20;
		$lead->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$lead->page['target'] = url("LeadsController@index");
		$lead->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['leads'] = $lead->getList();

		if($data['leads']) {

			$listing = $this->getModel("Listing");

			for($i=0; $i<count($data['leads']); $i++) {
				$encrypted_content[] = $data['leads'][$i];
				$listing->column['listing_id'] = $data['leads'][$i]['listing_id'];
				$data['leads'][$i]['listing'] = $listing->getById();
			}

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				const content = ".json_encode($encrypted_content).";
				const publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
				const privateKey = ".json_encode($this->session['message_keys']['privateKey']).";

			"));

		}

		$this->doc->addScript(CDN."js/encryption.js");
		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			
			( async => {
				for (let key in content) {
					if (content.hasOwnProperty(key)) {
						let lead_id = content[key].lead_id;
						
						decrypt(content[key], publicKey, privateKey)
							.then(  response => {
								$('.row_leads_' + lead_id + ' .name-container').html( (response.name).substring(0, 47) + '...' );
								$('.row_leads_' + lead_id + ' .email-container').html( (response.email).substring(0, 47) + '...' );
								$('.row_leads_' + lead_id + ' .mobile-number-container').html( (response.mobile_no).substring(0, 47) + '...' );
							});
						
					}
				}
			})();

		"));

		$this->setTemplate("leads/leads.php");
		return $this->getTemplate($data,$lead);
		
	}
	
	function edit($id) {
		
		$this->doc->setTitle("Update Leads");

		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$lead->where(" account_id = ".$this->account_id);
		$data = $lead->getById();

		if($data) {

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();

			if(!is_array($data['preferences'])) {
				$data['preferences'] = $lead->preferences;
			}

			$lead->addresses = $this->getModel("Address");
			$lead->categorySelection = $listing->categorySelection($data['preferences']['category']);
			
			$this->setTemplate("leads/edit.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function view($id) {
		
		$this->doc->setTitle("View Leads");
		
		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$lead->where(" account_id = ".$this->account_id);
		$data = $lead->getById();

		$data['user_message'] = $data['content'];

		if($data) {

			$this->doc->addScript(CDN."js/encryption.js");
			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

				const data = ".json_encode($data).";
				const publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
				const privateKey = ".json_encode($this->session['message_keys']['privateKey']).";
				
				( async => {
					let lead_id = data.lead_id;
					decrypt(data, publicKey, privateKey)
						.then(  response => {
							$(' .name-container').html( response.name );
							$(' .email-container').html( response.email );
							$(' .mobile-number-container').html( response.mobile_no );
							$(' .message-container').html( response.message );
						});
				})();

			"));

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();
			
			$this->setTemplate("leads/view.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['preferences']['category'] = $_POST['category'];
		$_POST['preferences']['address'] = $_POST['address'];
		$_POST['preferences'] = json_encode($_POST['preferences']);

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