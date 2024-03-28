<?php

namespace Admin\Application\Controller;

class UsersController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}
	
	function index() {

		$this->doc->setTitle("Account Users");
		
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

		
		$this->doc->setTitle("View User");
		
		if($id) {
		
			$table['user'] = $this->getModel("User");
			$table['user']->column['user_id'] = $id;
			$table['user']->join = " u JOIN #__accounts a ON u.account_id = a.account_id";

			if($data = $table['user']->getById()) {
				$this->setTemplate("users/view.php");
				return $this->getTemplate($data);
			}
			
		}
		
		$this->response(404);

	}
	
	function add($id) {

		$this->doc->setTitle("Add New User");
		$this->doc->addScript(CDN."js/photo-uploader.js");
		
		$accounts = $this->getModel("Account");
		$accounts->select(" *, (SELECT COUNT(*) FROM #__users WHERE account_id = $id) as total_users");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		if($data) {

			if(!in_array($data['account_type'],["Administrator","Customer Service", "Web Admin"])) {
				$subscription = $this->getModel("AccountSubscription");
				$subscription->column['account_id'] = $id;
				$privileges = $subscription->getSubscription();

				if($privileges === false) {
					$data['privileges'] = $data['privileges'];
				}else {
					$data['privileges'] = $privileges;
				}

				if($data['total_users'] >= $data['privileges']['max_users']) {
					$this->getLibrary("Factory")->setMsg("The maximum number of users for this account has been reached.","error");
					response()->redirect(url("AccountsController@view",["id" => $data['account_id']]));
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

		
		$this->doc->setTitle("Update User");
		
		if($id) {

			$this->doc->addScript(CDN."js/photo-uploader.js");
			
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

	function changePassword($id, $account_id) {

		$this->doc->setTitle("Change Password");

		$user = $this->getModel("User");
		$user->column['user_id'] = $id;
		$user->and(" account_id = ". $account_id);
		$data = $user->getById();

		$this->setTemplate("users/changePassword.php");
		return $this->getTemplate($data,$user);
	}
	
	function saveNew($account_id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$user = $this->getModel("User");

		foreach($_POST['permissions'] as $key => $val) {
			$_POST['permissions'][$key] = (boolean) $val;
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

			$accounts = $this->getModel("Account");
			$accounts->select(" *, (SELECT COUNT(*) FROM #__users WHERE account_id = $account_id) as total_users");
			$accounts->column['account_id'] = $account_id;
			$data = $accounts->getById();

			if(isset($_POST['user_status']) && $_POST['user_status'] == "active") {

				$user->select(" COUNT(user_id) as counted ")->where(" account_id = $account_id AND user_status = 'active' ");
				$total_user = $user->getList();

				if(!in_array($data['account_type'],["Administrator","Customer Service", "Web Admin"])) {
					$subscription = $this->getModel("AccountSubscription");
					$subscription->column['account_id'] = $account_id;
					$privileges = $subscription->getSubscription();

					if($privileges) {
						$data['privileges'] = $privileges;
					}
					
					if($total_user[0]['counted'] > $data['privileges']['max_users']) {
						$this->getLibrary("Factory")->setMsg("This account has already reached the maximum number of users; therefore, the user cannot activate it", "warning");

						return json_encode(
							array(
								"status" => 2,
								"message" => getMsg()
							)
						);
					}

				}
			}

			$user->select("");
			$user->column['user_id'] = $user_id;
			$user->where(" account_id = $account_id ");
			$data = $user->getById();

			if(isset($_POST['permissions'])) {
				foreach($_POST['permissions'] as $key => $arr) {
					foreach($arr as $arrkey => $val) {
						$_POST['permissions'][$key][$arrkey] = (boolean) $val;
					}
				}
			}

			if(isset($_POST['photo']) && $_POST['photo'] != $data['photo']) {
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