<?php

namespace Main\Model;

class MessageModel extends \Main\Model {

	function __construct() {
		$this->table = "messages";
		$this->primary_key = "message_id";
		$this->init();
	}

	function getByThreadId($thread_id) {
        $this->where(" thread_id = ".$thread_id);
        return $this->getList();
    }

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['thread_id'],"Does not have thread_id");
		$v->validateGeneral($data['user_id'],"User is required");
		$v->validateGeneral($data['created_at'],"Time sent is required");

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

			$v->validateGeneral($data['thread_id'],"Does not have thread_id");
			$v->validateGeneral($data['user_id'],"User is required");
			$v->validateGeneral($data['created_at'],"Time sent is required");

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

	function deleteMessage($id,$column = "message_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
