<?php

namespace Main\Model;

use Verot\Upload\Upload as Upload;

class OpenHouseAnnouncementModel extends \Main\Model {

	function __construct() {
		$this->table = "open_house_announcements";
		$this->primary_key = "announcement_id";
		$this->init();
	}

	function getByAccountId() {
		$this->where(" account_id = ". $this->column['account_id'] );
		return $this->getList();
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['subject'], "Subject is required");
		$v->validateDate($data['started_at'], "Start is not a date");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<br /> *".$v->listErrors('<br/> * ')
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

	function deleteOpenHouseAnnouncement($id,$column = "announcement_id") {
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
