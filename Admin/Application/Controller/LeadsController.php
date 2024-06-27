<?php

namespace Admin\Application\Controller;

class LeadsController extends \Main\Controller {
	
	public $doc;
	public $account_id;
	public $session;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
		$this->account_id = $this->session['account_id'];
	}

	function index() {

		$this->doc->setTitle("Leads");
	
		if(isset($_REQUEST['search'])) {
			$filters[] = " (name LIKE '%".$_REQUEST['search']."%') OR (email LIKE '%".$_REQUEST['search']."%') OR (mobile_no LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		$account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();

		$filters[] = " account_id = ".$data['account_id'];

		if(isset($_GET['id'])) {
			$filters[] = " lead_group_id = ".$_GET['id'];
		}
		
		$lead = $this->getModel("Lead");
		$lead->select(" lead_id, listing_id, account_id, content as user_message, iv, inquire_at, preferences ");
		$lead->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" inquire_at DESC ");
		
		$lead->page['limit'] = 20;
		$lead->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$lead->page['target'] = url("LeadsController@index");
		$lead->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['leads'] = $lead->getList();

		if($data['leads']) {

			$listing = $this->getModel("Listing");

			for($i=0; $i<count($data['leads']); $i++) {
				$encrypted_content[] = $data['leads'][$i];
				$listing->column['listing_id'] = $data['leads'][$i]['listing_id'];
				$listingData = $listing->getById();

				if($listingData) {
					$data['leads'][$i]['listing'] = $listingData;
				}else {
					$data['leads'][$i]['listing']['listing_id'] = 0;
					$data['leads'][$i]['listing']['thumb_img'] = CDN."images/item_default.jpg";
					$data['leads'][$i]['listing']['title'] = "N/A";
				}
			}

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				const content = ".json_encode($encrypted_content).";
				const publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
				const privateKey = ".json_encode($this->session['message_keys']['privateKey']).";
			"));

		}else {
			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				const content = {};
				const publicKey = {};
				const privateKey = {};
			"));
		}

		$this->doc->addScript(CDN."js/encryption.js");
		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			
			( async => {
			 	if(content != undefined) {
					for (let key in content) {
						if (content.hasOwnProperty(key)) {
							let lead_id = content[key].lead_id;
							
							decrypt(content[key], publicKey, privateKey)
								.then(  response => {
									$('.row_leads_' + lead_id + ' .name-container').html( (response.name).substring(0, 47) );
									$('.row_leads_' + lead_id + ' .email-container').html( (response.email).substring(0, 47) );
									$('.row_leads_' + lead_id + ' .mobile-number-container').html( (response.mobile_no).substring(0, 47) );

									let content = {name: response.name, email: response.email, mobile_no: response.mobile_no };
									$('.row_leads_' + lead_id + ' .btn-delete').attr('data-content', JSON.stringify(content));
								});
							
						}
					}
				}
			})();

			$(document).ready(function() {
				$.get('".url("LeadGroupsController@index")."', function(data) {

					console.log(data);

					$('.sidebar-list-group').html(data);
				});
			});

		"));

		$this->setTemplate("leads/leads.php");
		return $this->getTemplate($data,$lead);
		
	}

	function add() {
		
		$this->doc->setTitle("New Leads");

		$this->doc->addScript(CDN."js/encryption.js");
		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			let privateKey;
			let publicKey;
			
			$(document).on('click', '.btn-save-lead', function() {

				let formData = new FormData(document.querySelector('#form'));

				setKeys()
					.then( () => {
						encrypt(JSON.stringify({
							'name': formData.get('name'),
							'message': formData.get('message'),
							'mobile_no': formData.get('mobile_no'),
							'email': formData.get('email')
						}), publicKey, privateKey)
							.then( data => {

								$('#content').val( data.encrypted );
								$('#iv').val( data.iv );

								$('.btn-save').trigger('click');

							});
					});

			});

			async function setKeys() {
				privateKey = ".json_encode($this->session['message_keys']['privateKey']).";
				publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
			}

			$(document).on('click', '.btn-selected', function() {
				let id = $(this).data('id');
				let name = $(this).data('name');

				$('#lead_group_id').val(id);
				$('.btn-group-selection').text(name);

				$('.btn-close').trigger('click');
			});

			$(document).on('click', '#btn-searchgroup', function(e) {
				searchGroup();
			});

			$(document).on('keypress', '#btn-searchgroup', function(e) {
				searchGroup();
			});

			function searchGroup() {
				
				keyword = $('#searchgroup').val();
				if(keyword != '') {
					if(e.keyCode == 13 || e.which == 13) {
						$.get('".url("LeadGroupsController@searchGroup")."?search=' + keyword, function(data) {
							$('.response-body').htm(data);
						});
					}
				}

			}

		"));

		$listing = $this->getModel("Listing");
		$data['listing'] = $listing->getList();

		$lead = $this->getModel("Lead");

		$data['addresses'] = $this->getModel("Address");
		$data['categorySelection'] = $listing->categorySelection();
		
		$this->setTemplate("leads/add.php");
		return $this->getTemplate($data, $lead);
		
	}
	
	function edit($id) {
		
		$this->doc->setTitle("Update Leads");

		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$lead->where(" account_id = ".$this->account_id);
		$data = $lead->getById();

		$data['user_message'] = $data['content'];

		if($data) {

			$groups = $this->getModel("LeadGroup");
			$groups->column['lead_group_id'] = $data['lead_group_id'];
			$data['groups'] = $groups->getById();

			if($data['groups'] === false) {
				$data['groups'] = [];
				$data['groups']['name'] = "Ungrouped";
			}

			$this->doc->addScript(CDN."js/encryption.js");
			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

				const data = ".json_encode($data).";
				let privateKey;
		    	let publicKey;
				
				( async => {

					let lead_id = data.lead_id;

					setKeys()
						.then( () => {
							decrypt(data, publicKey, privateKey)
								.then(  response => {
									$('#name').val( response.name );
									$('#email').val( response.email );
									$('#mobile_no').val( response.mobile_no );
									$('#message').val( response.message );
								});
						});

				})();

				$(document).on('click', '.btn-save-lead', function() {

					let formData = new FormData(document.querySelector('#form'));

					setKeys()
						.then( () => {
							encrypt(JSON.stringify({
								'name': formData.get('name'),
								'message': formData.get('message'),
								'mobile_no': formData.get('mobile_no'),
								'email': formData.get('email')
							}), publicKey, privateKey)
								.then( data => {

									$('#content').val( data.encrypted );
									$('#iv').val( data.iv );

									$('.btn-save').trigger('click');

								});
						});

				});

				async function setKeys() {
					privateKey = ".json_encode($this->session['message_keys']['privateKey']).";
					publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
				}

				$(document).on('click', '.btn-selected', function() {
					let id = $(this).data('id');
					let name = $(this).data('name');

					$('#lead_group_id').val(id);
					$('.btn-group-selection').text(name);

					$('.btn-close').trigger('click');
				});

				$(document).on('click', '#btn-searchgroup', function(e) {
					searchGroup(e);
				});

				$(document).on('keypress', '#searchgroup', function(e) {
					searchGroup(e);
				});

				function searchGroup(e) {
					
					keyword = $('#searchgroup').val();
					if(keyword != '') {
						if(e.keyCode == 13 || e.which == 13) {
							$('.response-body').html(\"<img src='".CDN."images/loader.gif' /> searching groups \");
							$.get('".url("LeadGroupsController@searchGroup")."?search=' + keyword, function(data) {
								$('.response-body').html(data);
							});
						}
					}

				}

			"));

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();

			if(!is_array($data['preferences'])) {
				$data['preferences'] = $lead->preferences;
			}

			$data['addresses'] = $this->getModel("Address");
			$data['categorySelection'] = $listing->categorySelection($data['preferences']['category']);
			
			$this->setTemplate("leads/edit.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function view($id) {
		
		$this->doc->setTitle("View Leads");
		
		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$lead->where(" account_id = ".$this->account_id);
		$data = $lead->getById();

		$data['user_message'] = $data['content'];

		if($data) {

			$groups = $this->getModel("LeadGroup");
			$groups->column['lead_group_id'] = $data['lead_group_id'];
			$data['groups'] = $groups->getById();

			if($data['groups'] === false) {
				$data['groups'] = [];
				$data['groups']['name'] = "Ungrouped";
			}

			$this->doc->addScript(CDN."js/encryption.js");
			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

				const data = ".json_encode($data).";
				const publicKey = ".json_encode($this->session['message_keys']['publicKey']).";
				const privateKey = ".json_encode($this->session['message_keys']['privateKey']).";
				
				( async => {
					let lead_id = data.lead_id;
					decrypt(data, publicKey, privateKey)
						.then(  response => {
							$(' .name-container').html( response.name );
							$(' .email-container').html( response.email );
							$(' .mobile-number-container').html( response.mobile_no );
							$(' .message-container').html( response.message );
						});
				})();

				$(document).ready(function() {
					loadNotes();
				});

				$(document).on('submit', '#form', function() {
					$('.response').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>\");

					$.get($('#save_url').val(), $('#form').serialize(), function (data, status) {

						let response = JSON.parse(data);
						$('.response').html(response.message);
						$('#content').val('');
						loadNotes();
					});

				});

				$(document).on('click', '.btn-delete-note', function() {
					id = $(this).data('id');

					r = confirm('Are you sure do you want to delte the selected note?');

					if(r === true) {
						$.get('notes/' + id + '/delete', function(data, status) {
							let response = JSON.parse(data);
							$('.response').html(response.message);
							$('.row_'+id).remove();
						});
					}

				});

				$(document).on('click', '.btn-save-note', function() {
					$('#form').submit();
				});

				function loadNotes() {
					$('.notes-wrapper').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>\");
					$.get('".url("LeadNotesController@index", ["lead_id" => $id])."', function(data) {
						$('.notes-wrapper').html(data);
					});
				}

				$(document).on('click', '.btn-add-note', function() {
					let form = $('.note-form');
					$('.btn-add-note-wrapper').remove();
					$('.note-wrapper').html(form.clone());
					$('.note-form-wrapper').html('');
				});

			"));

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();
			
			$this->setTemplate("leads/view.php");
			return $this->getTemplate($data,$lead);
		}

		$this->response(404);
		
	}
	
	function saveNew() {

		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['inquire_at'] = DATE_NOW;
		$_POST['account_id'] = $this->session['account_id'];
		$_POST['listing_id'] = 0;
		$_POST['preferences']['category'] = $_POST['category'];
		$_POST['preferences']['address'] = $_POST['address'];
		$_POST['preferences'] = json_encode($_POST['preferences']);

		$leads = $this->getModel("Lead");
		$response = $leads->saveNew($_POST);

		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));

	}

	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['preferences']['category'] = $_POST['category'];
		$_POST['preferences']['address'] = $_POST['address'];
		$_POST['preferences'] = json_encode($_POST['preferences']);

		$lead = $this->getModel("Lead");
		$response = $lead->save($id,$_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function delete($id) {

		$lead = $this->getModel("Lead");
		$lead->column['lead_id'] = $id;
		$data = $lead->getById();
		
		if($data) {

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				var id = ".$data['lead_id'].";

				var detail = $('.row_leads_' + id + ' .btn-delete').data('content');
				$('.delete-name-container').text( detail.name );
				$('.delete-email-container').text( detail.email );
				$('.delete-mobile-number-container').text( detail.mobile_no );

			"));

			if(isset($_REQUEST['delete'])) {

				$lead->deleteLead($id);

				$this->getLibrary("Factory")->setMsg("Lead permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Lead not found.","warning");
		}

		$this->setTemplate("leads/delete.php");
		return $this->getTemplate($data);

	}
	
}