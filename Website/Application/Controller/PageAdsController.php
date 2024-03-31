<?php

namespace Website\Application\Controller;

class PageAdsController extends \Admin\Application\Controller\PageAdsController {

	public $server = [
		"time" => DATE_NOW
	];

	function showAds($placement) {

		header('Content-Type: application/json; charset=utf-8');

		$this->setTempalteBasePath(ROOT."Admin");

		$pageAds = $this->getModel("PageAds");
		$pageAds->page['limit'] = 999;
		$data = $pageAds->getByPlacement($placement);

		if($data) {

			$time_duration_per_hour = 60 / $pageAds->rows;
			$hours_in_minutes = 24 * 60;
			$slots = $hours_in_minutes / $time_duration_per_hour;

			$result_iterator = 0;
			$counter = 0;
			for($i=0; $i<$slots; $i++) {
				
				$time = strtotime(date("d M Y H:i", strtotime("+$counter minutes", strtotime(date("Y-m-d", DATE_NOW)))));
				$counter += $time_duration_per_hour;

				$items[] = [
					"time" => $time,
					/* "start" => date("d M Y H:i",$time), */
					"data" => $data[$result_iterator]
				];

				$result_iterator++;

				if($result_iterator >= $pageAds->rows) {
					$result_iterator = 0;
				}

			}

			for($i=0; $i<count($items); $i++) {
				if($items[$i]['time'] < DATE_NOW) {
					$current = $items[$i];
				}
			}

			echo json_encode([
				"status" => 1,
				"current" => $current/* ,
				"collections" => $items */
			]);

			exit();

		}

		echo json_encode([
			"status" => 2
		]);

		exit();

	}

}