<?php

namespace Website\Application\Controller;

class PageAdsController extends \Admin\Application\Controller\PageAdsController {

	public $server = [
		"time" => DATE_NOW
	];

	function showAds($placement) {

		$this->setTempalteBasePath(ROOT."Admin");

		$pageAds = $this->getModel("PageAds");
		$pageAds->page['limit'] = 999;
		$data = $pageAds->getByPlacement($placement);

		if($data) {

			$mins_impression = 60 / $pageAds->rows;
			
			$key = 0;
			for($i=0; $i<$pageAds->rows; $i++) { $key += $mins_impression;
				$ads[$key] = $data[$i];
			}

			

			echo json_encode([
				"status" => 1,
				"settings" => [
					"time" => $this->server['time']
				],
				"data" => $ads
			]);

			exit();

		}

		echo json_encode([
			"status" => 2,
			"data" => $ads
		]);

			exit();

	}

}