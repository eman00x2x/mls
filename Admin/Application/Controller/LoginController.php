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
			if($this->checkCredentials($_POST['username'],md5($_POST['password']))) {
				header("LOCATION: ".$this->domain."");
			}
		}

		$doc->addScriptDeclaration("
			$(document).ready(function(e) {
				height = $(document).height();
				$('.login-container').css('height',(height - 200));
			});
		");

		$doc->setTitle("Philproperties CRM Login");

		$this->setTemplate("login/login.php");
		return $this->getTemplate();
		
	}

	function forgotPassowrd() {

		$doc = $this->getLibrary("Factory")->getDocument();

		$doc = \Library\Factory::getDocument();
		$doc->setTitle("Send Password Reset Link - Philproperties CRM");

		$this->setTemplate("login/forgot-password.php");
		return $this->getTemplate();
	}

	function resetPassword() {

		if(!isset($_REQUEST['ref'])) {
			response()->redirect('/not-found');
		}else {
			$this->setTemplate("login/reset-password.php");
			return $this->getTemplate();
		}

	}
	
	function checkSession() {
	
		if(isset($_REQUEST['logout'])) {
			$this->doLogOut();
			return false;
		}
	
		if(isset($_SESSION['logged']) && (isset($_SESSION['domain']) ? ($_SESSION['domain'] == $this->domain ? true : false) : false)) {
			return $this->checkCredentials($_SESSION['username'],$_SESSION['password']);
		}else {
			$this->doLogOut();
			return false;
		}
		
	}
	
	function checkCredentials($username,$password) {

		$user = $this->getModel('User');
		$user->column['username'] = $username;
		$user->column['password'] = $password;

		if($data = $user->getByUsernameAndPassword()) {
			
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
					'username' => $login['username'],
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
					'username' => null,
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
		
		$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;
		parse_str(file_get_contents('php://input'), $_POST);
		
		if($email) {
		
			$user = $this->getModel("User");
			$user->email = $email;
			
			if($user->getByEmail()) {
			
				$html[] = "<h1><img src='".CDN."images/logo.png' /></h1><br/><table cellpadding='10' cellspacing='2' border='1'>";
				$html[] = "<p>Hi ".$user->firstname." ".$user->lastname."!</p>";
				
				$html[] = "<p>You request a password reset link through our system, Please click the link below to reset your password now.</p>";
				
				$link = ADMIN."?task=resetPassword&ref=".base64_encode("user_id=".$user->user_id."&expires=".date("Y-m-d H:i:s",strtotime("+24 hours")));
				
				$html[] = "<p>This link will be available for the next 24 hours</p>";
				$html[] = "<p style='padding:10px;'><a href='$link'>Reset your password</a></p>";
				
				$mail = $this->getModel("Mail");
				if($mail->send($mail->email_responder_address,$email,"Password Reset Request",implode("",$html))) {
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
				$this->getLibrary("Factory")->setMsg("Email \"$email\" does not recognized by our system!.","warning");
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
		
		if($user->save($_POST['user_id'],$_POST)) {
		
			$this->getLibrary("Factory")->setMsg("Password successfully change.","correct");
			$response = array(
				"status" => 1,
				"message" => getMsg()
			);
			
		}else {
			$response = array(
				"status" => 2,
				"message" => getMsg()
			);
		}
		
		return json_encode($response);
		
	}
	
}