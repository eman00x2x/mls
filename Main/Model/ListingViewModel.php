<?php

namespace Main\Model;

class ListingViewModel extends \Main\Model {

	function __construct() {
		$this->table = "listings_view";
		$this->primary_key = "listing_view_id";
		$this->init();
	}

	function getBySessionId() {
		$query = "SELECT ".($this->select == "" ? "*" : $this->select)." FROM #__listings_view ".$this->join." WHERE session_id = '".$this->column['session_id']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['account_id'],"account_id is not set.");
		$v->validateGeneral($data['listing_id'],"listing_id is not set.");

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

			$v->validateGeneral($data['account_id'],"account_id is not set.");
			$v->validateGeneral($data['listing_id'],"listing_id is not set.");

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

	function deleteListingView($id,$column = "listing_view_id") {
		$this->delete($id,$column);
	}
}
