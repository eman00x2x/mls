<?php

namespace Admin\Application\Controller;

class AccountSubscriptionController extends \Main\Controller {

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function index() {

	}
	
	function view($user_id) {

	}
	
	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		if(isset($_POST['subscription_start_date'])) {
			$_POST['subscription_start_date'] = strtotime($_POST['subscription_start_date']);
			$_POST['subscription_end_date'] = strtotime("+".$_POST['duration'], $_POST['subscription_start_date']);
		}

		$account_subscription = $this->getModel("AccountSubscription");
		$response = $account_subscription->saveNew($_POST);

		$invoices = $this->getModel("Invoice");
		$invoices->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function delete($id) {

		if($id) {
		
			$account_subscription = $this->getModel("AccountSubscription");
			$account_subscription->join = " acs JOIN #__premiums s ON s.premium_id = acs.premium_id";
			$account_subscription->column['account_subscription_id'] = $id;
			$data['subscription'] = $account_subscription->getById();

			if(isset($_REQUEST['delete'])) {
				$account_subscription->deleteSubscription($id);

				$this->getLibrary("Factory")->setMsg("Account Subscription deleted!.","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}else {
		
				if($data) {
					$this->setTemplate("accountSubscriptions/delete.php");
					return $this->getTemplate($data);
				}

			}

		}

		$this->getLibrary("Factory")->setMsg("You click or copy an invalid link.","error");
		return json_encode(
			array(
				"status" => 2,
				"message" => getMsg()
			)
		);
		
	}
	
}