<?php

namespace Main\Model;

use PHPMailer\PHPMailer as Mailer;

class MailModel extends \Main\Model {

	function sendMail($from,$to=null,$subject,$message,$cc=null,$bcc=null,$attachments = null) {
		
		$mail = new Mailer();
		
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