<?php

namespace Main\Model;

class PageAdsModel extends \Main\Model {

	/**
	 * FORMULA TO SHOW ADS 
	 * TOTAL_MINS_OF_IMPRESSION_PER_HOUR = 60 mins / TOTAL_ADS_IN_PLACEMENT
	 **/

	public $placements = [
		"PROPERTY_LIST_TOP" => [
			"size" => [
				"width" => 1024,
				"height" => 250
			]
		],
		"PROPERTY_VIEW_SIDEBAR_TOP" => [
			"size" => [
				"width" => 380,
				"height" => 280
			]
		],
		"PROPERTY_VIEW_SIDEBAR_BOTTOM" => [
			"size" => [
				"width" => 380,
				"height" => 280
			]
		],
		"ARTICLE_LIST_SIDEBAR" => [
			"size" => [
				"width" => 300,
				"height" => 300
			]
		],
		"ARTICLE_VIEW_SIDEBAR" => [
			"size" => [
				"width" => 300,
				"height" => 300
			]
		],
		"PROFILE_SIDEBAR_TOP" => [
			"size" => [
				"width" => 300,
				"height" => 300
			]
		]
	];

	function __construct() {
		$this->table = "page_ads";
		$this->primary_key = "page_ads_id";
		$this->init();
	}

	function getByPlacement($placement) {

		$this
			->select(" page_ads_id, banner, url, placement ")
				->where(" placement = '$placement' ")
					->and(" started_at < ".DATE_NOW." AND ended_at > ".DATE_NOW." AND visibility = 'visible' ");

		return $this->getList();
	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['banner'],"banner");
		$v->validateGeneral($data['placement'],"Placement");
		$v->validateGeneral($data['url'],"url");

		if($data['ended_at'] < DATE_NOW) {
			$v->addError("End Date should be greater than the current date.");
		}

		if($data['started_at'] < DATE_NOW) {
			$v->addError("Start Date should be greater than the current date.");
		}

		if($data['started_at'] > $data['ended_at']) {
			$v->addError("Start Date should be before the end date.");
		}

		if($data['ended_at'] < $data['started_at']) {
			$v->addError("End Date should be greater than the start date.");
		}

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

			$v->validateGeneral($data['banner'],"banner");
			$v->validateGeneral($data['placement'],"Placement");
			$v->validateGeneral($data['url'],"url");

			/* if($data['ended_at'] < DATE_NOW) {
				$v->addError("End Date should be greater than the current date.");
			}

			if($data['started_at'] < DATE_NOW) {
				$v->addError("Start Date should be greater than the current date.");
			}

			if($data['started_at'] > $data['ended_at']) {
				$v->addError("Start Date should be before the end date.");
			}

			if($data['ended_at'] < $data['started_at']) {
				$v->addError("End Date should be greater than the start date.");
			} */

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

	function deletePageAds($id,$column = "page_ads_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

	function moveUploadedImage($filename) {

        $old_dir = ROOT."Cdn/public/temporary/".$filename;

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
		
			$new_dir = ROOT."Cdn/public/page_ads/".$new_filename;
			rename($old_dir,$new_dir);

			return CDN."public/page_ads/".$new_filename;
		}

	}

	function uploadPhoto($data) {

		$handle = new \Vendor\Upload\Upload($data);

		if ($handle->uploaded) {

			$handle->allowed = array('image/*');
			$handle->forbidden = array('application/*');

			$handle->file_safe_name 	= true;

			$handle->Process(ROOT."/Cdn/public/temporary/");

			if ($handle->processed) {
				return json_encode(array(
					"status" => 1,
					"message" => "Logo uploaded successfully",
					"filename" => $handle->file_dst_name,
					"temp_url" => CDN."/public/temporary/".$handle->file_dst_name,
					"url" => CDN."/public/page_ads/".$handle->file_dst_name
				));
			}

		}

	}

	function removePhoto($filename) {

		$file = ROOT."Cdn/public/page_ads/".$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else {
			return false;
		}
		
	}

}
