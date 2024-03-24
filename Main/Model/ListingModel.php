<?php

namespace Main\Model;

class ListingModel extends \Main\Model {

	function __construct() {
		$this->table = "listings";
		$this->primary_key = "listing_id";
		$this->init();
	}

	function getByAccountId() {
		$this->where(" account_id = ". $this->column['account_id'] );
		return $this->getList();
	}

	function getByName() {

		$query = "SELECT * FROM #__listings WHERE name = '".$this->column['name']."' ".$this->and;
		$result = $this->DBO->query($query);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {
			$line = $this->DBO->fetchAssoc($result);
			return $this->stripQuotes($line);
		}else {return false;}

	}

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['name'],"Do not leave the name blank.");
		$v->validateGeneral($data['category'],"category is blank.");
		$v->validateGeneral($data['type'],"type is blank.");
		$v->validateGeneral($data['offer'],"offer is blank.");
		$v->validateGeneral($data['tags'],"no selected tags.");

		$other_details = json_decode($data['other_details'],true);
		$v->validateNumber($other_details['com_share'],"Commission share is required.");
		$v->validateDate($other_details['authority_to_sell_expiration'],"Authority to Sell Expiration Date is required.");

		$address = json_decode($data['address'],true);

		$v->validateGeneral($address['region'],"Region is blank.");
		$v->validateGeneral($address['province'],"Province is blank.");
		$v->validateGeneral($address['municipality'],"Municipality is blank.");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<h4 class='font-weight-bold'>Error</h4> * ".$v->listErrors('<br/> * ')
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

			$v->validateGeneral($data['name'],"Do not leave the name blank.");
			$v->validateGeneral($data['category'],"category is blank.");
			$v->validateGeneral($data['type'],"type is blank.");
			$v->validateGeneral($data['offer'],"offer is blank.");
			$v->validateGeneral($data['tags'],"no selected tags.");

			$other_details = json_decode($data['other_details'],true);
			$v->validateNumber($other_details['com_share'],"Commission share is required.");
			$v->validateDate($other_details['authority_to_sell_expiration'],"Authority to Sell Expiration Date is required.");

			$address = json_decode($data['address'],true);

			$v->validateGeneral($address['region'],"Region is blank.");
			$v->validateGeneral($address['province'],"Province is blank.");
			$v->validateGeneral($address['municipality'],"Municipality is blank.");

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

	function uploadImage($data) {

		if(count($data['name']) > 5) {
			
			\Library\Factory::setMsg("Select 5 or less images per upload!","wrong");
			$uploadedImages[] = array(
				"status" => 2,
				"message" => getMsg()
			);

			return json_encode($uploadedImages);
		}
		
		require_once(ROOT.DS."vendor".DS."upload".DS."upload.php");
		
		$files = array();
		foreach ($data as $k => $l) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files))
					$files[$i] = array();
					$files[$i][$k] = $v;
			}
		}
		
		foreach ($files as $file) {

			$handle = new \Vendor\Upload\Upload($file); 

			if ($handle->uploaded) {
			
				$handle->file_safe_name = true;

				$handle->file_max_size = '2048000';
				$handle->allowed = array('image/*');
				$handle->forbidden = array('application/*');
				
				if($handle->image_src_x > 800) {
					$handle->image_resize = true;
					$handle->image_x = 800;
					$handle->image_ratio_y = true;
				}
				
				$handle->Process(ROOT."/Cdn/images/temporary/"); 
				
				if ($handle->processed) {
				
					$uploadedImages[] = array(
						"status" => 1,
						"id" => rand(1000,10000).time(),
						"filename" => $handle->file_dst_name,
						"width" => $handle->image_dst_x,
						"height" => $handle->image_dst_y,
						"application" => "listings"
					);
				
				}else {

					\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only image are allowed and less than 2MB file sizes are allowed, Please check your image file size before uploading.","wrong");
					
					$uploadedImages[] = array(
						"status" => 2,
						"message" => getMsg()
					);
					
				}
			}else {
				\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only image are allowed and less than 2MB file sizes are allowed, Please check your image file size before uploading.","wrong");
				$uploadedImages[] = array(
					"status" => 2,
					"message" => getMsg()
				);
			}

			unset($handle);
		}
		
		return json_encode($uploadedImages);
		
	}

	function deleteListing($id,$column = "listing_id") {

		$this->delete($id,$column);

	}

	function categories() {
	
		return [
			"Residential" => ["House and Lot", "Apartment", "Townhouse", "Condominium", "Condotel", "Residential Lot"],
			"Commercial" => ["Office/Building", "Retail Space", "Hotel", "Commercial Lot"],
			"Industrial" => ["Warehouse", "Factory (Plant)", "Commisary"],
			"Agricultural" => ["Agriculture Lot"],
			"Leisure" => ["Island", "Resort"],
			"Shares" => ["Golf Shares", "Club/Resort Shares"],
			"Others" => ["Memorial Lot", "Columbarium", "Parking Space", "Storage Units"]
			
			/* "Building" => ["Retail","Offices","Serviced Office"],
			"Land" => ["Beach Lot","Farm Lot","Subdivision Lot","Agricultural Lot","Land Only","Island","Memorial"],
			"House" => ["House and Lot","Beach House","Bungalow","Multiple Storey House","Cabin"],
			"Townhouse" => ["Townhouse","Rowhouse","Duplex House"],
			"Leisures" => ["Resorts", "Hotel"],
			"Condominium" => ["Condominium","Studio Type","Loft Type","Penthouse","Condotel","Apartments"] */
		];
		
	}
	
	function categorySelection($currentValue = null) {
		
		$html[] = "<select name='category' id='category' class='form-select cursor-pointer'>";
		foreach($this->categories() as $key => $mainCategory) {
			$html[] = "<optgroup label='$key'>";
			foreach($mainCategory as $subCategory) {
				$sel = $currentValue == $subCategory ? "selected" : "";
				$html[] = "<option value='".utf8_encode("$subCategory")."' $sel>".utf8_encode("$subCategory")."</option>";
			}
			$html[] = "</optgroup>";
		}
		$html[] = "</select>";
		
		return implode("",$html);
	}

	function amenities() {
		return [
			"Lap Pool","Swimming Pool","Jaccuzi","Tennis Court","Bowling Room","Basket Ball Court","Pet-Friendly Residences",
			"Movie Rooms","Game rooms","Libraries and study rooms","Chapels","Clinics","Day care centers","Lobby","Childrens Play Area",
			"Club House","Function Halls","Fitness Center","Spas",
			"Perimeter Fence","Centralized Water System","Eco-friendly and Energy-efficient Homes","24 Hours Security","Guard House","Gated Community","Working Waste Disposal System","Power Backup","Fire Alarms and Suppression System","CCTV Cameras",
			"Proximity to Public Transport","Near Malls","Near Hospitals","Near Public Markets","Near in Churches","Near in Schools","Shuttles"
		];
	}

}
