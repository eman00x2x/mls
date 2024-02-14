<?php

namespace Main\Model;

class AccountModel extends \Main\Model {

	function __construct() {
		
		$this->table = "accounts";
		$this->primary_key = "account_id";

		$this->init();
	}

	function getByEmail() {

		$query = "SELECT * FROM #__users WHERE email = '".$this->email."'";
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {

			$line = $this->DBO->queryUniqueValue($query);
			$this->user_id = $line['user_id'];
			return $this->getById();

		}else {return false;}

	}

	function saveNew($data) {

		$required_fields = array("real_estate_license_number","firstname","lastname","email");

		foreach($required_fields as $value) {
			if(!array_key_exists($value,$data)) {

				return array(
					"status" => 2,
					"type" => "error",
					"message" => ucwords($value)." is a required field"
				);

			}
		}

		$v = $this->getValidator();

		$v->validateGeneral($data['real_estate_license_number'],"Real Estate License Number");
		$v->validateGeneral($data['firstname'],"First Name");
		$v->validateGeneral($data['lastname'],"Last Name");
		$v->validateEmail($data['email'],"Email Address");
		
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

		$this->{$this->primary_key} = $id;

		if(($this->getById()) !== false) {

			$v = $this->getValidator();

			if(isset($data['firstname'])) {
				$v->validateGeneral($data['firstname'],"First Name");
			}

			if(isset($data['lastname'])) {
				$v->validateGeneral($data['lastname'],"Last Name");
			}

			if(isset($data['email'])) {
				$v->validateEmail($data['email'],"Email Address");
			}

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

	function moveUploadedImage($filename) {

        $old_dir = ROOT.DS."Cdn".DS."images".DS."temporary".DS.$filename;

		if(file_exists($old_dir)) {

			$name = explode(".",$filename);
			$ext = array_pop($name);

			$length = 50;
			$new_name = '';
			$chars = range(0, 9);

			for ($x = 0; $x < $length; $x++) {
				$new_name .= $chars[array_rand($chars)];
			}

			$new_filename = $new_name."_".md5(time()).".".$ext;
		
			$new_dir = ROOT.DS."Cdn".DS."images".DS."accounts".DS.$new_filename;
			rename($old_dir,$new_dir);

			return CDN."images/accounts/".$new_filename;
		}

	}

	function uploadPhoto($data) {

		$handle = new \Vendor\Upload\Upload($data);

		if ($handle->uploaded) {

			$handle->allowed = array('image/*');
			$handle->forbidden = array('application/*');

			$handle->file_safe_name 	= true;
			$handle->image_resize         = true;
			$handle->image_x              = 200;
			$handle->image_ratio_y        = true;

			$handle->Process(ROOT."/Cdn/images/temporary/");

			if ($handle->processed) {
				return json_encode(array(
					"status" => 1,
					"message" => "Logo uploaded successfully",
					"filename" => $handle->file_dst_name,
					"temp_url" => CDN."/images/temporary/".$handle->file_dst_name,
					"url" => CDN."/images/accounts/".$handle->file_dst_name
				));
			}

		}

	}

	function removePhoto($filename) {

		$file = ROOT.DS."Cdn".DS."images".DS."accounts".DS.$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

	function deleteAccount($id,$column = "account_id") {

		$this->account_id = $id;
		$data = $this->getById();
		$this->removePhoto($data['logo']);

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
