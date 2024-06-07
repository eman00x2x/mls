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

				if(!isset($data['websocket'])) { $this->column['websocket'] = json_encode($this->column['websocket']); }
				if(!isset($data['privileges'])) { $this->column['privileges'] = json_encode($this->column['privileges']); }
				if(!isset($data['property_tags'])) { $this->column['property_tags'] = json_encode($this->column['property_tags']); }
				if(!isset($data['contact_info'])) { $this->column['contact_info'] = json_encode($this->column['contact_info']); }
				if(!isset($data['paypal_credentials'])) { $this->column['paypal_credentials'] = json_encode($this->column['paypal_credentials']); }
				if(!isset($data['email_address_responder'])) { $this->column['email_address_responder'] = json_encode($this->column['email_address_responder']); }
				if(!isset($data['payment_gateway'])) { $this->column['payment_gateway'] = json_encode($this->column['payment_gateway']); }
				if(!isset($data['kyc_options'])) { $this->column['kyc_options'] = json_encode($this->column['kyc_options']); }

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
