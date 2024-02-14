<?php

namespace Main\Model;

class SettingModel extends \Main\Model {

	function __construct() {
		$this->table = "settings";
		$this->primary_key = "id";
		$this->init();
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

				if(isset($data['property_tags'])) {
					$data['property_tags'] = json_encode(explode(", ",$data['property_tags']));
				}else {
					$this->column['property_tags'] = json_encode($this->column['property_tags']);
				}

				if(isset($data['contact_info'])) {
					$data['contact_info'] = json_encode($data['contact_info']);
				}else {
					$this->column['contact_info'] = json_encode($this->column['contact_info']);
				}

				if(isset($data['paypal_credentials'])) {
					$data['paypal_credentials'] = json_encode($data['paypal_credentials']);
				}else {
					$this->column['paypal_credentials'] = json_encode($this->column['paypal_credentials']);
				}

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

}
