<?php

namespace Admin\Application\Controller;

use Library\Mailer;

class DebugController extends \Main\Controller {
	
	function __construct() {

	}
	
	function debug() {

		debug($_SESSION);

		$mail = new Mailer();

		$transaction = new \Admin\Application\Controller\TransactionsController();
		$message = $transaction->mailInvoice(1, 8);
		$mail->build($message);

		echo $mail->getMessage();
		exit();
		

		$subject = "";
		$message = "";

		$mail = new Mailer();
		$response = $mail
			->build($message)
				->send([
					"to" => [
						"eman.olivas@gmail.com"
					]
				], $subject);

		echo $response['message'];
		
		exit();

	}
	
}