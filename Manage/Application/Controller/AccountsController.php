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

        if(!isset($this->session['permissions']['accounts']['access'])) {
            $this->getLibrary("Factory")->setMsg("You do not have enough permissions to access the account details","error");
			response()->redirect(url("DashboardController@index"));
        }

        $this->doc->setTitle("My Accounts");
        $this->doc->addScript(CDN."js/photo-uploader.js");

        if(!isset($this->session['permissions']['accounts']['access'])) {
            $this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
                $(document).ready(function() {
                    $('input').removeClass('form-control');
                    $('input').addClass('form-control-plaintext');
                    $('input').attr('readonly', true);

                    $('select').attr('disabled', true);

                    $('#api_key').val(uuidv4());
                    $('#pin').val(rcg());
                });

            "));
        }

        $this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

            $(document).on('click', '.btn-reveal-api-key', function() {
                key = $(this).data('key');
                $('.api-key-container').removeClass('text-muted');
                $('.api-key-container').text(key);
                
                $(this).remove();
            });

        "));

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

		$data['local_boards'] = LOCAL_BOARDS;
		sort($data['local_boards']);

		$address = $this->getModel("Address");
		$account->address = $address->addressSelection([
			"region" => isset($data['board_region']['region']) ? $data['board_region']['region'] : "",
			"province" => isset($data['board_region']['province']) ? $data['board_region']['province'] : "",
			"municipality" => isset($data['board_region']['municipality']) ? $data['board_region']['municipality'] : ""
		]);

		$this->setTemplate("accounts/account.php");
		return $this->getTemplate($data,$account);

	}

    function profile() {

		if(!isset($this->session['permissions']['accounts']['access'])) {
			$this->getLibrary("Factory")->setMsg("You do not have permission to access this content.","error");
			response()->redirect(url("DashboardController@index"));
		}

		$this->doc->setTitle("Profile");
		$this->doc->addScript(CDN."tinymce/tinymce.min.js");
		$this->doc->addScriptDeclaration("
			$(document).on('click', '.btn-more', function() {
				let html = '';
				let container = $(this).data('container');
				let count = $('#' + container + '-fields-count').val();
				
				switch(container) {
					case 'education':
						if(count == 1) {
							cls = 'pt-4 border-top';
						}else { cls = ''; }

						html += \"<div class='\" + cls + \" mb-4 border-bottom education-container-\" + count + \"'>\";
							html += \"<div class='form-floating mb-3 w-100'>\";
								html += \"<input type='text' name='education[\" + count + \"][school]' id='education-school-\" + count + \"' class='form-control' value='' />\";
								html += \"<label for='education-school-\" + count + \"'>School Name</label>\";
							html += \"</div>\";

							html += \"<div class='row'>\";
								html += \"<div class='col-lg-6 col-md-12 col-sm-12'>\";
									html += \"<div class='form-floating mb-3 w-100'>\";
										html += \"<input type='text' name='education[\" + count + \"][degree]' id='education-degree-\" + count + \"' class='form-control' value='' />\";
										html += \"<label for='education-degree-\" + count + \"'>Degree</label>\";
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='col-lg-6 col-md-12 col-sm-12'>\";
									html += \"<div class='d-flex gap-3 justify-content-between'>\";
										html += \"<div class='form-floating mb-3'>\";
											html += \"<input type='date' name='education[\" + count + \"][date][from]' id='education-date-\" + count + \"' class='form-control' style='width:130px;' value='' />\";
											html += \"<label for='education-date-\" + count + \"'>From</label>\";
										html += \"</div>\";
										html += \"<div class='form-floating mb-3'>\";
											html += \"<input type='date' name='education[\" + count + \"][date][to]' id='education-date-\" + count + \"' class='form-control' style='width:130px;' value='' />\";
											html += \"<label for='education-date-\" + count + \"'>To</label>\";
										html += \"</div>\";
									html += \"</div>\";
								html += \"</div>\";
							html += \"</div>\";

							html += \"<p class='fs-12 text-end'>\";
								html += \"<span class='btn btn-sm btn-secondary btn-remove' data-container='.education-container-\" + count + \"'><i class='ti ti-trash fs-14 me-1'></i> remove</span>\";
							html += \"</p>\";

						html += \"</div>\";

						break;

					case 'affiliation':

						if(count == 1) {
							cls = 'pt-4 border-top';
						}else { cls = ''; }

						html += \"<div class='\" + cls + \" mb-4 border-bottom affiliation-container-\" + count + \"'>\";
							html += \"<div class='form-floating mb-3 w-100'>\";
								html += \"<input type='text' name='affiliation[\" + count + \"][organization]' id='affiliation-organization-\" + count + \"' class='form-control' value='' />\";
								html += \"<label for='affiliation-organization-\" + count + \"'>Organization Name</label>\";
							html += \"</div>\";
							
							html += \"<div class='row'>\";
								html += \"<div class='col-lg-6 col-md-12 col-sm-12'>\";
									html += \"<div class='form-floating mb-3 w-100'>\";
										html += \"<input type='text' name='affiliation[\" + count + \"][title]' id='affiliation-title-\" + count + \"' class='form-control' value='' />\";
										html += \"<label for='affiliation-title-\" + count + \"'>Position</label>\";
									html += \"</div>\";
								html += \"</div>\";
								html += \"<div class='col-lg-6 col-md-12 col-sm-12'>\";
									html += \"<div class='d-flex gap-3 justify-content-between'>\";
										html += \"<div class='form-floating mb-3'>\";
											html += \"<input type='date' name='affiliation[\" + count + \"][date][from]' id='affiliation-date-\" + count + \"' class='form-control' style='width:130px;' value='' />\";
											html += \"<label for='affiliation-date-\" + count + \"'>From</label>\";
										html += \"</div>\";
										html += \"<div class='form-floating mb-3'>\";
											html += \"<input type='date' name='affiliation[\" + count + \"][date][to]' id='affiliation-date-\" + count + \"' class='form-control' style='width:130px;' value='' />\";
											html += \"<label for='affiliation-date-\" + count + \"'>To</label>\";
										html += \"</div>\";
									html += \"</div>\";
								html += \"</div>\";
							html += \"</div>\";
							html += \"<div class='form-floating mb-3'>\";
								html += \"<textarea name='affiliation[\" + count + \"][description]' id='affiliation-description-\" + count + \"' class='form-control' style='height:150px; width:100%'></textarea>\";
								html += \"<label for='affiliation-description-\" + count + \"'>Summary of your professional role and responsibilities</label>\";
							html += \"</div>\";

							html += \"<p class='fs-12 text-end'>\";
								html += \"<span class='btn btn-sm btn-secondary btn-remove' data-container='.affiliation-container-\" + count + \"'><i class='ti ti-trash fs-14 me-1'></i> remove</span>\";
							html += \"</p>\";

						html += \"</div>\";

						break;

					case 'certification':

						html += \"<div class='mb-2 certification-container-\" + count + \"'>\";
							html += \"<div class='input-group input-group-flat'>\";
								html += \"<div class='form-floating'>\";
									html += \"<input type='text' name='certification[\" + count + \"]' id='certification-\" + count + \"' class='form-control' value='' />\";
									html += \"<label for='certification-\" + count + \"' class='fs-12'>Certification</label>\";
								html += \"</div>\";
								html += \"<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.certification-container-\" + count + \"'><i class='ti ti-trash fs-16'></i></span>\";
							html += \"</div>\";
						html += \"</div>\";

						break;

					case 'skills':

						html += \"<div class='mb-2 skills-container-\" + count + \"'>\";
							html += \"<div class='input-group input-group-flat'>\";
								html += \"<div class='form-floating'>\";
									html += \"<input type='text' name='skills[\" + count + \"]' id='skills-\" + count + \"' class='form-control' value='' />\";
									html += \"<label for='skills-\" + count + \"' class='fs-12'>Skills</label>\";
								html += \"</div>\";
								html += \"<span class='input-group-text text-secondary cursor-pointer btn-remove' data-container='.skills-container-\" + count + \"'><i class='ti ti-trash fs-16'></i></span>\";
							html += \"</div>\";
						html += \"</div>\";

						break;
				}

				$('.' + container + '-container').append(html);

				count++;
				$('#' + container + '-fields-count').val(count);

			});

			$(document).on('click', '.btn-remove', function() {
				container = $(this).data('container');
				$(container).remove();
			});

		");

		$accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $this->account_id;
		$data = $accounts->getById();

        $this->setTempalteBasePath(ROOT."Admin");
		$this->setTemplate("accounts/profile.php");
		return $this->getTemplate($data);

	}

    function profilePreview($id) {

        $accounts = $this->getModel("Account");
		$accounts->column['account_id'] = (is_null($id) ? $this->account_id : $id);
		$data = $accounts->getById();

		$this->setTemplate("accounts/profilePreview.php");
		return $this->getTemplate($data);

    }

    function uploadPhoto() {
		return parent::uploadPhoto();
	}

}