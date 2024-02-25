<?php

namespace Admin\Application\Controller;

class ArticlesController extends \Main\Controller {
	
	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$this->doc->setTitle("Articles");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%'))";
			$uri['search'] = $_REQUEST['search'];
		}

		$filters[] = "";

		$article = $this->getModel("Article");
		$article->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");
		
		$article->page['limit'] = 20;
		$article->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$article->page['target'] = url("ArticlesController@index");
		$article->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['articles'] = $article->getList();

		if($data['articles']) {

		}

		$this->setTemplate("articles/articles.php");
		return $this->getTemplate($data,$article);
		
	}

	function add($id) {
		
		$this->doc->setTitle("Update Article");
		$doc->addScript(CDN."js/photo-uploader.js");

		$this->setTemplate("articles/add.php");
		return $this->getTemplate($data);
		
		$this->response(404);
		
	}
	
	function edit($id) {
		
		$this->doc->setTitle("Update Article");
		$doc->addScript(CDN."js/photo-uploader.js");

		$article = $this->getModel("Article");
		$article->column['article_id'] = $id;
		$data = $article->getById();

		if($data) {

			$this->setTemplate("articles/edit.php");
			return $this->getTemplate($data,$article);
		}

		$this->response(404);
		
	}

	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['name'] = sanitize($_POST['title']);

		if(isset($_POST['banner'])) {
			$_POST['banner'] = $user->moveUploadedImage($_POST['banner']);
		}

		$article = $this->getModel("Article");
		$response = $article->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['name'] = sanitize($_POST['title']);

		$article = $this->getModel("Article");
		$article->column['article_id'] = $id;
		$data = $article->getById();

		if($_POST['banner'] != $data['banner']) {
			/* remove old banner */

			$banner_url = explode("/", $data['banner']);
			$current_banner = array_pop($banner_url);
			$file = ROOT."Cdn/images/articles/".$current_banner;
			
			if(file_exists($file)) {
				@unlink($file);
			}
			
			$_POST['banner'] = $user->moveUploadedImage($_POST['banner']);
		}

		$response = $article->save($id,$_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function delete($id) {

		$article = $this->getModel("Article");
		$article->column['article_id'] = $id;
		$data = $article->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$article->deleteArticle($id);

				$this->getLibrary("Factory")->setMsg("Article permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Article not found.","warning");
		}

		$this->setTemplate("articles/delete.php");
		return $this->getTemplate($data);

	}

	function uploadPhoto() {
		$article = $this->getModel("Article");
		return $article->uploadPhoto($_FILES['ImageBrowse']);
	}
	
}