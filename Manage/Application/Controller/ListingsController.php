<?php

namespace Manage\Application\Controller;

class ListingsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	
	function __construct() {
		parent::__construct();
		$this->account_id = $this->session['account_id'];

		if(!$this->session['permissions']['properties']['access']) {
			$this->getLibrary("Factory")->setMsg("You do not have permissions to access this content.", "warning");
			response()->redirect(url("DashboardController@index"));
		}
	}
	
	function index($account_id = null) {

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			$(document).on('click', '.btn-download-listings', function() {
				$.get('".url("ListingsController@downloadPropertyListings")."', function(data) {
					
					$('.response').html(\"<div class='message alert alert-success alert-dismissible bg-white p-3'><div class='d-flex align-items-center gap-3'><div class='loader'></div> <p class='mb-0'>File downloading...</p> </div> <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>\");

					response = JSON.parse(data);

					if(response.status == 1) {

						fetch(response.url)
							.then(resp => resp.blob())
							.then(blob => {
								const url = window.URL.createObjectURL(blob);
								const a = document.createElement('a');
								a.style.display = 'none';
								a.href = url;

								// the filename you want
								a.download = response.filename;
								document.body.appendChild(a);
								a.click();

								window.URL.revokeObjectURL(url);

								$('.response').hide();

							})
							.catch(function() {
								$('.response').html(\"<div class='alert alert-danger alert-dismissible bg-white p-3'><div class='d-flex align-items-center gap-3'><div class='loader'></div> <p class='mb-0'>File error downloading...</p></div> <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>\");
							});

					}else {

					}
						
				});
			});

		"));

		$this->setTempalteBasePath(ROOT."/Manage");
		return parent::index($this->account_id);
	}
	
	function edit($id, $account_id = null) {
		return parent::edit($id, $this->account_id);
	}
	
	function add($account_id = null) {
		return parent::add($this->account_id);
	}

	function saveNew() {
		return parent::saveNew();
	}

	function downloadPropertyListings($account_id = null) {
		return parent::downloadPropertyListings($this->account_id);
	}

}