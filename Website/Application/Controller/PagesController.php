<?php

namespace Website\Application\Controller;

class PagesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function about() {

		$data['title'] = "About ".CONFIG['site_name'];
		$data['description]'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description]']);
		$this->doc->setMetaData("keywords", $data['description]']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $data['description]']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['about'] = CONFIG['about'];
		$this->setTemplate("pages/about.php");
		return $this->getTemplate($data);
	}

	function contact() {

		$data['title'] = "Contact ".CONFIG['site_name'];
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->saveTraffic([
			"name" => "Contact",
			"url" => rtrim(WEBDOMAIN, '/') . url("PagesController@contact")
		]);

		$data['contact_info'] = CONFIG['contact_info'];
		$this->setTemplate("pages/contact.php");
		return $this->getTemplate($data);
	}

	function articles() {

		$data['title'] = "Articles - " . CONFIG['site_name'];
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->saveTraffic([
			"name" => "Articles",
			"url" => rtrim(WEBDOMAIN, '/') . url("PagesController@articles")
		]);

		$this->setTemplate("pages/articles.php");
		return $this->getTemplate();
	}

	function privacy() {

		$data['title'] = "Data Privacy - " . CONFIG['site_name'];
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->saveTraffic([
			"name" => "Data Privacy",
			"url" => rtrim(WEBDOMAIN, '/') . url("PagesController@privacy")
		]);

		$data['data_privacy'] = CONFIG['data_privacy'];
		$this->setTemplate("pages/privacy.php");
		return $this->getTemplate($data);
	}

	function terms() {

		$data['title'] = "Terms and Conditions - " . CONFIG['site_name'];
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);
		
		$data['terms'] = CONFIG['terms'];

		$this->saveTraffic([
			"name" => "Terms and Conditions",
			"url" => rtrim(WEBDOMAIN, '/') . url("PagesController@terms")
		]);

		$this->setTemplate("pages/terms.php");
		return $this->getTemplate($data);
	}

	private function saveTraffic($data) {

		$traffic = $this->getModel("Traffic");
		$traffic->select(" session_id, JSON_EXTRACT(traffic, '$.name') as name ");
		$traffic->column['session_id'] = $this->getLibrary("SessionHandler")->get("id");
		
		$response = $traffic->getBySessionId();

		if($response) {
			for($i=0; $i<count($response); $i++) {
				$arr[$response[$i]['session_id']][] = $response[$i]['name'];
			}
		}

		if(!isset($arr[ $traffic->column['session_id'] ]) || !in_array($data['name'], $arr[ $traffic->column['session_id'] ]) || !$response) {
			$traffic->select("");
			$traffic->saveNew(array(
				"traffic" => json_encode([
					"type" => "page",
					"name" => $data['name'],
					"id" => 0,
					"url" => $data['url'],
					"source" => "Website"
				]),
				"account_id" => 0,
				"session_id" => $this->getLibrary("SessionHandler")->get("id"),
				"created_at" => DATE_NOW,
				"user_agent" => json_encode($this->getLibrary("SessionHandler")->get("user_agent"))
			));
		}

	}

}