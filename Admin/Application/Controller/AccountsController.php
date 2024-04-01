<?php

namespace Admin\Application\Controller;

class AccountsController extends \Main\Controller {

	public $doc;
	public $session;

	function __construct() {
		$this->setTempalteBasePath(ROOT."Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}
	
	function index() {

		if(!isset($this->session['permissions']['accounts']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Accounts");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (account_name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$accounts = $this->getModel("Account");
		$accounts
		->where(isset($clause) ? implode(" ",$clause) : null)
		->orderBy(" registration_date DESC ");

		$accounts->page['limit'] = 20;
		$accounts->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$accounts->page['target'] = url("AccountsController@index");
		$accounts->page['uri'] = (isset($uri) ? $uri : []);

		$data = $accounts->getList();

		$this->setTemplate("accounts/accountList.php");
		return $this->getTemplate($data,$accounts);
		
	}

	function profile($id) {

		if(!isset($this->session['permissions']['accounts']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Profile");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				tinymce.remove();
						
				tinymce.init({
					selector: 'textarea#snow-container',
					height: 500,
					width: 'auto',
					resize: false,
					menubar: false,
					plugins: [
						'advlist autolink lists link charmap print preview anchor',
						'searchreplace visualblocks code fullscreen',
						'insertdatetime media table paste code wordcount image '
					],
					toolbar: 'table image link formatting | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code ',
					toolbar_groups: {
						formatting: {
							icon: 'bold',
							tooltip: 'Formatting',
							items: 'bold italic underline | superscript subscript'
						},
						alignment: {
							icon: 'alignjustify',
							tooltip: 'alignment',
							items: ''
						}
					},
					content_css: [
						'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
						'".WEBDOMAIN."/css/style.css'
					]
				});
			});
		");

		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		$this->setTemplate("accounts/profile.php");
		return $this->getTemplate($data);

	}
	
	function view($account_id) {

		if(!isset($this->session['permissions']['accounts']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("View Account");

		if($account_id) {

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				$(document).on('show.bs.modal','#accountModal',function(e) {
					button = e.relatedTarget;
					url = button.getAttribute('data-url');
					
					$.get(url,function(data,status) {
						$('#accountModal .response-modal').html(data);
					});
				});

				$(document).on('click','.btn-subscription-select',function() {
					url = $(this).attr('data-url');
					$.get(url,function(data,status) {
						$('#accountModal .response-modal').html(data);
					});
				});

				$(document).on('click','.btn-save-subscription',function() {
					$('#accountModal .response-modal .btn-close').trigger('click');
					/* window.location.reload(); */
				});

				$(document).on('click','.btn-delete-continue',function() {
					var row = $(this).attr('data-row');
					var url = $(this).attr('data-url');

					$.get(url, function(data, status) {
						response = JSON.parse(data);
						
						if(response.status == 1) {
							$('.'+row).remove();
							$('#accountModal .response-modal .btn-close').trigger('click');

							$('.response').html(response.message);
						}else {
							$('.response').html(response.message);
						}

					});

				});

				$(document).on('change', '#duration', function() {
					let duration = $(this).val();
					let cost = parseInt($('.cost').data('value'));
					
					switch(duration) {
						case '365': total = cost * 12; break;
						case '730': total = cost * 24; break;
						default: total = (cost / 30) * duration; break;
					}
						
					$('#premium_price').val( total );
					$('.cost').text( parseFloat(total.toFixed(2)).toLocaleString() );
				});

			"));
		
			$accounts = $this->getModel("Account");
			$user = $this->getModel("User");
			$transaction = $this->getModel("Transaction");
			$subscription = $this->getModel("AccountSubscription");

			$accounts->column['account_id'] = $account_id;
			
			if($data = $accounts->getById()) {

				$user->page['limit'] = 100;
				$user->where(" account_id = ".$data['account_id']." ");
				$user->orderBy(" date_added DESC ");
				$data['users'] = $user->getList(); 

				$subscription->page['limit'] = 10;
				$subscription
				->select("acs.account_subscription_id, s.premium_id, s.name, s.details, subscription_status, subscription_start_date, subscription_end_date, script")
				->join(" acs JOIN #__premiums s ON s.premium_id=acs.premium_id ")
				->and(" account_id = ".$data['account_id']." ")
				->orderby(" acs.premium_id DESC");

				$data['subscriptions'] = $subscription->getList();

				if($data['subscriptions']) {
					for($i=0; $i<count($data['subscriptions']); $i++) {
						if($data['subscriptions'][$i]['subscription_status'] == 1) {
							foreach($data['subscriptions'][$i]['script'] as $privilege => $val) {

								if(!isset($data['privileges'][$privilege])) {
									$data['privileges'][$privilege] = 0;
								}

								$data['privileges'][$privilege] += $val;
							}
						}
					}
				}

				$transaction->page['limit'] = 10;
				$transaction->where(" account_id = ".$data['account_id']." ORDER BY created_at DESC ");
				$data['transaction'] = $transaction->getList();

				$this->setTemplate("accounts/view.php");
				return $this->getTemplate($data);
			}

		}

		$this->response(404);

	}

	function add() {

		if(!isset($this->session['permissions']['accounts']['add'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("New Account");
		$this->doc->addScript(CDN."js/photo-uploader.js");
		$this->doc->addScript(CDN."js/encryption.js");

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				(async () => {
					let keys = await generateKey();
					$('#publicKey').val(JSON.stringify(keys.publicKey));
					$('#privateKey').val(JSON.stringify(keys.privateKey));

					$('#api_key').val(uuidv4());
				})();
			});
		"));

		$data['board_regions'] = BOARD_REGIONS;
		$data['local_boards'] = LOCAL_BOARDS;
		sort($data['local_boards']);

		$this->setTemplate("accounts/add.php");
		return $this->getTemplate($data);

	}
	
	function edit($account_id) {

		if(!isset($this->session['permissions']['accounts']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Update Account");

		if($account_id) {

			$this->doc->addScript(CDN."js/photo-uploader.js");

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				$(document).ready(function() {
					(async () => {
						$('#api_key').val(uuidv4());
						$('#pin').val(rcg());
					})();
				});
			"));
			
			$accounts = $this->getModel("Account");
			$accounts->column['account_id'] = $account_id;

			if($data = $accounts->getById()) {

				$data['board_regions'] = BOARD_REGIONS;
				$data['local_boards'] = LOCAL_BOARDS;
				sort($data['local_boards']);

				if($data['reference_id'] != 0) {
					$reference = $this->getModel("LicenseReference");
					$reference->column['reference_id'] = $data['reference_id'];
					$response =	$reference->getById();

					$data['broker_prc_license_id'] = $response['broker_prc_license_id'];
				}else {
					$data['broker_prc_license_id'] = "";
				}

				$this->setTemplate("accounts/edit.php");
				return $this->getTemplate($data);
			}
		
		}

		$this->response(404);
		
	}

	function saveNew() {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$accounts = $this->getModel("Account");
		$user = $this->getModel("User");

		$user->column['email'] = $_POST['email'];
		$accounts->column['email'] = $_POST['email'];

		if($accounts->getByEmail() || $user->getByEmail()) {
			
			$this->getLibrary("Factory")->setMsg("Email already registered", "info");

			return json_encode(array(
				"type" => 2,
				"message" => getMsg()
			));

		}

		
		if(isset($_POST['logo']) && $_POST['logo'] != "") {
			$_POST['logo'] = $accounts->moveUploadedImage($_POST['logo']);
		}

		$time = DATE_NOW;

		$_POST['name'] = $_POST['firstname']." ".$_POST['lastname'];
		$_POST['date_added'] = $time;
		$_POST['registration_date'] = $time;
		$_POST['created_at'] = $time;
		$_POST['permissions'] = json_encode(USER_PERMISSIONS);
		$_POST['privileges'] = json_encode(isset($_POST['privileges']) ? $_POST['privileges'] : CONFIG['privileges']);
		$_POST['account_type'] = "Real Estate Practitioner";
		$_POST['user_level'] = 1;
		$_POST['reference_id'] = 0;
		$_POST['status'] = "pending_activation";

		$_POST['account_name'] = json_encode([
			"prefix" => (isset($_POST['prefix']) ? $_POST['prefix'] : ''),
			"firstname" => $_POST['firstname'],
			"middlename" => (isset($_POST['middlename']) ? $_POST['middlename'] : ''),
			"lastname" => $_POST['lastname'],
			"suffix" => (isset($_POST['suffix']) ? $_POST['suffix'] : ''),
		]);

		if($_POST['broker_prc_license_id'] != 1) {
			$reference = $this->getModel("LicenseReference");
			$response =	$reference->getByLicenseId($_POST['broker_prc_license_id']);

			if($response['status'] == 1) {
				if($response['data']['reference_id'] != 0) {
					$_POST['reference_id'] = $response['data']['reference_id'];
				}
			}
		}

		foreach($_POST['message_keys'] as $key => $val) {
			$_POST['message_keys'][$key] = json_decode($val, true);
		}

		$accountResponse = $accounts->saveNew($_POST);
		
		if($accountResponse['status'] == 1) {

			$_POST['account_id'] = $accountResponse['id'];

			$_POST['user_status'] = "active";
			$_POST['name'] = implode(" ", json_decode($_POST['account_name'], true));
			$response = $user->saveNew($_POST);

			if($response['status'] == 1) {
				if($_POST['broker_prc_license_id'] != 1) {
					if($_POST['reference_id'] == 0) {
						$license = $this->getModel("LicenseReference");
						$license->saveNew($_POST);
					}
				}

				/** SEND EMAIL ACTIVATION LINK */
				$mail = new Mailer();
				$response = $mail
					->build( $this->mailActivationUrl($_POST) )
						->send([
							"to" => [
								$data['email']
							]
						], CONFIG['site_name'] . " Account activation ");

			}else {
				$accounts->deleteAccount($accountResponse['id']);
			}

			$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

			return json_encode(array(
				"type" => 1,
				"status" => $response['status'],
				"message" => getMsg()
			));

		}

		$this->getLibrary("Factory")->setMsg($accountResponse['message'],$accountResponse['type']);
		
		return json_encode(
			array(
				"status" => $accountResponse['status'],
				"message" => getMsg()
			)
		);
		
	}
	
	function saveUpdate($account_id) {

		parse_str(file_get_contents('php://input'), $_POST);

		if($account_id) {

			$accounts = $this->getModel("Account");
			$accounts->column['account_id'] = $account_id;
			$data = $accounts->getById();
			
			if(isset($_POST['address'])) {
				$_POST['address'] = (isset($_POST['street']) ? $_POST['street'] : "")." ".(isset($_POST['city']) ? $_POST['city'] : "")." ".(isset($_POST['province']) ? $_POST['province'] : "");
			}

			if(isset($_POST['logo']) && $_POST['logo'] != $data['logo']) {
				/* remove old logo */

				$logo_url = explode("/", $data['logo']);
				$current_logo = array_pop($logo_url);
				$file = ROOT."Cdn/images/accounts/".$current_logo;
				
				if(file_exists($file)) {
					@unlink($file);
				}
				
				$_POST['logo'] = $accounts->moveUploadedImage($_POST['logo']);

			}else { $_POST['logo'] = null; }
			
			if(isset($_POST['broker_prc_license_id'])) {

				$reference = $this->getModel("LicenseReference");
				$response =	$reference->getByLicenseId($_POST['broker_prc_license_id']);

				if($response['data']['reference_id'] != 0) {
					$_POST['reference_id'] = $response['data']['reference_id'];
				}else {
					$_POST['created_at'] = DATE_NOW;
					$response = $reference->saveNew($_POST);
					$_POST['reference_id'] = $response['id'];
				}

			}

			if(isset($_POST['firstname'])) {
				$user = $this->getModel("User");
				$user->column['email'] = $data['email'];
				$data['user'] = $user->getByEmail();

				$user->save($data['user']['user_id'],array(
					"photo" => $_POST['logo'],
					"name" => $_POST['firstname']." ".$_POST['lastname']
				));
			}

			if(isset($_POST['uploads'])) {

				if(isset($_POST['uploads']['kyc'])) {
					array_map('unlink', array_filter((array) glob(ROOT."Cdn/public/kyc/$account_id/*")));
				}

				foreach($_POST['uploads'] as $key => $val) {
					if($key == "kyc") {
						$accounts->moveUploadedImage($_POST['uploads']['kyc']['selfie'], "public/kyc/$account_id");
						$accounts->moveUploadedImage($_POST['uploads']['kyc']['id'], "public/kyc/$account_id");
					}
				}

			}

			if(isset($_POST['message_keys'])) {
				foreach($_POST['message_keys'] as $key => $val) {
					$_POST['message_keys'][$key] = json_decode($val, true);
				}
			}

			$_POST['account_name'] = json_encode([
				"prefix" => $_POST['prefix'],
				"firstname" => $_POST['firstname'],
				"middlename" => $_POST['middlename'],
				"lastname" => $_POST['lastname'],
				"suffix" => $_POST['suffix'],
			]);

			$response = $accounts->save($account_id,$_POST);
			
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
	
	function delete($id) {

		if(!isset($this->session['permissions']['accounts']['delete'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}
		
		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

		if($data) {

			if($data['account_type'] != "Administrator") {

				if(isset($_REQUEST['delete'])) {

					$listing = $this->getModel("Listing");
					$listing_image = $this->getModel("ListingImage");
					$invoice = $this->getModel("Invoice");
					$user = $this->getModel("User");

					if(PREMIUM) {
						$account_subscription = $this->getModel("AccountSubscription");
						$account_subscription->delete($id,"account_id");
						$invoice->delete($id,"account_id");
					}

					$listing->where(" account_id = $id ");
					if($data['listings'] = $listing->getList()) {
						for($i=0; $i<count($data['listings']); $i++) {
							$listing->deleteListing($data['listings'][$i]['listing_id']);
							$listing_image->deleteListingImages($data['listings'][$i]['listing_id']);
						}
					}

					/* remove logo */
					$file = "Cdn/images/accounts/".$data['logo'];
					if(file_exists($file)) {
						@unlink($file);
					}

					$user->deleteUser($id,"account_id");
					$accounts->deleteAccount($id);
					
					$this->getLibrary("Factory")->setMsg("Account permanently deleted!.","success");
					return json_encode(
						array(
							"status" => 1
						)
					);

				}

			}else {
				$this->getLibrary("Factory")->setMsg("Administrator account cannot be deleted","error");
			}

		}else {
			$this->getLibrary("Factory")->setMsg("Account not found.","warning");
		}

		$this->setTemplate("accounts/delete.php");
		return $this->getTemplate($data);
		
	}
	
	function uploadPhoto() {
		$accounts = $this->getModel("Account");
		return $accounts->uploadPhoto($_FILES['ImageBrowse']);
	}

	function limitWithExpiredPrivileges($account_id): void {

		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $account_id;
		$data['account'] = $accounts->getById();

		$subscriptions = $this->getModel("AccountSubscription");
		$subscriptions->column['account_id'] = $account_id;
		$privileges = $subscriptions->getSubscription();

		if($privileges) {
			$data['account']['privileges'] = $privileges;
		}

		$users = $this->getModel("User");
		$users->page['limit'] = 9999;
		$users->column['account_id'] = $account_id;
		$data['users'] = $users->where(" user_status = 'active' ")->orderBy(" date_added ASC ")->getByAccountId();

		$total_users = count($data['users']);
		if($data['account']['privileges']['max_users'] >= $total_users) {
			for($i=0; $i<$total_users; $i++) {

				if($i > ($data['account']['privileges']['max_users'] - 1)) {
					/** make inactive other users in account */
					$users->save($data['users'][$i]['user_id'], [
						"user_status" => "inactive"
					]);
				}

			}
		}

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 99999;

		$data['listings'] = $listings
			->where(" account_id = $account_id AND status = 'available' ")
				->orderBy(" date_added ASC ")
					->getList();

		if($data['listings']) {
			$total_post = count($data['listings']);
			if($data['account']['privileges']['max_post'] >= $total_post) {
				for($i=0; $i<$total_post; $i++) {

					if($i > ($data['account']['privileges']['max_post'] - 1)) {
						/** make inactive property listings in account */
						$listings->save($data['listings'][$i]['listing_id'], [
							"status" => 0
						]);
					}

				}
			}
		}

	}

	 function mailActivationUrl($data) {

		$activation_url_data = json_encode([
			"account_id" => $data['account_id'],
			"email" => $data['email'],
			"expiration" => strtotime("+7 days", DATE_NOW)
		]);

		$activation_code = base64_encode($activation_url_data);
		$data['url'] = rtrim(MANAGE, "/") . rtrim(url( "AuthenticatorController@accountActivation", [ "code" => $activation_code ] ), "/");

		$this->setTemplate("accounts/MAIL_activation.php");
		return $this->getTemplate($data);

	}
	
}