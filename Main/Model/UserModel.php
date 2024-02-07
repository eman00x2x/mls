<?php

namespace Main\Model;

class UserModel extends \Main\Model {

	function __construct() {
		$this->table = "users";
		$this->primary_key = "user_id";
		$this->init();
	}

	function getByAccountId() {
		$this->where(" account_id = ".$this->column['account_id']." ");
		return $this->getList();
	}

	function getByUsernameAndPassword() {

		$query = "SELECT * FROM #__users u JOIN #__accounts a ON a.account_id=u.account_id WHERE username = '".$this->column['username']."' AND password = '".$this->column['password']."'";
		$result = $this->DBO->query($query);
		
		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function getByEmailAndPassword() {

		$query = "SELECT * FROM #__users u JOIN #__accounts a ON a.account_id=u.account_id WHERE u.email = '".$this->column['email']."' AND password = '".$this->column['password']."'";
		$result = $this->DBO->query($query);
		
		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function getByUsername() {

		$query = "SELECT * FROM #__users WHERE username = '".$this->column['username']."' ".$this->where." ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function getByEmail() {

		$query = "SELECT * FROM #__users WHERE email = '".$this->column['email']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function saveNew($data) {

		$required_fields = array("password","email");

		foreach($required_fields as $value) {
			if(!array_key_exists($value,$data)) {

				return array(
					"status" => 2,
					"type" => "error",
					"message" => ucwords($value)." is a required field"
				);

			}
		}

		/* $this->column['username'] = strtolower($data['username']);
		if($this->getByUsername()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "Username already exists."
			);
		} */

		$this->column['email'] = strtolower($data['email']);
		if($this->getByEmail()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "email already exists."
			);
		}

		$v = $this->getValidator();

		/* $v->validateUsername($data['username'], "Username must only contain alphanumeric, numbers and underscore no spaces and special characters.");
		if(strlen($data['username']) < 4) {
			$v->addError("Username must have 6 characters long.");
		} */

		/* $v->validateWords($data['username'],"Invalid username. You cannot use '".$data['username']."' for your username."); */
		$v->validateEmail($data['email'],"* Invalid email");
		$v->validateGeneral($data['password'],"Enter password");

		if(strlen($data['password']) < 8) {
			$v->addError("Password must have 8 characters long.");
		}

		$v->confirmPassword($data['password'],$data['cpassword']," Password does not match");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => '<br/>'.$v->listErrors('<br/> * ')
			);
		}else {

			$data['password'] = md5($data['password']);

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

			if(isset($data['username'])) {
				$this->and(" user_id != $id ");
				$this->column['username'] = $data['username'];
				if($this->getByUsername()) {
					return array(
						"status" => 2,
						"type" => "error",
						"message" => "Username already exists."
					);
				}

				$v->validateUsername($data['username'], "Username must only contain alphanumeric, numbers and underscore no spaces and special characters.");
				if(strlen($data['username']) < 4) {
					$v->addError("Username must have 6 characters long.");
				}

				$v->validateWords($data['username'],"Invalid username. You cannot use '".$data['username']."' for your username.");
				
			}

			if(isset($data['password']) && $data['password'] != "") {

				$v->confirmPassword($data['password'],$data['cpassword'],"Password not match");
				$v->validateGeneral($data['password'],"Enter password");

				if(strlen($data['password']) < 8) {
					$v->addError("Password must have 8 characters long.");
				}

				$data['password'] = md5($data['password']);

			}else {
				unset($data['password']);
				unset($data['cpassword']);
			}

			if(isset($data['name'])) {
				$v->validateGeneral($data['name'],"Full Name");
			}

			if($v->foundErrors()) {
				return array(
					"status" => 2,
					"type" => "error",
					"message" => "Please correct the following: ".$v->listErrors(', ')
				);
			}else {

				$this->column['permissions'] = json_encode($this->column['permissions']);

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
		
			$new_dir = ROOT.DS."Cdn".DS."images".DS."users".DS.$new_filename;
			rename($old_dir,$new_dir);

			return CDN."images/users/".$new_filename;
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

		$file = ROOT.DS."Cdn".DS."images".DS."users".DS.$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

	function deleteUser($id,$column = "user_id") {

		$this->user_id = $id;
		$data = $this->getById();
		$this->removePhoto($data['photo']);

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

}
