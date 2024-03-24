<?php

namespace Website\Application\Controller;

use Library\Helper;

class ArticlesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$this->doc->setTitle("MLS");
		$this->doc->setDescription("MLS");
		$this->doc->setMetaData("Keywords", "MLS");

		$this->doc->setFacebookMetaData("og:url", WEBDOMAIN.url("ArticlesController@index"));
		$this->doc->setFacebookMetaData("og:title", "Articles");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$articles = $this->getModel("Article");
		
		$articles->page['limit'] = 20;
		$articles->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$articles->page['target'] = url("ArticlesController@index");
		$articles->page['uri'] = (isset($uri) ? $uri : []);

		$filters[] = " publish = 1 ";

		if(isset($_REQUEST['category']) && $_REQUEST['category'] != "") {
			$filters[] = " (category LIKE '%".$_REQUEST['category']."%')";
			$uri['category'] = $_REQUEST['category'];
		}

		$articles->where((isset($filters) ? implode(" AND ",$filters) : null))->orderBy(" created_at DESC ");
		$data['articles'] = $articles->getList();

		$this->setTemplate("articles/index.php");
		return $this->getTemplate($data, $articles);
	}

	function view($name) {

		$articles = $this->getModel("Article");
		$articles->column['name'] = $name;
		$data = $articles->getByName();

		$description = nicetrim(strip_tags($data['content']), 200);

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$data['url'] = rtrim(WEBDOMAIN, '/') . url("ArticlesController@view", ["name" => $name]);

		$this->doc->setFacebookMetaData("og:url", $data['url']);
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['banner']);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['share_buttons'] = Helper::socialMediadShareButtons([
			"url" => $data['url'],
			"title" => $data['title'],
			"description" => $description,
			"img" => $data['banner'],
		]);
		
		$this->setTemplate("articles/view.php");
		return $this->getTemplate($data, $articles);
	}

}