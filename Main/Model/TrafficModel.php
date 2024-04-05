<?php

namespace Main\Model;

class TrafficModel extends \Main\Model {

	function __construct() {
		$this->table = "traffics";
		$this->primary_key = "traffic_id";
		$this->init();
	}

	function getBySessionId() {

		$this->where(" session_id = '" . $this->column['session_id'] . "'");
		$data = $this->getList();

		if($data) {
			return $data;
		}else { return false; }
		
	}

	function saveNew($data) {

		$v = $this->getValidator();

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

	function deleteTraffic($id,$column = "traffic_id") {
		$this->delete($id,$column);
	}
}
