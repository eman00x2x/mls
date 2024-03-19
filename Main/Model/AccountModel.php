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

		$name = json_decode($data['account_name'],true);
		$v->validateGeneral($name['firstname'],"First Name");
		$v->validateGeneral($name['lastname'],"Last Name");
		$v->validateEmail($data['email'],"Email Address");
		
		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => $v->listErrors('<br/> * ')
			);
		}else {

			if(isset($data['message_keys'])) {
				$data['message_keys'] = json_encode($data['message_keys']);
			}else {
				$this->column['message_keys'] = json_encode($this->column['message_keys']);
			}

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

			$name = json_decode($data['account_name'],true);
			$v->validateGeneral($name['firstname'],"First Name");
			$v->validateGeneral($name['lastname'],"Last Name");

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

				if(isset($data['privileges'])) {
					$data['privileges'] = json_encode($data['privileges']);
				}else {
					$this->column['privileges'] = json_encode($this->column['privileges']);
				}

				if(isset($data['message_keys'])) {
					$data['message_keys'] = json_encode($data['message_keys']);
				}else {
					$this->column['message_keys'] = json_encode($this->column['message_keys']);
				}

				if(isset($data['uploads'])) {

					foreach($data['uploads'] as $key => $val) {
						$this->column['uploads'][$key] = $val;
					}

					$data['uploads'] = json_encode($this->column['uploads']);

				}else {
					$this->column['uploads'] = json_encode($this->column['uploads']);
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

	function moveUploadedImage($filename, $path = "/images/accounts") {

        $old_dir = ROOT."Cdn/images/temporary/".$filename;

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
		
			$new_dir = ROOT."Cdn/$path/";

			if(!is_dir($new_dir)) {
				mkdir($new_dir, 0775, true);
			}

			rename($old_dir,$new_dir."/".$new_filename);

			return CDN."$path/".$new_filename;
		}

	}

	function uploadPhoto($data, $path = "/images/accounts") {

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
					"message" => "Uploaded successfully",
					"filename" => $handle->file_dst_name,
					"temp_url" => CDN."images/temporary/".$handle->file_dst_name,
					"url" => CDN."$path/".$handle->file_dst_name
				));
			}

		}

	}

	function removePhoto($filename, $path = "/images/accounts") {

		$file = ROOT."Cdn".$path."/".$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

	function deleteAccount($id,$column = "account_id") {

		$this->column['account_id'] = $id;
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
