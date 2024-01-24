<?php

namespace Admin\Application\Controller;

class ListingImagesController extends \Main\Controller {
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function delete($image_id) {
		
		$filename = isset($_REQUEST['filename']) ? $_REQUEST['filename'] : false;
		
		if($filename) {
		
			$listingImage = $this->getModel("ListingImage");
			$data = $listingImage->removeImage($filename);
			
			$listingImage->column['image_id'] = "'$image_id'";
			if($listingImage->getById()) {
				/* DELETE DATABASE RECORD IF EXISTS */
				$listingImage->delete($image_id,"image_id");
			}

			$this->getLibrary("Factory")->setMsg("Image successfully deleted.","success");
			return json_encode(array(
				"status" => 1,
				"message" => getMsg()
			));
			
			
		}else {
			$this->getLibrary("Factory")->setMsg("You click or copy an invalid link.","success");
			return json_encode(array(
				"status" => 1,
				"message" => getMsg()
			));
		}
		
	}
	
}