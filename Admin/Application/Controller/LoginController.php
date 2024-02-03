<?php

namespace Admin\Application\Controller;

class LoginController extends \Main\Controller {
	
	private static $_instance = null;
	var $domain;
	
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->domain = ADMIN;
		return $this;
	}
	
	function login() {

		$doc = $this->getLibrary("Factory")->getDocument();
	
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if($this->checkCredentials($_POST['email'],md5($_POST['password']))) {
				header("LOCATION: ".$this->domain."");
			}
		}

		$doc->addScriptDeclaration("
			$(document).ready(function(e) {
				height = $(document).height();
				$('.login-container').css('height',(height - 200));
			});
		");

		$doc->setTitle("MLS Login");

		$this->setTemplate("login/login.php");
		return $this->getTemplate();
		
	}

	function forgotPassword() {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Send Password Reset Link - MLS");

		$this->setTemplate("login/forgot-password.php");
		return $this->getTemplate();
	}

	function resetPassword() {

		$doc = $this->getLibrary("Factory")->getDocument();
		$doc->setTitle("Password Reset - MLS");

		if(!isset($_REQUEST['ref'])) {
			response()->redirect('/not-found');
		}else {

			$ref = explode("&",base64_decode($_REQUEST['ref']));
								
			foreach($ref as $r) {
				$d = explode("=",$r);
				$data[@$d[0]] = @$d[1];
			}

			$this->setTemplate("login/reset-password.php");
			return $this->getTemplate($data);
		}

	}

	function checkSession() {
	
		if(isset($_REQUEST['logout'])) {
			$this->doLogOut();
			return false;
		}
	
		if(isset($_SESSION['logged']) && (isset($_SESSION['domain']) ? ($_SESSION['domain'] == $this->domain ? true : false) : false)) {
			return $this->checkCredentials($_SESSION['email'],$_SESSION['password']);
		}else {
			$this->doLogOut();
			return false;
		}
		
	}
	
	function checkCredentials($email,$password) {

		$user = $this->getModel('User');
		$user->column['email'] = $email;
		$user->column['password'] = $password;

		if($data = $user->getByEmailAndPassword()) {
			
			if($this->isBlock($data['status'])) {
				if($_SERVER['HTTP_HOST'] == str_replace("/","",str_replace("http://","",ADMIN)) && $data['account_type'] != "Administrator") {
					$this->getLibrary("Factory")->setMsg("Only Administrator can login here.","error");
					return false;
				}

				$subscription = $this->getModel("AccountSubscription");
				$subscription->page["limit"] = 999999;
				$subscription
				->join(" acs JOIN #__premiums p ON p.premium_id = acs.premium_id ")
				->where(" ((subscription_start_date <= '".DATE_NOW."' AND subscription_end_date >= '".DATE_NOW."') OR subscription_date = 0) ")
				->and(" account_id = ".$data['account_id'] );
				$data['subscriptions'] = $subscription->getList();

				if($data) {

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

				}

				return $this->doLogin($data);
			}
		}

		$this->getLibrary("Factory")->setMsg("Invalid Username or Password.","error");
		return false;
		
	}
	
	function doLogin($login) {
	
		$val = array('user_id' => (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $login['user_id']),
					'name' => (isset($_SESSION['name']) ? $_SESSION['name'] : $login['name']),
					'email' => $login['email'],
					'password' => $login['password'],
					'user_level' => $login['user_level'],
					'permissions' => $login['permissions'],
					'privileges' => $login['privileges'],
					'account_id' => $login['account_id'],
					'account_type' => $login['account_type'],
					'logo' => $login['logo'],
					'domain' => $this->domain,
					'logged' => true);
		$this->storeSession($val);
		return true;
		
	}
	
	function isBlock($status) {
		
		if( $status == 2 ) {
			
			$this->getLibrary("Factory")->setMsg("You have been blocked by the System Administrator","warning");
			$this->doLogOut();
			
			return false;
		}else {
			return true;
		}
		
	}
	
	function doLogOut() {
	
		$val = array('user_id' => null,
					'name' => null,
					'email' => null,
					'password' => null,
					'permissions' => null,
					'privileges' => null,
					'account_id' => null,
					'account_type' => null,
					'logo' => null,
					'domain' => null,
					'logged' => false);
					
		$this->unsetCS($val);
		
	}
	
	function storeSession($arr = array()) {
	
		foreach($arr as $val => $key) {
			$_SESSION[$val] = $key;
			/* setcookie($val, $key, time()+604800); */
		}
		
	}
	
	function unsetCS($arr = array()) {
	
		if(isset($_SESSION['logged'])) {
			foreach($arr as $val => $key) {
			
				/* delete sessions */
				unset($_SESSION[$val]);
				
				/* delete cookies */
				@setcookie($val, $key, time()-3600);
				unset($_COOKIE[$val]);
				
			}
			
			#header("LOCATION: ".DOMAINNAME);
		}
		
		/*if(!isset($_SESSION['logged'])) {
			unset($_SESSION);
			session_destroy();
		}*/
		
	}
	
	function sendPasswordResetLink() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		if($_POST['email']) {
		
			$user = $this->getModel("User");
			$user->column['email'] = $_POST['email'];
			
			if($data = $user->getByEmail()) {
			
				$html[] = "<h1><img src='".CDN."images/logo.png' /></h1><br/><table cellpadding='10' cellspacing='2' border='1'>";
				$html[] = "<p>Hi ".$data['name']."!</p>";
				
				$html[] = "<p>You request a password reset link through our system, Please click the link below to reset your password now.</p>";
				
				$ref = base64_encode("user_id=".$data['user_id']."&expires=".date("Y-m-d H:i:s",strtotime("+24 hours")));
				$link = url("LoginController@resetPassword",null,['ref' => $ref]);
				
				$html[] = "<p>This link will be available for the next 24 hours</p>";
				$html[] = "<p style='padding:10px;'><a href='$link'>Reset your password</a></p>";
				
				$mail = $this->getModel("Mail");
				if($mail->sendMail(EMAIL_RESPONDER_ADDRESS,$data['email'],"Password Reset Request",implode("",$html))) {
					$this->getLibrary("Factory")->setMsg("Password reset link has been sent to your registered email.","correct");
					$response = array(
						"status" => 1,
						"message" => getMsg()
					);
				}else {
					$this->getLibrary("Factory")->setMsg("Cannot request password reset link at the moment, please contact your system administrator.","warning");
					$response = array(
						"status" => 2,
						"message" => getMsg()
					);
				}
				
			}else {
				$this->getLibrary("Factory")->setMsg("Email \"".$_POST['email']."\" does not recognized by our system!.","warning");
				$response = array(
					"status" => 2,
					"message" => getMsg()
				);
			}
			
		
		}else {
			$this->getLibrary("Factory")->setMsg("Invalid email address!.","warning");
			$response = array(
				"status" => 2,
				"message" => getMsg()
			);
		}
		
		return json_encode($response);
	}
	
	function saveNewPassword() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$user = $this->getModel("User");
		$user->column['user_id'] = $_POST['user_id'];
		$data = $user->getById();

		if($data) {
			$response = $user->save($data['user_id'], $_POST);
		}else {
			$response = array(
				"status" => 2,
				"type" => "error",
                "message" => "Invalid Account! Request another password reset link!"
			);
		}
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);
		$response = array(
			"status" => $response['status'],
			"message" => getMsg()
		);
		
		return json_encode($response);
		
	}

}