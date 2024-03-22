<?php

namespace Manage\Application\Controller;

class AccountsController extends \Admin\Application\Controller\AccountsController {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $this->session['account_id'];
	}
	
	function index() {

        $this->limitWithExpiredPrivileges($this->session['account_id']);

        if(!isset($_SESSION['user_logged']['permissions']['accounts']['access'])) {
            $this->getLibrary("Factory")->setMsg("You do not have enough permissions to access the account details","error");
			response()->redirect(url("DashboardController@index"));
        }

        $this->doc->setTitle("My Accounts");
        $this->doc->addScript(CDN."js/photo-uploader.js");

        if((!isset($this->session['permissions']['users']['access']))) {
            $this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
                $(document).ready(function() {
                    $('input').removeClass('form-control');
                    $('input').addClass('form-control-plaintext');
                    $('input').attr('readonly', true);

                    $('select').attr('disabled', true);

                    $('#api_key').val(uuidv4());
                    $('#pin').val(rcg());
                });

                $(document).on('click', '.btn-reveal-api-key', function() {
                    key = $(this).data('key');
                    $('.api-key-container').removeClass('text-muted');
                    $('.api-key-container').text(key);
                    
                    $(this).remove();
                });
            "));
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

        $data['board_regions'] = BOARD_REGIONS;
		$data['local_boards'] = LOCAL_BOARDS;
		sort($data['local_boards']);

		$this->setTemplate("accounts/account.php");
		return $this->getTemplate($data,$account);

	}

    function saveUpdate($account_id = null) {
        return parent::saveUpdate($this->account_id);
    }

    function uploadPhoto() {
		return parent::uploadPhoto();
	}

    function accountProfile() {
        $this->setTempalteBasePath(ROOT."Admin");
        return parent::profile($this->account_id);
    }
	
	
}