<?php

namespace Main\Model;

class LeadModel extends \Main\Model {

	function __construct() {
		$this->table = "leads";
		$this->primary_key = "lead_id";
		$this->init();
	}

	function getByListingId($listing_id) {
	    $this->where(" listing_id = ".$listing_id);
	    return $this->getList();
	}

	function getByAccountId($account_id) {
        $this->where(" account_id = ".$account_id);
        return $this->getList();
    }

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['listing_id'],"Listing not found");
		$v->validateGeneral($data['account_id'],"Account is required");
		$v->validateGeneral($data['inquire_at'],"Time sent is required");

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

			/* $v->validateGeneral($data['listing_id'],"Listing not found");
			$v->validateGeneral($data['account_id'],"Account is required");
			$v->validateGeneral($data['inquire_at'],"Time sent is required"); */

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

	function deleteLead($id,$column = "lead_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
