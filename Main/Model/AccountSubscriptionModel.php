<?php

namespace Main\Model;

class AccountSubscriptionModel extends \Main\Model {

	function __construct() {
		$this->table = "account_subscriptions";
		$this->primary_key = "account_subscription_id";
		$this->init();
	}

	function getSubscription() {

		$this->page["limit"] = 999999;
		$this
		->join(" acs JOIN #__premiums p ON p.premium_id = acs.premium_id ")
		->where(" (subscription_end_date >= '".DATE_NOW."' OR subscription_status = 1) ")
		->and(" subscription_status = 1 AND account_id = ". $this->column['account_id'] );

		$data = $this->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				foreach($data[$i]['script'] as $key => $val) {

					if(!isset($privileges[$key])) {
						$privileges[$key] = 0;
					}

					$privileges[$key] += $val;
				}
			}

			return $privileges;
		}

		return false;		

	}

	function saveNew($data) {

		$required_fields = array("account_id","subscription_start_date");

		foreach($required_fields as $value) {
			if(!array_key_exists($value,$data)) {

				return array(
					"status" => 2,
					"type" => "error",
					"message" => ucwords($value)." is a required field"
				);

			}
		}

		$v = $this->getValidator();

		$v->validateDate($data['subscription_start_date']," Subscription Start Date is blank.");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<h4 class='font-weight-bold'>Error</h4> * ".$v->listErrors('<br/> * ')
			);
		}else {

			foreach($data as $key => $val) {
				$this->column[$key] = $val;
			}

			$id = $this->insert();

			return array(
				"status" => 1,
				"type" => "success",
				"id" => $id,
				"message" => "Successfully saved"
			);

		}
	}

	function save($id,$data) {

		$this->column[$this->primary_key] = $id;

		if(($this->getById()) !== false) {

			$v = $this->getValidator();

			if($v->foundErrors()) {
				return array(
					"status" => 2,
					"type" => "error",
					"message" => "Please correct the following: ".$v->listErrors(', ')
				);
			}else {

				foreach($data as $key => $val) {
					$this->column[$key] = $val;
				}

				$this->update();

				return array(
					"status" => 1,
					"type" => "success",
					"message" => "Successfully saved"
				);

			}
		}

	}

	function deleteSubscription($id,$column = "account_subscription_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
