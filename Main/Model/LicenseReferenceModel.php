<?php

namespace Main\Model;

class LicenseReferenceModel extends \Main\Model {

	function __construct() {
		$this->table = "license_reference";
		$this->primary_key = "reference_id";
		$this->init();
	}

	function getByLicenseId($license_id) {

		$v = $this->getValidator();
		$v->validateGeneral($license_id,"Real Estate Broker PRC License Number is needed!");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => $v->listErrors('<br/> * ')
			);
		}else {

			$query = "SELECT reference_id, prc_license_id FROM #__".$this->table." WHERE prc_license_id = '".$license_id."' ".$this->and;
			$result = $this->DBO->query($query);

			$this->initiateFields($result);

			if($this->DBO->numRows($result) > 0) {
				$line = $this->DBO->fetchAssoc($result);
				$data = $this->stripQuotes($line);
			}else {
				$data['reference_id'] = 0;
			}
			
			return array(
				"status" => 1,
				"data" => $data
			);
			
		}
	}
	
	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['prc_license_id'],"Real Estate Broker PRC License Number is needed!");
		
		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => $v->listErrors('<br/> * ')
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

			$v->validateGeneral($data['prc_license_id'],"Real Estate Broker PRC License Number is needed!");

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

	function deleteLicenseReference($id,$column = "reference_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}