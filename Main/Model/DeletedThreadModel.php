<?php

namespace Main\Model;

class DeletedThreadModel extends \Main\Model {

	function __construct() {
		$this->table = "deleted_threads";
		$this->primary_key = "id";
		$this->init();
	}

	function getByAccountId() {
		return $this->DBO->queryUniqueValue("SELECT ".($this->select != "" ? $this->select : "*")." FROM #__".$this->table." WHERE account_id = ".$this->column['account_id']);
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['thread_id'],"thread_id ");
		$v->validateGeneral($data['account_id'],"account_id");

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

			$v->validateGeneral($data['thread_id'],"thread_id ");
			$v->validateGeneral($data['account_id'],"account_id");

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

	function deleteDeletedThread($id,$column = "id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
