<?php

namespace Main\Model;

class HandshakeModel extends \Main\Model {

	function __construct() {
		$this->table = "handshakes";
		$this->primary_key = "handshake_id";
		$this->init();
	}

	function getByRequesteeAccountId() {

		$query = "SELECT * FROM #__users WHERE requestee_account_id = '".$this->column['requestee_account_id']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

		
	}

	function getByRequestorAccountId() {

		$query = "SELECT * FROM #__users WHERE requestor_account_id = '".$this->column['requestor_account_id']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function saveNew($data) {

		$required_fields = array("requestor_account_id","requestee_account_id","listing_id");

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

		$v->validateGeneral($data['requestor_account_id']," Requestor Account Id not found!");
		$v->validateGeneral($data['requestee_account_id']," Requestee Account Id not found!");
		$v->validateGeneral($data['listing_id']," Listing ID not found!");

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

			$v->validateGeneral($data['requestor_account_id']," Requestor Account Id not found!");
			$v->validateGeneral($data['requestee_account_id']," Requestee Account Id not found!");
			$v->validateGeneral($data['listing_id']," Listing ID not found!");

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

	function deleteHandshake($id,$column = "handshake_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
