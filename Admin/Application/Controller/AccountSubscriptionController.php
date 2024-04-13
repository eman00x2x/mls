<?php

namespace Admin\Application\Controller;

class AccountSubscriptionController extends \Main\Controller {

	public $doc;
	public $account_id;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();

		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}
	
	function index() {

	}
	
	function view($user_id) {

	}

	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		if(isset($_POST['subscription_start_at'])) {
			$_POST['subscription_start_at'] = strtotime($_POST['subscription_start_at']);
			$_POST['subscription_end_at'] = strtotime("+".$_POST['duration']." days", $_POST['subscription_start_at']);
		}

		$_POST['susbcription_status'] = 1;
		$_POST['payer']['payment_source'] = $_POST['payment_source'];

		if(VAT) {
			$vat = ($_POST['premium_price'] / 1.12) * (12 / 100);
			$net_amount = ($_POST['premium_price'] / 1.12);
		}else {
			$vat = 0;
			$net_amount = $_POST['premium_price'];
		}

		$transaction = $this->getModel("Transaction");
		$response = $transaction->saveNew([
			"account_id" => $_POST['account_id'],
			"premium_id" => $_POST['premium_id'],
			"premium_description" => $_POST['premium_description'],
			"premium_price" => $_POST['premium_price'],
			"duration" => $_POST['duration'],
			"payer" => json_encode($_POST['payer']),
			"payment_transaction_id" => DATE_NOW,
			"payment_source" => $_POST['payment_source'],
			"payment_status" => "COMPLETED",
			"transaction_details" => json_encode([
				"status" => "COMPLETED",
				"seller_receivable_breakdown" => [
					"gross_amount" => [
						"currency_code" => "PHP",
						"value" => $_POST['premium_price']
					],
					"tax_amount" => [
						"currency_code" => "PHP",
						"value" => $vat
					],
					"platform_fee" => [
						"currency_code" => "PHP",
						"value" => 0
					],
					"net_amount" => [
						"currency_code" => "PHP",
						"value" => $net_amount
					]
				],
				"transaction" => [
					"account_id" => $this->session['account_id'],
					"account_type" => $this->session['account_type'],
					"account_permissions" => $this->session['permissions'],
					"name" => $this->session['name'],
					"created_at" => DATE_NOW
				],
				"create_time" => date("Y-m-d H:i:s",DATE_NOW)
			]),
			"created_at" => DATE_NOW,
			"modified_at" => 0
		]);

		$_POST['transaction_id'] = $response['id'];

		$account_subscription = $this->getModel("AccountSubscription");
		$response = $account_subscription->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}

	function updateStatus($id) {

		$account_subscription = $this->getModel("AccountSubscription");
		$account_subscription->column['account_subscription_id'] = $id;
		$data = $account_subscription->getById();

		if($data['subscription_status'] == 1) {
			$status = 0;
			$label = "Activate";
		}else { 
			$status = 1; 
			$label = "Deactivate";
		}

		$response = $account_subscription->save($id,[
			'subscription_status' => $status
		]);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg(),
			"label" => $label
		));

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