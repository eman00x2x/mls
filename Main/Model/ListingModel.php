<?php

namespace Main\Model;

use Verot\Upload\Upload as Upload;

class ListingModel extends \Main\Model {

	public $address;
	public $app;
	public $list;

	function __construct() {
		$this->table = "listings";
		$this->primary_key = "listing_id";
		$this->init();
	}

	function getAllAndHandshakeByAccountId($account_id) {

		$this->setPagina($this->page['current'], $this->page['limit']);
		
		// l.listing_id, is_website, name, title, category, address, price, floor_area, lot_area, bedroom, bathroom, parking, thumb_img, modified_at, status
		$query = "
			SELECT ".$this->select."
			FROM `mls_listings` l
			".$this->join."
			WHERE a.account_id = $account_id
			".$this->and."

			UNION

			SELECT ".$this->select."
			FROM `mls_handshakes` h
			JOIN `mls_listings` l
			ON h.listing_id = l.listing_id
			WHERE h.requestor_account_id = $account_id
			AND h.handshake_status = 'accepted'
			".$this->and."
		";

		$result = $this->DBO->query($query . " LIMIT ". $this->page['starting_number'] .",". $this->page['limit']);

		$this->initiateFields($result);

		if($this->DBO->numRows($result) > 0) {

			$query = str_replace("SELECT", " SELECT COUNT(l.listing_id) AS total_row, " , $query);
			$query = $query . " LIMIT 1 ";
			$line = $this->DBO->queryUniqueValue($query);
			$this->rows = $line['total_row'];

			while($line = $this->DBO->FetchAssoc($result)) {
				$this->results[] = $this->stripQuotes($line);
			} 

			$this->total_pages = ceil($this->rows/$this->page['limit']);
			$this->pagination = $this->pagina->build($this, $this->page['target'],$this->page['uri']);
			
			return $this->results;
		}else {return false;}

	}

	function getByAccountId() {
		$this->where(" account_id = ". $this->column['account_id'] );
		return $this->getList();
	}

