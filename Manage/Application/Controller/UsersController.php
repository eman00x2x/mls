<?php

namespace Manage\Application\Controller;

class UsersController extends \Admin\Application\Controller\UsersController {
	
	private $account_id;
	
	function __construct() {

        parent::__construct();
        $this->setTempalteBasePath(ROOT."/Manage");
		
		$this->account_id = $this->session['account_id'];

		if(KYC == 1) {
            if($this->session['kyc'] === false) {
				if(CONFIG['kyc_options']['hide_listings_if_kyc_expired'] == 1) {
					$this->getLibrary("Factory")->setMsg("Your property listings have been hidden from the public website and MLS. You must complete the KYC process before your listings can be viewed. <a href='".url("KYCController@kycVerificationForm")."'>Proceed to KYC</a>", "warning");	
				}
            }
        }

	}
	
	function index() {

		if((!isset($this->session['permissions']['users']['access']) && $this->session['permissions']['users']['access'] != 'true')) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to manage the account users","error");
			response()->redirect(url("AccountsController@index"));
		}

        $this->doc->setTitle("Manage Users");
        $this->doc->addScript(CDN."js/photo-uploader.js");

		$account = $this->getModel("Account");
        $account->select(" *, (SELECT COUNT(*) FROM #__users WHERE account_id = ".$this->account_id.") as users");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();

        $user = $this->getModel("User");
		$user->where(" account_id = ". $this->account_id)
		->and(" user_level != 1 ");
		$data['users'] = $user->getList();

		$this->setTemplate("users/users.php");
		return $this->getTemplate($data,$user);

	}

	function changePassword($id = null, $account_id = null) {
		$this->setTempalteBasePath(ROOT."/Admin");
		return parent::changePassword($this->session['user_id'], $this->account_id);
	}

	function new() {

		$user = $this->getModel("User");
		$user->column['account_id'] = $this->account_id;
		$user->select(" COUNT(user_id) as total_users ");
		$data = $user->getByAccountId();

		if($data[0]['total_users'] >= $this->session['privileges']['max_users']) {
			$this->getLibrary("Factory")->setMsg("Maximum users have reached! You cannot create more users","error");
			response()->redirect(url("UsersController@index"));
		}

		if((!isset($this->session['permissions']['users']['access']))) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to create a new user","error");
			response()->redirect(url("UsersController@index"));
		}

		$this->setTempalteBasePath(ROOT."/Admin");
		return parent::add($this->account_id);
	}

	function edit($account_id, $user_id) {

		if($account_id != $this->account_id) {
			$this->response(404);
		}

		if((!isset($this->session['permissions']['users']['access']))) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to create a new user","error");
			response()->redirect(url("UsersController@index"));
		}

		$this->setTempalteBasePath(ROOT."/Admin");
		return parent::edit($this->account_id,$user_id);
	}

	function delete($account_id, $user_id) {
		
		if($account_id != $this->account_id) {
			$this->response(404);
		}

		$this->setTempalteBasePath(ROOT."/Admin");
		return parent::delete($account_id,$user_id);
	}
	
	
}