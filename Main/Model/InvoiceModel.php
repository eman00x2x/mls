<?php

namespace Main\Model;

class InvoiceModel extends \Main\Model {

	function __construct() {
		$this->table = "invoice";
		$this->primary_key = "invoice_id";
		$this->init();
	}

	function saveNew($data) {

		$required_fields = array("account_id","details","invoice_amount","invoice_date");

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

		$v->validateGeneral($data['account_id'],"Account ID");
		$v->validateGeneral($data['details'],"Invoice Details");
		$v->validateGeneral($data['invoice_amount'],"Invoice Amount");
		$v->validateDate($data['invoice_date'],"Invoice Date");
		
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

			$v->validateGeneral($data['account_id'],"Account ID");
			$v->validateGeneral($data['details'],"Invoice Details");
			$v->validateGeneral($data['invoice_amount'],"Invoice Amount");
			$v->validateDate($data['invoice_date'],"Invoice Date");

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

	function deleteInvoice($id,$column = "invoice_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
