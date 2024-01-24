<?php

namespace Manage\Application\Controller;

class UsersController extends \Admin\Application\Controller\UsersController {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['account_id'];
	}
	
	function index() {

		if((!isset($_SESSION['permissions']['users']['access']) && $_SESSION['permissions']['users']['access'] != 'true')) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to manage the account users","error");
			response()->redirect(url("AccountsController@index"));
		}

        $this->doc->setTitle("Premiums");
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

	function changePassword($id) {

		$user = $this->getModel("User");
		$user->column['user_id'] = $id;
		$user->and(" account_id = ". $this->account_id);
		$data = $user->getById();

		$this->setTemplate("users/changePassword.php");
		return $this->getTemplate($data,$user);
	}

	function new() {

		if((!isset($_SESSION['permissions']['users']['access']))) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to create a new user","error");
			response()->redirect(url("UsersController@index"));
		}

		$this->setTempalteBasePath(ROOT."Admin");
		return parent::add($this->account_id);
	}

	function edit($account_id, $user_id) {

		if((!isset($_SESSION['permissions']['users']['access']))) {
			$this->getLibrary("Factory")->setMsg("You do not have enough permissions to create a new user","error");
			response()->redirect(url("UsersController@index"));
		}

		$this->setTempalteBasePath(ROOT."Admin");
		return parent::edit($account_id,$user_id);
	}

	function delete($account_id, $user_id) {
		$this->setTempalteBasePath(ROOT."Admin");
		return parent::delete($account_id,$user_id);
	}
	
	
}