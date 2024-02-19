<?php

namespace Manage\Application\Controller;

class AccountsController extends \Admin\Application\Controller\AccountsController {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['user_logged']['account_id'];
	}
	
	function index() {

        if(!isset($_SESSION['user_logged']['permissions']['account']['access'])) {
            $this->getLibrary("Factory")->setMsg("You do not have enough permissions to access the account details","error");
			response()->redirect(url("DashboardController@index"));
        }

        $this->doc->setTitle("My Accounts");
        $this->doc->addScript(CDN."js/photo-uploader.js");

        if((!isset($_SESSION['user_logged']['permissions']['users']['access']))) {
            $this->doc->addScriptDeclaration("
                $(document).ready(function() {
                    $('input').removeClass('form-control');
                    $('input').addClass('form-control-plaintext');
                    $('input').attr('readonly', true);
                });
            ");
        }

        $account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();

        $reference = $this->getModel("LicenseReference");
		$reference->column['reference_id'] = $data['reference_id'];
		$response =	$reference->getById();
        
        $data['broker_prc_license_id'] = "Unknown Real Estate Broker";
        if($response) {
            $data['broker_prc_license_id'] = $response['broker_prc_license_id'];
        }

        $data['privileges'] = $_SESSION['user_logged']['privileges'];

		$this->setTemplate("accounts/account.php");
		return $this->getTemplate($data,$account);

	}

    function accountProfile() {
        $this->setTempalteBasePath(ROOT."Admin");
        return parent::profile($this->account_id);
    }
	
	
}