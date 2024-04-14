<?php

namespace Library;

use Library\Mailer;
use Admin\Application\Controller\AccountsController;

class CronJob extends \Main\Controller {

	function __construct() {}

	function run() {
		
		$this->expiredPosting();
		$this->expiredSubscription();
		$this->expiredKYC();
		$this->expiredHandshake();
		$this->expiredAutorityToSell();

		$this->expiringPosting();
		$this->expiringSubscription();

	}

	function expiredPosting(): void {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 9999999999;
		$listings
			->select(" listing_id, l.account_id, title, a.email, duration ")
				->join(" l JOIN #__accounts a ON a.account_id = l.account_id ")
					->where(" duration <= '".DATE_NOW."' ")
						->and(" l.status = 1 ");

		$data = $listings->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$ids[] = $data[$i]['listing_id'];
				$result[$data[$i]['email']][] = [
					"title" => $data[$i]['title'],
					"end_at" => date("d M Y", $data[$i]['duration'])
				];
			}

			$listings->DBO->query(" UPDATE #__listings SET status = 0 WHERE listing_id IN(".implode(",", $ids).") ");

			if($result) {

				$mail = new Mailer();

				foreach($result as $email => $list) {

					$html[] = "<h1>Expired Posting</h1>";
					$html[] = "<p>Your posting has expired. Please log in to your account and update the settings accordingly.</p>";
					$html[] = "<table style='margin-top:10px;'>";
						for($i=0; $i<count($list); $i++) {
							$html[] = "<tr>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['title']."</td>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['end_at']."</td>";
							$html[] = "</tr>";
						}
					$html[] = "</table>";

					$mail
						->build(implode(",", $html))
							->send([
								"to" => $email
							], "Posting Expired - " . CONFIG['site_name']);

					unset($html);

				}
						
			}

		}

	}

	function expiringPosting(): void {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 9999999999;
		$listings
			->select(" listing_id, l.account_id, title, duration ")
				->join(" l JOIN #__accounts a ON a.account_id = l.account_id ")
					->where(" DATE_SUB(DATE_FORMAT(FROM_UNIXTIME(duration), '%Y-%m-%d'), INTERVAL 7 DAY) = CURDATE() ")
						->and(" l.status = 1 ");

		$data = $listings->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$result[$data[$i]['email']][] = [
					"title" => $data[$i]['title'],
					"end_at" => date("d M Y", $data[$i]['duration'])
				];
			}

			if($result) {

				$mail = new Mailer();

				foreach($result as $email => $list) {

					$html[] = "<h1>Approaching Expiration</h1>";
					$html[] = "<p>Your posting has approaching an expiration. Please log in to your account and update the settings accordingly.</p>";
					$html[] = "<table style='margin-top:10px;'>";
						for($i=0; $i<count($list); $i++) {
							$html[] = "<tr>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['title']."</td>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['end_at']."</td>";
							$html[] = "</tr>";
						}
					$html[] = "</table>";

					$mail
						->build(implode(",", $html))
							->send([
								"to" => $email
							], "Approaching expiration - " . CONFIG['site_name']);
					
					unset($html);

				}
						
			}

		}

	}

	function expiredSubscription() {

		$subscription = $this->getModel("AccountSubscription");
		$subscription->page['limit'] = 9999999999;

		$subscription
			->select(" account_subscription_id, s.account_id, email, name, details, subscription_end_date ")
				->join(" s JOIN #__accounts a ON a.account_id = s.account_id JOIN #__premiums p ON p.premium_id = s.premium_id ")	
					->where(" subscription_end_date <= '".DATE_NOW."' ");

		$data = $subscription->getList();

		if($data) {

			$account = new AccountsController();

			for($i=0; $i<count($data); $i++) {
				$ids[] = $data[$i]['account_subscription_id'];
				$result[$data[$i]['email']][] = [
					"name" => $data[$i]['name'],
                    "details" => $data[$i]['details'],
                    "end_at" => date("d M Y", $data[$i]['subscription_end_date'])
				];

				$account->limitWithExpiredPrivileges($data[$i]['account_id']);
			}
			
			$subscription->DBO->query(" UPDATE #__account_subscriptions SET subscription_status = 2 WHERE account_subscription_id IN(".implode(",", $ids).") ");

			if($result) {

				$mail = new Mailer();

				foreach($result as $email => $list) {

					$html[] = "<h1>Expired Subscription</h1>";
					$html[] = "<p>Your subscription to our service has ended due to expiration. To continue accessing our features and benefits, we kindly ask you to renew your subscription by subscribing again..</p>";
					$html[] = "<table style='margin-top:10px;'>";
						for($i=0; $i<count($list); $i++) {
							$html[] = "<tr>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['name']." - ".$list[$i]['details']."</td>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['end_at']."</td>";
							$html[] = "</tr>";
						}
					$html[] = "</table>";

					$mail
						->build(implode(",", $html))
							->send([
								"to" => $email
							], "Expired Subscription - " . CONFIG['site_name']);
					
					unset($html);

				}
						
			}

		}

	}

	function expiringSubscription() {

		$subscription = $this->getModel("AccountSubscription");
		$subscription->page['limit'] = 9999999999;

		$subscription
			->select(" account_subscription_id, s.account_id, email, name, details, subscription_end_date ")
				->join(" s JOIN #__accounts a ON a.account_id = s.account_id JOIN #__premiums p ON p.premium_id = s.premium_id ")	
					->where(" DATE_SUB(DATE_FORMAT(FROM_UNIXTIME(subscription_end_date), '%Y-%m-%d'), INTERVAL 7 DAY) = CURDATE() ");

		$data = $subscription->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$ids[] = $data[$i]['account_subscription_id'];
				$result[$data[$i]['email']][] = [
					"name" => $data[$i]['name'],
                    "details" => $data[$i]['details'],
                    "end_at" => date("d M Y", $data[$i]['subscription_end_date'])
				];
			}
			
			if($result) {

				$mail = new Mailer();

				foreach($result as $email => $list) {

					$html[] = "<h1>Expired Subscription</h1>";
					$html[] = "<p>This email serves as a reminder that your subscription to our service is nearing its expiration date.</p>";
					$html[] = "<table style='margin-top:10px;'>";
						for($i=0; $i<count($list); $i++) {
							$html[] = "<tr>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['name']." - ".$list[$i]['details']."</td>";
								$html[] = "<td style='border: 1px solid #e1e1e1; padding:5px;'>".$list[$i]['end_at']."</td>";
							$html[] = "</tr>";
						}
					$html[] = "</table>";

					$mail
						->build(implode(",", $html))
							->send([
								"to" => $email
							], "Expired Subscription - " . CONFIG['site_name']);
					
					unset($html);

				}
						
			}

		}

	}

	function expiredKYC() {

		$kyc = $this->getModel("KYC");
		$kyc->page['limit'] = 9999999999;
		$kyc
			->select(" kyc_id, id_expiration_date ")
				->where(" id_expiration_date <= '".date("Y-m-d", DATE_NOW)."' ")
					->and(" kyc_status = 1 ");
		
		$data = $kyc->getList();

		if($data) {

			for($i=0; $i<count($data); $i++) {
				$ids[] = $data[$i]['kyc_id'];
			}

			$kyc->DBO->query(" UPDATE #__kyc SET kyc_status = 3 WHERE kyc_id IN(".implode(",", $ids).") ");

		}

	}

	function expiredHandshake() {

		/**
		 * Handshake will automatically expire after 30 days
		 */

		$expiration = DATE_NOW;

		$handshake = $this->getModel("Handshake");
		$handshake->DBO->query(" UPDATE #__handshakes SET handshake_status = 'cancelled' WHERE (handshake_status = 'accepted' AND DATE_ADD(handshake_status_at, INTERVAL 30 DAY) <= '".$expiration."') OR (handshake_status = 'pending' AND DATE_ADD(requested_at, INTERVAL 30 DAY) <= '".$expiration."') ");
	
	}

	function expiredAutorityToSell() {

		$expiration = DATE_NOW;
		$listing = $this->getModel("Listing");
		$listing->DBO->query("UPDATE #__listings SET status = '0', display = 2 WHERE JSON_EXTRACT(other_details, '$.authority_to_sell_expiration') <= '".$expiration."' ");

	}


}