<?php

namespace Admin\Application\Controller;

class AccountsController extends \Main\Controller {

	private $doc;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}
	
	function index() {

		$this->doc->setTitle("Accounts");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (firstname LIKE '%".$_REQUEST['search']."%' OR lastname LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$accounts = $this->getModel("Account");
		$accounts
		->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" registration_date DESC ");

		$accounts->page['limit'] = 20;
		$accounts->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$accounts->page['target'] = url("AccountsController@index");
		$accounts->page['uri'] = (isset($uri) ? $uri : []);

		$data = $accounts->getList();

		$this->setTemplate("accounts/accountList.php");
		return $this->getTemplate($data,$accounts);
		
	}
	
	function view($account_id) {

		$this->doc->setTitle("View Account");

		if($account_id) {

			$this->doc->addScriptDeclaration("
				$(document).on('show.bs.modal','#accountModal',function(e) {
					button = e.relatedTarget;
					url = button.getAttribute('data-url');
					
					$.get(url,function(data,status) {
						$('#accountModal .response-modal').html(data);
					});
				});

				$(document).on('click','.btn-subscription-select',function() {
					url = $(this).attr('data-url');
					$.get(url,function(data,status) {
						$('#accountModal .response-modal').html(data);
					});
				});

				$(document).on('click','.btn-save-subscription',function() {
					$('#accountModal .response-modal .btn-close').trigger('click');
					/* window.location.reload(); */
				});

				$(document).on('click','.btn-delete-continue',function() {
					var row = $(this).attr('data-row');
					var url = $(this).attr('data-url');

					$.get(url, function(data, status) {
						response = JSON.parse(data);
						
						if(response.status == 1) {
							$('.'+row).remove();
							$('#accountModal .response-modal .btn-close').trigger('click');

							$('.response').html(response.message);
						}else {
							$('.response').html(response.message);
						}

					});

						
				});
			");
		
			$accounts = $this->getModel("Account");
			$user = $this->getModel("User");
			$invoices = $this->getModel("Invoice");
			$subscription = $this->getModel("AccountSubscription");

			$accounts->column['account_id'] = $account_id;
			
			if($data = $accounts->getById()) {

				$user->page['limit'] = 100;
				$user->where(" account_id = ".$data['account_id']." ");
				$data['users'] = $user->getList(); 

				$subscription->page['limit'] = 100;
				$subscription
				->select("account_subscription_id, s.premium_id, s.name, s.details, subscription_start_date, subscription_end_date, script")
				->join(" acs JOIN #__premiums s ON s.premium_id=acs.premium_id ")
				->where(" account_id = ".$data['account_id']." ")
				->orderby(" acs.premium_id DESC");

				$data['subscriptions'] = $subscription->getList();

				if($data['subscriptions']) {
					for($i=0; $i<count($data['subscriptions']); $i++) {
						foreach($data['subscriptions'][$i]['script'] as $privilege => $val) {

							if(in_array($privilege,["leads_DB","properties_DB"])) {
								if($val == 1) $data['privileges'][$privilege] = 1;
							}else {
								$data['privileges'][$privilege] += $val;
							}
							
						}
					}
				}

				$invoices->page['limit'] = 100;
				$invoices->where(" account_id = ".$data['account_id']." ORDER BY invoice_id DESC ");
				$data['invoices'] = $invoices->getList();

				$this->setTemplate("accounts/view.php");
				return $this->getTemplate($data);
			}

		}

		$this->response(404);

	}
	
	function add() {

		$this->doc->setTitle("New Account");
		$this->doc->addScript(CDN."js/photo-uploader.js");

		$this->setTemplate("accounts/add.php");
		return $this->getTemplate();
	}
	
	function edit($account_id) {

		$this->doc->setTitle("Update Account");

		if($account_id) {

			$this->doc->addScript(CDN."js/photo-uploader.js");
			
			$accounts = $this->getModel("Account");
			$accounts->column['account_id'] = $account_id;

			if($data = $accounts->getById()) {
				$this->setTemplate("accounts/edit.php");
				return $this->getTemplate($data);
			}
		
		}

		$this->response(404);
		
	}

	function subscriptionSelectionNew($account_id) {

		if(!PREMIUM) {
			$this->response(404);
		}

		if($account_id) {

			$premium = $this->getModel("Premium");

			if(!isset($_REQUEST['premium_id'])) {
				$premium->page['limit'] = 999999;
				$data['premiums'] = $premium->getList();
			}else {
				$premium->column['premium_id'] = $_REQUEST['premium_id'];
				$data['premium'] = $premium->getById();
			}

			$data['account_id'] = $account_id;

			$this->setTemplate("premiums/selection.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);
		
		$accounts = $this->getModel("Account");
		
		if($_POST['logo'] != "") {
			$_POST['logo'] = $accounts->moveUploadedImage($_POST['logo']);
		}

		$_POST['address'] = $_POST['street']." ".$_POST['city']." ".$_POST['province'];
		$_POST['privileges'] = json_encode($_POST['privileges']);
		
		$response = $accounts->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function saveUpdate($account_id) {
	
		parse_str(file_get_contents('php://input'), $_POST);

		if($account_id) {

			$accounts = $this->getModel("Account");
			$accounts->column['account_id'] = $account_id;
			$data = $accounts->getById();
			
			if(isset($_POST['address'])) {
				$_POST['address'] = (isset($_POST['street']) ? $_POST['street'] : "")." ".(isset($_POST['city']) ? $_POST['city'] : "")." ".(isset($_POST['province']) ? $_POST['province'] : "");
			}

			if(isset($_POST['privileges'])) {
				$_POST['privileges'] = json_encode($_POST['privileges']);
			}else {
				$_POST['privileges'] = json_encode($data['privileges']);
			}

			if($_POST['logo'] != $data['logo']) {
				/* remove old logo */

				$logo_url = explode("/", $data['logo']);
				$current_logo = array_pop($logo_url);
				$file = ROOT."Cdn/images/accounts/".$current_logo;
				
				if(file_exists($file)) {
					@unlink($file);
				}
				
				$_POST['logo'] = $accounts->moveUploadedImage($_POST['logo']);
			}

			$response = $accounts->save($account_id,$_POST);
			
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(
				array(
					"status" => $response['status'],
					"message" => getMsg()
				)
			);
			
		}else {
			$this->getLibrary("Factory")->setMsg("Account not found!.","error");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}
		
	}
	
	function delete($id) {
		
		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		if($data) {

			if($data['account_type'] != "Administrator") {

				if(isset($_REQUEST['delete'])) {

					$listing = $this->getModel("Listing");
					$listing_image = $this->getModel("ListingImage");
					$invoice = $this->getModel("Invoice");
					$user = $this->getModel("User");

					if(PREMIUM) {
						$account_subscription = $this->getModel("AccountSubscription");
						$account_subscription->delete($id,"account_id");
						$invoice->delete($id,"account_id");
					}

					$listing->where(" account_id = $id ");
					if($data['listings'] = $listing->getList()) {
						for($i=0; $i<count($data['listings']); $i++) {
							$listing->deleteListing($data['listings'][$i]['listing_id']);
							$listing_image->deleteListingImages($data['listings'][$i]['listing_id']);
						}
					}

					/* remove logo */
					$file = "Cdn/images/accounts/".$data['logo'];
					if(file_exists($file)) {
						@unlink($file);
					}

					$user->delete($id,"account_id");
					$accounts->deleteAccount($id);
					
					$this->getLibrary("Factory")->setMsg("Account permanently deleted!.","success");
					return json_encode(
						array(
							"status" => 1
						)
					);

				}

			}else {
				$this->getLibrary("Factory")->setMsg("Administrator account cannot be deleted","error");
			}

		}else {
			$this->getLibrary("Factory")->setMsg("Account not found.","warning");
		}

		$this->setTemplate("accounts/delete.php");
		return $this->getTemplate($data);
			
	
	}
	
	function uploadPhoto() {
		$accounts = $this->getModel("Account");
		return $accounts->uploadPhoto($_FILES['ImageBrowse']);
	}
	
}