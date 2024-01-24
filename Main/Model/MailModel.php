<?php

namespace Application\Model;

class MailModel extends \Application\Model\Table\Mail {

	function data($id) {
		
		$this->mail_id = $id;
		
		if($data = $this->getById()) {
			
			foreach($data as $key => $val) {
				json_decode($val);
				if(json_last_error() == JSON_ERROR_NONE) {
					$formatedData[$key] = json_decode($val);
				}else {
					$formatedData[$key] = $val;
				}
			}
			
			return $formatedData;
		}else {
			$response['description'] = "The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications.";
			$response['error'] = "Not found!";
			//\Library\RestApi::HTTPDocument(400,$response);
			\Library\Factory::setMsg($response['error'],"wrong");
			return false;
		}
		
	}
	
	function getList() {
		
		$data = $this->getAll();
		
		if($data) {
			foreach($data as $key => $value) {
				$formatedData[$key] = $value;
			}
			
			return $formatedData;
		}else {
			return false;
		}
		
	}

	function send($from,$to=null,$subject,$message,$cc=null,$bcc=null,$attachments = null) {
		
		$mail = new \vendor\PHPMailer\phpmailer\src\PHPMailer;
		
		if(!is_null($to)) {
			if(is_array($to)) {
				for($i=0; $i<count($to); $i++) {
					$mail->addAddress($to[$i]);
				}
			}else {
				$mail->addAddress($to);
			}
		}else {
			\library\Factory::setMsg("Message sending failed. Please add recipient to \"To:\".","wrong");
			return false;
		}
		
		if(!is_null($cc)) {
			if(is_array($cc)) {
				for($i=0; $i<count($cc); $i++) {
					$mail->addCC($cc[$i]);
				}
			}else {
				$mail->addCC($cc);
			}
		}
		
		if(!is_null($bcc)) {
			if(is_array($bcc)) {
				for($i=0; $i<count($bcc); $i++) {
					$mail->addBCC($bcc[$i]);
				}
			}else {
				$mail->addBCC($bcc);
			}
		}
		
		$mail->setFrom($from);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mail->Body = $message;
		
		if(!is_null($attachments)) {
			/* attachments */
			if(is_array($attachments)) {
				for($i=0; $i<count($attachments); $i++) {
					$mail->addAttachment("email/temporary/".$attachments[$i]);
				}
			}else {
				throw new LogicException("Param attachments must be an array. ".gettype($attachments)." is given in \Application\Model\MailModel ->send()");
				exit();
			}
			
		}
		
		if(!$mail->send()) {
			\library\Factory::setMsg("Message sending failed. Please try again later.","wrong");
			return false;
		}else {
			\library\Factory::setMsg("Message sent.","correct");
			return true;
		}
		
	}
	
	function save($mail_id,$user_id,$subject,$address,$message,$attachments,$label="DRAFT",$schedule=null) {
		
		if(!is_null($mail_id)) {
			$this->mail_id = $mail_id;
			$this->getById();
		}
		
		$this->user_id = $user_id;
		$this->subject = $subject;
		$this->address = json_encode($address);
		$this->message = addslashes($message);
		$this->attachments = json_encode($attachments);
		$this->datetime = date("Y-m-d H:i:s");
		$this->is_read = 1;
		$this->label = $label;
		
		if(!is_null($schedule)) {
		    $this->schedule_date = $schedule;
		}
		
		if(is_null($mail_id)) {
			$id = $this->insert();
			return $id;
		}else {
			$this->update();
			return $this->mail_id;
		}
		
	}
	
	function attachedFile($data) {
		
		require_once(BASE.DS."vendor".DS."upload".DS."upload.php");
		
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
				
				$handle->Process("email/temporary/"); 
				
				if ($handle->processed) {
				
					$uploadedImages[] = array(
						"status" => 1,
						"id" => rand(1000,10000).time(),
						"filename" => $handle->file_dst_name
					);
				
				}else {
					
					$uploadedImages[] = array(
						"status" => 2,
						"message" => "Error Uploading"
					);
					
				}
			}
			unset($handle);
		}
		
		return json_encode($uploadedImages);
		
	}
	
	function moveUploadedImage($data) {
	
		$images = [];
	
		for($i=0; $i<count($data); $i++) {
			$old_filename = BASE.DS."email".DS."temporary".DS.$data[$i];
			if(file_exists($old_filename)) {
				
				$new_filename = BASE.DS."email".DS."attachment".DS.$data[$i];
				rename($old_filename,$new_filename);
				
				$images[] = array(
					"filename" => $data[$i]
				);
				
			}
		}
		
		return $images;
		
	}
	
	function removeAttachment($filename) {
		$file = "email/temporary/".$filename;
		if(file_exists($file)) {
			@unlink($file);
		}else {
			@unlink("email/attachments/".$filename);
		}
	}
	
	function tracker($id,$public_ip) {
		
		$this->mail_id = $id;
		$data = $this->getById();
		
		if($data) {
			
			if($data['is_opened'] == 0) {
				$api_key = "7668436f6ab4fd63e7cbc9f07c374e7b";
				
				$json  = file_get_contents("http://api.ipstack.com/$public_ip?access_key=$api_key");
				$json  =  json_decode($json ,true);
				
				$this->track_details = json_encode(array(
					"ip" => $public_ip,
					"continent_code" => $json['continent_code'],
					"continent_name" => $json['continent_name'],
					"country_code" => $json['country_code'],
					"country_name" => $json['country_name'],
					"region_code" => $json['region_code'],
					"region_name" => $json['region_name'],
					"city" => $json['city'],
					"zip" => $json['zip'],
					"date" => date("Y-m-d H:i:s",DATE_NOW)
				));
				
				$this->is_opened = 1;
				$this->update();
			}
		}
		
	}
	
}