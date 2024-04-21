<?php

namespace Website\Application\Controller;

use Library\Helper;

class ArticlesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$data['title'] = "Articles - " . CONFIG['site_name'];
		$data['description'] = $data['title'];
		$data['image'] = null;
		
		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("Keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", WEBDOMAIN.url("ArticlesController@index"));
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$articles = $this->getModel("Article");
		
		$filters[] = " publish = 1 ";

		if(isset($_GET['category']) && $_GET['category'] != "") {
			$filters[] = " (category LIKE '%".$_GET['category']."%')";
			$uri['category'] = ucwords($_GET['category']);
		}

		$articles->page['limit'] = 20;
		$articles->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;
		$articles->page['target'] = url("ArticlesController@index");
		$articles->page['uri'] = (isset($uri) ? $uri : []);

		$articles->where((isset($filters) ? implode(" AND ",$filters) : null))->orderBy(" created_at DESC ");
		$data['articles'] = $articles->getList();

		$data['categories'] = $this->totalArticlesPerCategory();

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Articles',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					}
				});
			});
		"));

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

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'article',
					'name': '".$data['title']."',
					'id': ".$data['article_id'].",
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					}
				});
			});
		"));
		
		$this->setTemplate("articles/view.php");
		return $this->getTemplate($data, $articles);
	}

	private function totalArticlesPerCategory() {

		$articles = $this->getModel("Article");
		
		$articles->page['limit'] = 9999999;
		$filters[] = " publish = 1 ";

		$articles
			->select(" COUNT(category) as total_category, category ")
				->groupBy(" category ")
					->orderBy(" created_at DESC ");
		$data = $articles->getList();

		return $data;
		
	}

}