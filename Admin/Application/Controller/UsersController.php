<?php

namespace Admin\Application\Controller;

class UsersController extends \Main\Controller {

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function index() {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Account Users");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (username LIKE '%".$_REQUEST['search']."%' OR name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$table['user'] = $this->getModel("User");
		$table['user']->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" date_added DESC ");

		$table['user']->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$table['user']->page['target'] = url("UsersController@index");
		$table['user']->page['uri'] = (isset($uri) ? $uri : []);

		$data = $table['user']->getList();

		$this->setTemplate("users/userList.php");
		return $this->getTemplate($data,$table['user']);
		
	}
	
	function view($account_id, $id) {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("View User");
		
		if($id) {
		
			$table['user'] = $this->getModel("User");
			$table['user']->column['user_id'] = $id;

			if($data = $table['user']->getById()) {
				$this->setTemplate("users/view.php");
				return $this->getTemplate($data);
			}
			
		}
		
		$this->response(404);

	}
	
	function add($id) {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->addScript(CDN."js/photo-uploader.js");

		$doc->setTitle("Add New User");

		$accounts = $this->getModel("Account");
		$accounts->select(" *, (SELECT COUNT(*) FROM #__users WHERE account_id = $id) as total_users");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		if($data) {

			$subscription = $this->getModel("AccountSubscription");
			$subscription->page["limit"] = 999999;
			$subscription
			->join(" acs JOIN #__premiums p ON p.premium_id = acs.premium_id ")
			->where(" (subscription_end_date >= '".DATE_NOW."' OR subscription_date = 0) ")
			->and(" account_id = $id ");

			$data['subscriptions'] = $subscription->getList();

			if($data['subscriptions']) {
				for($i=0; $i<count($data['subscriptions']); $i++) {
					foreach($data['subscriptions'][$i]['script'] as $privilege => $val) {

						if(in_array($privilege,["leads_DB","properties_DB"])) {
							if($val == 1) $data['privileges'][$privilege] = 1;
						}else {
							$data['privileges'][$privilege] += $val;
						}
						
					}
				}
			}

			if($data['total_users'] == $data['privileges']['max_users'] && !in_array($data['account_type'],["Administrator","Customer Service"])) {
				$this->getLibrary("Factory")->setMsg("Maximum users have been reached for this account.","error");
				response()->redirect(url("AccountsController@view",["id" => $data['account_id']]));
			}

			/** OTHER ACCOUNTS */
			if($_SESSION['user_logged']['account_id'] == $data['account_id']) {
				
				if($data['total_users'] == $_SESSION['user_logged']['privileges']['max_users']) {
					$this->getLibrary("Factory")->setMsg("Maximum users have been reached for this account.","error");
					response()->redirect(url("UsersController@index"));
				}

			}

			if($data['logo'] == "") {
				$data['logo'] = CDN."images/blank-profile.png";
			}
			
			$this->setTemplate("users/add.php");
			return $this->getTemplate($data);
		}

		$this->response(404);

	}

	function userEdit($id) {
		return $this->edit($_SESSION['user_logged']['account_id'], $id); 
	}
	
	function edit($account_id, $id) {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Update User");
		
		if($id) {

			$doc->addScript(CDN."js/photo-uploader.js");
			
			$table['user'] = $this->getModel("User");
			$table['user']->column['user_id'] = $id;
			$table['user']->join = " u JOIN #__accounts a ON u.account_id = a.account_id";
			$table['user']->and(" u.account_id = $account_id ");

			if($data = $table['user']->getById()) {
				$this->setTemplate("users/edit.php");
				return $this->getTemplate($data);
			}
		
		}

		$this->response(404);
		
	}
	
	function saveNew($account_id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$user = $this->getModel("User");

		$_POST['permissions'] = json_encode($_POST['permissions']);
		
		if($_POST['photo'] != $data['photo']) {
				/* remove old logo */

				$photo_url = explode("/", $data['photo']);
				$current_photo = array_pop($photo_url);
				$file = ROOT."Cdn/images/users/".$current_photo;
				
				if(file_exists($file)) {
					@unlink($file);
				}
				
				$_POST['photo'] = $user->moveUploadedImage($_POST['photo']);
			}

		$response = $user->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		
		return json_encode(
			array(
				"status" => $response['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function saveUpdate($account_id, $user_id) {
	
		parse_str(file_get_contents('php://input'), $_POST);

		if($user_id) {

			$user = $this->getModel("User");
			$user->column['user_id'] = $user_id;
			$data = $user->getById();
			
			if(isset($_POST['permissions'])) {
				$_POST['permissions'] = json_encode($_POST['permissions']);
			}

			if($_POST['photo'] != $data['photo']) {
				/* remove old logo */

				$photo_url = explode("/", $data['photo']);
				$current_photo = array_pop($photo_url);
				$file = ROOT."Cdn/images/users/".$current_photo;
				
				if(file_exists($file)) {
					@unlink($file);
				}
				
				$_POST['photo'] = $user->moveUploadedImage($_POST['photo']);
			}

			$response = $user->save($user_id,$_POST);

			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(
				array(
					"status" => $response['status'],
					"message" => getMsg()
				)
			);
			
		}else {
			$this->getLibrary("Factory")->setMsg("User not found!.","error");
			return json_encode(
				array(
					"status" => 2,
					"message" => getMsg()
				)
			);
		}
		
	}
	
	function delete($account_id, $id) {

		$user = $this->getModel("User");
		$user->column['user_id'] = $id;
		$user->and(" account_id = ".$account_id );
		$data = $user->getById();
		
		if($data) {
			if(isset($_REQUEST['delete'])) {
				
				$response = $user->deleteUser($id);

				$this->getLibrary("Factory")->setMsg("User permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);
				
			}
		}else {
			$this->getLibrary("Factory")->setMsg("User not found.","warning");
			return json_encode(
					array(
						"status" => 2,
						"message" => getMsg()
					)
				);

				
		}

		$this->setTemplate("users/delete.php");
		return $this->getTemplate($data);
		
	}

	function uploadPhoto() {
		$user = $this->getModel("User");
		return $user->uploadPhoto($_FILES['ImageBrowse']);
	}

}