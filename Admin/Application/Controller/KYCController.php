<?php

namespace Admin\Application\Controller;

use Josantonius\Session\Facades\Session;

class KYCController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = Session::get("user_logged");

		if(!KYC) {
			$this->response(404);
		}
		
	}

	function index() {

		if(!$this->session['permissions']['kyc']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("KYC Verfication");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (firstname LIKE '%".$_REQUEST['search']."%' OR lastname LIKE '%".$_REQUEST['search']."%' OR email LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$filters[] = " kyc_status = 0 ";
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$kyc = $this->getModel("KYC");
		$kyc
		->join(" k JOIN #__accounts a ON k.account_id=a.account_id ")
		->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" created_at DESC ");

		$kyc->page['limit'] = 20;
		$kyc->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$kyc->page['target'] = url("KYCController@kyc");
		$kyc->page['uri'] = (isset($uri) ? $uri : []);

		$data = $kyc->getList();

		$this->setTemplate("kyc/index.php");
		return $this->getTemplate($data,$kyc);

	}

	function verify($id) {

		$this->doc->setTitle("KYC Verfication");
		$this->doc->addScript(CDN."tabler/dist/libs/fslightbox/index.js");

		$kyc = $this->getModel("KYC");
		$kyc->column['kyc_id'] = $id;
		$kyc->join(" k JOIN #__accounts a ON k.account_id=a.account_id ");
		$kyc->and(" kyc_status = 0 "); 
		$data = $kyc->getById();

		$this->setTemplate("kyc/verify.php");
		return $this->getTemplate($data,$kyc);

	}
	
	function kycVerificationForm($account_id) {

		$this->doc->setTitle("KYC Verfication");

		$kyc = $this->getModel("KYC");
		$kyc->where(" account_id = $account_id ");
		$kyc->and(" kyc_status = 0 ");
		$data = $kyc->getList();

		if($data) {
			$this->setTemplate("kyc/pending.php");
		}else {
			$this->doc->setTitle("KYC Verification");
			$this->doc->addScript(CDN."js/kyc.js");

			$account = $this->getModel("Account");
			$account->column['account_id'] = $account_id;
			$data = $account->getById();

			if(isset($_REQUEST['step']) && $_REQUEST['step'] == 2) {
				$this->setTemplate("kyc/identity.php");
			}else if(isset($_REQUEST['step']) && $_REQUEST['step'] == 3) {
				$this->setTemplate("kyc/final.php");
			}else {
				$this->setTemplate("kyc/step1.php");
			}
		}

		return $this->getTemplate($data);

	}

	function kycDocsUpload($id) {
		$accounts = $this->getModel("Account");
		return $accounts->uploadPhoto($_FILES['ImageBrowse'], "/public/kyc/$id");
	}

	function saveNew($account_id) {
		
		parse_str(file_get_contents('php://input'), $_POST);
		
		if(isset($_POST['documents'])) {

			$kyc = $this->getModel("KYC");

			if($_POST['documents']['kyc']['selfie']) {
				$_POST['documents']['kyc']['selfie'] = $kyc->moveUploadedImage($_POST['documents']['kyc']['selfie'], "public/kyc/$account_id");
			}
			
			if($_POST['documents']['kyc']['id']) {
				$_POST['documents']['kyc']['id'] = $kyc->moveUploadedImage($_POST['documents']['kyc']['id'], "public/kyc/$account_id");
			}

		}

		$time = DATE_NOW;

		$_POST['kyc_status'] = 0;
		$_POST['created_at'] = $time;
		$_POST['created_at'] = $time;
		
		$kyc = $this->getModel("KYC");

		$kyc->delete();

		$response = $kyc->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}

	function saveUpdate($kyc_id) {

		parse_str(file_get_contents('php://input'), $_POST);

		if($kyc_id) {

			$kyc = $this->getModel("KYC");
			$kyc->column['kyc_id'] = $kyc_id;
			$data = $kyc->getById();
			
			if(isset($_POST['documents'])) {

				if($_POST['documents']['kyc']['selfie']) {
					$_POST['documents']['kyc']['selfie'] = $kyc->moveUploadedImage($_POST['documents']['kyc']['selfie'], "public/kyc/".$data['account_id']);
				}
				
				if($_POST['documents']['kyc']['id']) {
					$_POST['documents']['kyc']['id'] = $kyc->moveUploadedImage($_POST['documents']['kyc']['id'], "public/kyc/".$data['account_id']);
				}
				
			}

			$_POST['verified_by'] = $this->session['name'];
			$_POST['verified_at'] = DATE_NOW;

			$response = $kyc->save($kyc_id,$_POST);
			
			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(
				array(
					"status" => $response['status'],
					"message" => getMsg()
				)
			);
			
		}else {
			$this->getLibrary("Factory")->setMsg("Account not found!.","error");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}
		
	}

	function delete($kyc_id) {

		$kyc = $this->getModel("KYC");
		$kyc->column['kyc_id'] = $kyc_id;

		$data = $kyc->getById();

		foreach($data['documents']['kyc'] as $key => $route) {
			$data['documents']['kyc'][$key] = str_replace(CDN, ROOT."Cdn", $route);

			if(file_exists($data['documents']['kyc'][$key])) {
				unlink($data['documents']['kyc'][$key]);
			}
		}

		$kyc->deleteKYC($data['kyc_id']);

		return json_encode(
			array(
				"status" => 1,
				"type" => "success",
				"message" => "Successfully Deleted"
			)
		);

	}


}