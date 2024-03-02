<?php

namespace Admin\Application\Controller;

class KYCController extends \Main\Controller {

	private $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = SessionController::getInstance()->session->get("user_logged");
	}

	function index() {

		if(!$this->session['permissions']['kyc']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Accounts");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (firstname LIKE '%".$_REQUEST['search']."%' OR lastname LIKE '%".$_REQUEST['search']."%' OR email LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$filters[] = " kyc_verified = 0 ";
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$accounts = $this->getModel("Account");
		$accounts
		->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" registration_date DESC ");

		$accounts->page['limit'] = 20;
		$accounts->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$accounts->page['target'] = url("AccountsController@kycVerificationProcessIndex");
		$accounts->page['uri'] = (isset($uri) ? $uri : []);

		$data = $accounts->getList();

		$this->setTemplate("accounts/accountList.php");
		return $this->getTemplate($data,$accounts);

	}
	
	function kycVerificationForm($account_id) {

		$this->doc->setTitle("KYC Verification");
		$this->doc->addScript(CDN."js/kyc.js");

		$account = $this->getModel("Account");
		$account->column['account_id'] = $account_id;
		$data = $account->getById();

		if(isset($_REQUEST['step']) && $_REQUEST['step'] == 2) {
			$this->setTemplate("accounts/kyc/identity.php");
		}else if(isset($_REQUEST['step']) && $_REQUEST['step'] == 3) {
			$this->setTemplate("accounts/kyc/final.php");
		}else {
			$this->setTemplate("accounts/kyc/step1.php");
		}

		return $this->getTemplate($data);

	}

	function kycDocsUpload($id) {
		$accounts = $this->getModel("Account");
		return $accounts->uploadPhoto($_FILES['ImageBrowse'], "/public/kyc/$id");
	}

}