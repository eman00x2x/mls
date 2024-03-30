<?php

namespace Main\Model;

class ArticleModel extends \Main\Model {

	public $category = [
		"News", "Promo", "Tips", "Events"
	];

	function __construct() {
		$this->table = "articles";
		$this->primary_key = "article_id";
		$this->init();
	}

	function setCategory($new_category) {
		$this->category += $new_category;
		return $this->category;
	}

	function getCategory() {
		return $this->category;
	}

	function getByName() {
		$query = "SELECT ".($this->select == "" ? "*" : $this->select)." FROM #__articles WHERE name = '".$this->column['name']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['title'],"Title");
		$v->validateGeneral($data['content'],"Content");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<h4 class='font-weight-bold'>Error</h4> * ".$v->listErrors('<br/> * ')
			);
		}else {

			if(isset($data['title'])) {
				$data['name'] = sanitize($data['title']);
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

		$this->column[$this->primary_key] = $id;

		if(($this->getById()) !== false) {

			$v = $this->getValidator();

			$v->validateGeneral($data['content'],"Content");

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

	function deleteArticle($id,$column = "article_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

	function moveUploadedImage($filename) {

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
		
			$new_dir = ROOT."Cdn/images/articles/".$new_filename;
			rename($old_dir,$new_dir);

			return CDN."images/articles/".$new_filename;
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
					"url" => CDN."/images/articles/".$handle->file_dst_name
				));
			}

		}

	}

	function removePhoto($filename) {

		$file = ROOT."Cdn/images/articles/".$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

}
