<?php

namespace Main\Model;

class ThreadModel extends \Main\Model {

	function __construct() {
		$this->table = "threads";
		$this->primary_key = "thread_id";
		$this->init();
	}

	function getByParticipants(string $participants) {

		/** should match each participants and vise-versa [1,4] OR [4,1] */
		if(is_string($participants)) {
			$participants = json_decode($participants, true);

			if(is_array($participants)) {

				foreach($participants as $participant) {
					$filter[] = " JSON_CONTAINS(participants, '$participant')";
				}

				#$this->where(" (participants->>'$[0]' = ".$participants[0]." AND participants->>'$[1]' = ".$participants[1].") OR (participants->>'$[0]' = ".$participants[1]." AND participants->>'$[1]' = ".$participants[0].") ");
				$this->where( implode(" AND ", $filter) );
				$data = $this->getList();

				if($data) {
					return $data[0];
				}

			}
			
		}

		return false;

	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['participants'],"Does not have participants.");

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

				$data['participants'] = json_encode(isset($data['participants']) ? $data['participants'] : $this->column['participants']);

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

	function deleteThread($id,$column = "thread_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
