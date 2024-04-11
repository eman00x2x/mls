<?php

namespace Main\Model;

class ListingImageModel extends \Main\Model {

	function __construct() {
		$this->table = "listing_images";
		$this->primary_key = "image_id";
		$this->init();
	}

	function getByListingId() {

		$this->where(" listing_id = " . $this->column['listing_id']);
		return $this->getList();

	}

	function saveImages($listing_id,$data) {

		$score = 0;
	
		foreach($data as $key => $image) {

			$old_filename = ROOT.DS."Cdn".DS."images".DS."temporary".DS.$image['name'];
			if(file_exists($old_filename)) {
				
				$name = explode(".",$image['name']);
				$ext = array_pop($name);
				
				$new_name = md5($key.time()).".".$ext;
			
				$new_filename = ROOT.DS."Cdn".DS."images".DS."listings".DS.$new_name;
				rename($old_filename,$new_filename);
				
				$this->column['listing_id'] = $listing_id;
				$this->column['url'] = CDN."images/listings/".$new_name;
				$this->column['filename'] = $new_name;
				$this->column['width'] = $image['width'];
				$this->column['height'] = $image['height'];
				$this->column['img_sort'] = 0;
				$this->insert();

			}

			$score += ($image['width'] / 1024) + ($image['height'] / 1024);
			
		}

		/** DIVIDED BY 10 IMAGES */
		return ($score / 10);

	}
	
	function removeImage($filename) {
	
		$dir = ROOT.DS."Cdn".DS."images".DS."listings";
		$temp_dir = ROOT.DS."Cdn".DS."images".DS."temporary";
		
		/* check file if exists in temp folder */
		if(file_exists($temp_dir.DS.$filename)) {
		
			/* delete file in temp folder */
			@unlink($temp_dir.DS.$filename);
			return true;
			
		}else {
		
			/* file not exists in temp folder */
			/* check file if exists in main folder */
			if(file_exists($dir.DS.$filename)) {
				@unlink($dir.DS.$filename);
				return true;
			}else {
				return false;
			}
			
		}
	
	}
	
	function deleteListingImages($listing_id) {
		
		$this->where(" listing_id = $listing_id ");
		$data = $this->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$this->removeImage($data[$i]['filename']);
				$this->delete($data[$i]['image_id'],"image_id");
			}
		}
		
	}
	
}