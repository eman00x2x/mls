<?php

namespace Admin\Application\Controller;

use Josantonius\Session\Facades\Session;

class PremiumsController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = Session::get("user_logged");
	}
	
	function index() {

		if(!PREMIUM) {
			$this->response(404);
		}

		if(!$this->session['permissions']['premiums']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Premiums");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$premium = $this->getModel("Premium");
		$premium
		->select(" *, (SELECT COUNT(*) FROM #__account_subscriptions WHERE premium_id = `mls_premiums`.premium_id AND (subscription_end_date > ".DATE_NOW." OR subscription_end_date = 0)) as subscribers")
		->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" date_added DESC ");

		$premium->page['limit'] = 20;
		$premium->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$premium->page['target'] = url("PremiumsController@index");
		$premium->page['uri'] = (isset($uri) ? $uri : []);

		$data = $premium->getList();

		$this->setTemplate("premiums/premiums.php");
		return $this->getTemplate($data,$premium);

	}

	function premiumSelection($account_id) {

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

				$accounts = $this->getModel("Account");
				$accounts->column['account_id'] = $account_id;
				$data['account'] = $accounts->getById();
			}

			$data['account_id'] = $account_id;

			$this->setTemplate("premiums/selection.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}
	
	function view($id) {

		if(!$this->session['permissions']['premiums']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Premium");

		$premium = $this->getModel("Premium");
		$premium->column['premium_id'] = $id;

		if($data = $premium->getById()) {
			$this->setTemplate("premiums/view.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}
	
	function add() {

		if(!$this->session['permissions']['premiums']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("New Premium");

		$this->setTemplate("premiums/add.php");
		return $this->getTemplate();
	}
	
	function edit($id) {

		if(!$this->session['permissions']['premiums']['edit']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Update Premium");

		if($id) {

			$premium = $this->getModel("Premium");
			$premium->column['premium_id'] = $id;

			if($data = $premium->getById()) {
				$this->setTemplate("premiums/edit.php");
				return $this->getTemplate($data);
			}
		
		}

		$this->response(404);

	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		foreach($_POST['script'] as $privilege => $val) {
			if($_POST['script'][$privilege] == "" || $_POST['script'][$privilege] == 0) {
				unset($_POST['script'][$privilege]);
			}
		}

		$_POST['script'] = json_encode($_POST['script']);

		$premium = $this->getModel("Premium");
		$response = $premium->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function saveUpdate($id) {
	
		parse_str(file_get_contents('php://input'), $_POST);

		if($id) {

			foreach($_POST['script'] as $privilege => $val) {
				if($_POST['script'][$privilege] == "" || $_POST['script'][$privilege] == 0) {
					unset($_POST['script'][$privilege]);
				}
			}

			$_POST['script'] = json_encode($_POST['script']);
			
			$premium = $this->getModel("Premium");
			$response = $premium->save($id,$_POST);
			
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
	
	function delete($id) {

		if(!$this->session['permissions']['premiums']['delete']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		if($id) {
		
			$premium = $this->getModel("Premium");
			$premium->column['premium_id'] = $id;
			$data = $premium->getById();

			if(isset($_REQUEST['delete'])) {
				/** DELETE ACCOUNT SUBSCRIPTION */
				$account_subscription = $this->getModel("AccountSubscription");
				$account_subscription->deleteSubscription($id,"premium_id");

				$premium->deletePremium($id);

				$this->getLibrary("Factory")->setMsg("A Premium has been deleted!.","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}else {
		
				if($data) {
					$this->setTemplate("premiums/delete.php");
					return $this->getTemplate($data);
				}

			}

		}

		$this->response(404);
		
	}
	
}