	function getFeaturedProperties() {
		$this->where(" featured = 1 " )->orderBy(" post_score DESC ");
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

		$v->validateGeneral($data['title'],"Do not leave the title blank.");
		$v->validateGeneral($data['category'],"category is blank.");
		$v->validateGeneral($data['type'],"type is blank.");
		$v->validateGeneral($data['offer'],"offer is blank.");
		$v->validateGeneral($data['tags'],"no selected tags.");
		$v->validateGeneral($data['duration'],"Select Posting Duration");

		if(isset($data['price'])) {
			$v->validateNumber($data['price'],"price is blank.");
		}

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

			if(isset($data['title'])) { $v->validateGeneral($data['title'],"Do not leave the name blank."); }
			if(isset($data['category'])) { $v->validateGeneral($data['category'],"category is blank."); }
			if(isset($data['type'])) { $v->validateGeneral($data['type'],"type is blank."); }
			if(isset($data['offer'])) { $v->validateGeneral($data['offer'],"offer is blank."); }
			if(isset($data['price'])) { $v->validateGeneral($data['price'],"price is blank."); }

			if(isset($data['other_details'])) {
				$other_details = json_decode($data['other_details'],true);
				$v->validateNumber($other_details['com_share'],"Commission share is required.");
				$v->validateDate($other_details['authority_to_sell_expiration'],"Authority to Sell Expiration Date is required.");
			}

			if(isset($data['address'])) {
				$address = json_decode($data['address'],true);
				$v->validateGeneral($address['region'],"Region is blank.");
				$v->validateGeneral($address['province'],"Province is blank.");
				$v->validateGeneral($address['municipality'],"Municipality is blank.");
			}

			if($v->foundErrors()) {
				return array(
					"status" => 2,
					"type" => "error",
					"message" => "Please correct the following: ".$v->listErrors(', ')
				);
			}else {

				if(!isset($data['is_mls_option'])) { $data['is_mls_option'] = json_encode($this->column['is_mls_option']); }
				if(!isset($data['tags'])) { $data['tags'] = json_encode($this->column['tags']); }
				if(!isset($data['address'])) { $data['address'] = json_encode($this->column['address']); }
				if(!isset($data['payment_details'])) { $data['payment_details'] = json_encode($this->column['payment_details']); }
				if(!isset($data['other_details'])) { $data['other_details'] = json_encode($this->column['other_details']); }
				if(!isset($data['documents'])) { $data['documents'] = json_encode($this->column['documents']); }

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

		if(count($data['name']) >= 6) {
			
			\Library\Factory::setMsg("Select 5 or less images per upload!","wrong");
			$uploadedImages[] = array(
				"status" => 2,
				"message" => getMsg()
			);

			return json_encode($uploadedImages);
		}
		
		$files = array();
		foreach ($data as $k => $l) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files))
					$files[$i] = array();
					$files[$i][$k] = $v;
			}
		}
		
		foreach ($files as $file) {

			$handle = new Upload($file); 

			if ($handle->uploaded) {
			
				$handle->mime_check = true;
				$handle->file_safe_name = true;

				$handle->file_max_size = '2048000';
				$handle->allowed = array("image/jpg", "image/jpeg", "image/png", "image/webp");
				$handle->forbidden = array('application/*', 'text/javascript', 'application/x-javascript');
				
				if($handle->image_src_x > 1024) {
					$handle->image_resize = true;
					$handle->image_x = 1024;
					$handle->image_ratio_y = true;
				}
				
				$handle->Process(ROOT."/Cdn/images/temporary/"); 
				
				if ($handle->processed) {

					$path = ROOT.DS."Cdn".DS."images".DS."temporary".DS;
					$name = explode(".",$handle->file_dst_name);
					$ext = array_pop($name);
					
					$new_name = md5($handle->file_dst_name.time()).".".$ext;
					rename($path.$handle->file_dst_name, $path.$new_name);
				
					$uploadedImages[] = array(
						"status" => 1,
						"id" => rand(1000,10000).time(),
						"filename" => $new_name,
						"url" => CDN."images/listings/".$new_name,
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
				$html[] = "<option value='".mb_convert_encoding($subCategory, "UTF-8")."' $sel>".mb_convert_encoding($subCategory, "UTF-8")."</option>";
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

	function uploadDocuments($data) {

		if(count($data['name']) >= 6) {
			
			\Library\Factory::setMsg("Select 5 or less pdf files per upload!","wrong");
			$uploadedDocuments[] = array(
				"status" => 2,
				"message" => getMsg()
			);

			return json_encode($uploadedDocuments);
		}
		
		$files = array();
		foreach ($data as $k => $l) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files))
					$files[$i] = array();
					$files[$i][$k] = $v;
			}
		}
		
		foreach ($files as $file) {

			$handle = new Upload($file); 

			if ($handle->uploaded) {
			
				$handle->mime_check = true;
				$handle->file_safe_name = true;

				$handle->file_max_size = '3600000';
				$handle->allowed = array('application/pdf');
				
				$handle->Process(ROOT."/Cdn/public/temporary/"); 
				
				if ($handle->processed) {

					$uploadedDocuments[] = array(
						"status" => 1,
						"id" => rand(1000,10000).time(),
						"filename" => $handle->file_dst_name,
						"url" => CDN."public/temporary/".$handle->file_dst_name
					);
				
				}else {

					\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only PDF are allowed and less than 3MB file sizes are allowed, Please check your file size before uploading.","wrong");
					
					$uploadedDocuments[] = array(
						"status" => 2,
						"message" => getMsg()
					);
					
				}
			}else {
				\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only PDF are allowed and less than 3MB file sizes are allowed, Please check your file size before uploading.","info");
				$uploadedDocuments[] = array(
					"status" => 2,
					"message" => getMsg()
				);
			}

			unset($handle);
		}
		
		return json_encode($uploadedDocuments);
		
	}

	function moveUploadedDocuments($filename, $container_id) {

        $old_dir = ROOT."/Cdn/public/temporary/".$filename;

		if(file_exists($old_dir)) {

			$path = "public/listings/documents/$container_id";
			$new_dir = ROOT."/Cdn/$path";

			if(!is_dir($new_dir)) {
				mkdir($new_dir, 0775, true);
			}

			rename($old_dir,$new_dir."/".$filename);

			return CDN."$path/".$filename;
		}

	}

}
