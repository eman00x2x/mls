<?php

namespace Admin\Application\Controller;

class PageAdsController extends \Main\Controller {

    public $doc;
    public $session;

    function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
        $this->doc = $this->getLibrary("Factory")->getDocument();
        $this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

    function index() {

		if(!isset($this->session['permissions']['page_ads']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

        $this->doc->setTitle("Page Ads");

		$filters[] = "";

		$pageAds = $this->getModel("PageAds");
		$pageAds->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");
		
		$pageAds->page['limit'] = 20;
		$pageAds->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$pageAds->page['target'] = url("PageAdsController@index");
		$pageAds->page['uri'] = (isset($uri) ? $uri : []);
		
		$data = $pageAds->getList();

		$this->setTemplate("ads/index.php");
		return $this->getTemplate($data,$pageAds);

    }

    function add() {

		if(!isset($this->session['permissions']['page_ads']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

        $this->doc->setTitle("New Page Ads");
        $this->doc->addScript(CDN."js/photo-uploader.js");
        $this->doc->addScriptDeclaration("
            $(document).on('change', '#placement', function() {

                selected = $('#placement option:selected');

                let width = selected.data('width');
                let height = selected.data('height');

                $('.size-guide').val(\"Image width should be \" + width +\"px and height should be \" + height + \"px \");

                $('#form .avatar').css('width', width);
                $('#form .avatar').css('height', height);
                
            });
        ");

        $pageAds = $this->getModel("PageAds");

        $this->setTemplate("ads/add.php");
		return $this->getTemplate(null, $pageAds);

    }

    function edit($id) {

		if(!isset($this->session['permissions']['page_ads']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

        $pageAds = $this->getModel("PageAds");
        $pageAds->column['page_ads_id'] = $id;
        $data = $pageAds->getById();

        $this->doc->setTitle("Update Page Ads Settings");

        if($data) {

            $this->doc->addScript(CDN."js/photo-uploader.js");
            $this->doc->addScriptDeclaration("

                $(document).ready(function() {

                    $('#form .avatar').css('width', ".$pageAds->placements[ $data['placement'] ]['size']['width'].");
                    $('#form .avatar').css('height', ".$pageAds->placements[ $data['placement'] ]['size']['height'].");

                    $('.size-guide').val(\"Image width should be ".$pageAds->placements[ $data['placement'] ]['size']['width']."px and height should be ".$pageAds->placements[ $data['placement'] ]['size']['height']."px \");

                });

                $(document).on('change', '#placement', function() {

                    selected = $('#placement option:selected');

                    let width = selected.data('width');
                    let height = selected.data('height');

                    $('.size-guide').val(\"Image width should be \" + width +\"px and height should be \" + height + \"px \");

                    $('#form .avatar').css('width', width);
                    $('#form .avatar').css('height', height);
                    
                });
            ");

            $this->setTemplate("ads/edit.php");
            return $this->getTemplate($data, $pageAds);
        }

        $this->response(404);

    }

    function uploadPhoto() {
		$pageAds = $this->getModel("PageAds");
		return $pageAds->uploadPhoto($_FILES['ImageBrowse']);
	}

    function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$pageAds = $this->getModel("PageAds");

		$_POST['started_at'] = strtotime($_POST['started_at']);
		$_POST['ended_at'] = strtotime($_POST['ended_at']);
		$_POST['created_at'] = DATE_NOW;

		if(isset($_POST['banner']) && $_POST['banner'] != "") {
			$_POST['banner'] = $pageAds->moveUploadedImage($_POST['banner']);
		}

		$response = $pageAds->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

        $_POST['started_at'] = strtotime($_POST['started_at']);
		/* $_POST['ended_at'] = strtotime("+23 hours +59 minutes +59 seconds", strtotime($_POST['ended_at'])); */
		$_POST['ended_at'] = strtotime($_POST['ended_at']);

		$pageAds = $this->getModel("PageAds");
		$pageAds->column['page_ads_id'] = $id;
		$data = $pageAds->getById();

		if($_POST['banner'] != $data['banner']) {
			/* remove old banner */

			$banner_url = explode("/", $data['banner']);
			$current_banner = array_pop($banner_url);
			$file = ROOT."Cdn/public/page_ads/".$current_banner;
			
			if(file_exists($file)) {
				@unlink($file);
			}
			
			$_POST['banner'] = $pageAds->moveUploadedImage($_POST['banner']);
		}

		$response = $pageAds->save($id,$_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function delete($id) {

		$pageAds = $this->getModel("PageAds");
		$pageAds->column['page_ads_id'] = $id;
		$data = $pageAds->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$pageAds->deletePageAds($id);
                unlink(ROOT."Cdn/public/page_ads/".basename($data['banner']));

				$this->getLibrary("Factory")->setMsg("Page Ads permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Page Ads not found.","warning");
		}

		$this->setTemplate("ads/delete.php");
		return $this->getTemplate($data);

	}


}