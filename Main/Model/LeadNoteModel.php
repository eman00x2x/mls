<?php

namespace Main\Model;

class LeadNoteModel extends \Main\Model {

	function __construct() {
		$this->table = "lead_notes";
		$this->primary_key = "note_id";
		$this->init();
	}

	function getByLeadId($lead_id) {
	    $this->where(" lead_id = ".$lead_id);
	    return $this->getList();
	}

	function getByAccountId($account_id) {
        $this->where(" account_id = ".$account_id);
        return $this->getList();
    }

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['content'],"Content is required");
		$v->validateGeneral($data['created_at'],"Date is required");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "* ".$v->listErrors('<br/> * ')
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

			$v->validateGeneral($data['content'],"Content is required");

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

	function deleteNote($id,$column = "note_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
