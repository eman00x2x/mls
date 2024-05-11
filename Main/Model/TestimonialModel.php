<?php

namespace Main\Model;

class TestimonialModel extends \Main\Model {

	function __construct() {
		$this->table = "testimonials";
		$this->primary_key = "testimonial_id";
		$this->init();
	}

	function getByAccountId() {

		$this->where(" account_id = ".$this->column['account_id'] );
		return $this->getList();

	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['name'],"Client Name is required");
		$v->validateGeneral($data['content'],"Client testimonial is required");

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

			$v->validateGeneral($data['name'],"Client Name is required");
			$v->validateGeneral($data['content'],"Client testimonial is required");

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

	function deleteTestimonials($id,$column = "testimonial_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
