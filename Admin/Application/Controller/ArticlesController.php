<?php

namespace Admin\Application\Controller;

class ArticlesController extends \Main\Controller {
	
	public $doc;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");

		if(!$this->session['permissions']['articles']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permision to access articles","warning");
			response()->redirect(url("DashboardController@index"));
		}
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
		
		$data = $article->getList();

		$this->setTemplate("articles/articles.php");
		return $this->getTemplate($data,$article);
		
	}

	function add() {
		
		$this->doc->setTitle("New Article");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScript(CDN."js/photo-uploader.js");

		$article = $this->getModel("Article");
		$this->setTemplate("articles/add.php");
		return $this->getTemplate(null, $article);
		
		$this->response(404);
		
	}
	
	function edit($id) {

		if(!$this->session['permissions']['articles']['edit']) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permision to edit articles","warning");
			response()->redirect(url("DashboardController@index"));
		}
		
		$this->doc->setTitle("Update Article");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScript(CDN."js/photo-uploader.js");

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

		$article = $this->getModel("Article");

		$_POST['name'] = sanitize($_POST['title']);
		$_POST['created_by'] = $this->session['name'];
		$_POST['created_at'] = DATE_NOW;

		if(isset($_POST['banner']) && $_POST['banner'] != "") {
			$_POST['banner'] = $article->moveUploadedImage($_POST['banner']);
		}

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
			$file = ROOT."/Cdn/images/articles/".$current_banner;
			
			if(file_exists($file)) {
				@unlink($file);
			}
			
			$_POST['banner'] = $article->moveUploadedImage($_POST['banner']);
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
				unlink(ROOT."/Cdn/images/articles/".basename($data['banner']));

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