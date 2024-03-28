<?php

namespace Library;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

	private $mailer;
	private $sender = EMAIL_ADDRESS_RESPONDER;
	private $message;

	function __construct() {
		$this->mailer = new PHPMailer(true);
	}

	function setMailSender($email) {
		$this->sender = $email;
		return $this;
	}

	function getMailSender() {
		return $this->sender;
	}

	/**
	 * @param array $to ["to" => [emails], "cc" => [emails], "bcc" => [emails] ]
	 * @param string $subject
	 * @param array $headers
	 */

	function send(array $to, string $subject, array $attachments = null) {
		
		try {

			//Set who the message is to be sent from
			$this->mailer->setFrom($this->sender, 'Mailer');
			$this->mailer->isHTML(true);

			foreach($to['to'] as $to) {
				//Set who the message is to be sent to
				$this->mailer->addAddress($to);
			}

			if(isset($to['cc'])) {
				foreach($to['cc'] as $cc) {
					$this->mailer->addCC($cc);
				}
			}

			if(isset($to['bcc'])) {
				foreach($to['bcc'] as $bcc) {
					$this->mailer->addBCC($bcc);
				}
			}

			if(!is_null($attachments)) {
				foreach($attachments as $file) {
					$this->mailer->addAttachment($file);
				}
			}
			
			$this->mailer->Subject = $subject;
			$this->mailer->Body    = $this->message;
			$this->mailer->AltBody = strip_tags($this->message);

			$this->mailer->send();

			return [
				"status" => 1,
				"message" => "Message has been sent"
			];

		} catch(Exception $e) {

			return [
				"status" => 2,
				"message" => "Message could not be sent. Mailer Error: {$e->getMessage()}"
			];

		}
	}

	function build($message) {

		$html[] = "<div style='font-family:calibri; line-height:1.5; max-width: 767px; margin:0 auto;color:#323232; font-size:14px; background-color:#F2F1EF;'>";

			/** HEADER */
			$html[] = "<div style='text-align:center;padding:20px;border-bottom:1px solid #ECECEC;background-color:#F2F1EF;'>";
				$html[] = "<img src='".CDN."images/logo.png' alt='Logo' style='width:250px;' />";
			$html[] = "</div>";

			/** BODY */
			$html[] = "<div style='padding:20px;width:90%;margin:0 auto; background-color:#FFF;'>";
				$html[] = $message;
			$html[] = "</div>";

			/** FOOTER */
			$html[] = "<div style='background-color:#F2F1EF;font-size:13px;text-align:center;padding:10px 20px;color:#6C7A89;border-top:1px solid #ECECEC;'>";
				$html[] = "<br/><p>You received this email, because you are registered in <a href='".WEBDOMAIN."'>".WEBDOMAIN."</a>.</p>";
				$html[] = "<p>This email message is automated, please do not reply, thus no one will received your message. </p><br/>";
			$html[] = "</div>";

		$html[] = "</div>";

		$this->message = implode("", $html);
		return $this;
	}

	function getMessage() {
		return $this->message;
	}

}