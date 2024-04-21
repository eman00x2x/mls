<?php

namespace Main\Model;

use Verot\Upload\Upload as Upload;

class KYCModel extends \Main\Model {

	public $status_description = [
		0 => "Pending Verification",
		1 => "Verified",
		2 => "Denied",
		3 => "Expired"
	];

	public $verification_explanation = [
		"Personal information does not match in ID",
		"Low-resolution selfie picture",
		"Blurred selfie picture",
		"Invalid selfie picture",
		"Invalid selfie picture and ID",
		"Invalid ID",
		"Blurred ID",
		"Expired ID",
		/* "Birth date does not match on ID", */
		"ID expiration not indicated",
		"ID details cannot be seen",
		"ID too small",
		"Low-resolution ID",
		"Documents Accepted"
	];

	function __construct() {
		$this->table = "kyc";
		$this->primary_key = "kyc_id";
		$this->init();
	}

	function getByAccountId() {
		$this->where(" account_id = ". $this->column['account_id'] );
		return $this->getList();
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['documents']['kyc']['selfie'], "Upload your selfie");
		$v->validateGeneral($data['documents']['kyc']['id'], "Upload your ID");
		$v->validateDate($data['id_expiration_date'], "ID Expiration Date");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<br /> *".$v->listErrors('<br/> * ')
			);
		}else {

			$data['documents']['kyc']['selfie'] = $this->moveUploadedImage($data['documents']['kyc']['selfie'], "public/kyc/{$data['account_id']}");
			$data['documents']['kyc']['id'] = $this->moveUploadedImage($data['documents']['kyc']['id'], "public/kyc/{$data['account_id']}");
			
			$data['documents'] = json_encode($data['documents']);

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

			$this->column['documents'] = json_encode($this->column['documents']);

			$v = $this->getValidator();

			$v->validateGeneral($this->column['documents'], "Upload your selfie and ID");
			
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

	function deleteKYC($id,$column = "kyc_id") {
		$this->delete($id,$column);
	}

	function moveUploadedImage($filename, $path = "/images/accounts") {

        $old_dir = ROOT."/Cdn/public/temporary/".$filename;

		if(file_exists($old_dir)) {

			$name = explode(".",$filename);
			$ext = array_pop($name);

			$length = 20;
			$new_name = '';
			$chars = range(0, 9);

			for ($x = 0; $x < $length; $x++) {
				$new_name .= $chars[array_rand($chars)];
			}

			$new_filename = base64_encode($new_name.md5(time())).".".$ext;
		
			$new_dir = ROOT."/Cdn/$path/";

			if(!is_dir($new_dir)) {
				mkdir($new_dir, 0775, true);
			}

			rename($old_dir,$new_dir."/".$new_filename);
			return CDN."$path/".$new_filename;
		}

	}

	function uploadPhoto($data, $path = "/images/accounts") {

		$handle = new Upload($data);

		if ($handle->uploaded) {

			$handle->allowed = array('image/*');
			$handle->forbidden = array('application/*', 'text/javascript', 'application/x-javascript');

			$handle->file_safe_name 	= true;
			
			$handle->Process(ROOT."/Cdn/public/temporary/");

			if ($handle->processed) {
				return json_encode(array(
					"status" => 1,
					"message" => "Uploaded successfully",
					"filename" => $handle->file_dst_name,
					"temp_url" => CDN."public/temporary/".$handle->file_dst_name,
					"url" => CDN."$path/".$handle->file_dst_name
				));
			}

		}

	}

	function removePhoto($filename, $path = "/images/accounts") {

		$file = ROOT."/Cdn".$path."/".$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

}
