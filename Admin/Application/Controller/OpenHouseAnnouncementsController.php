<?php

namespace Admin\Application\Controller;

class OpenHouseAnnouncementsController extends \Main\Controller {
	
	public $doc;
	public $session;
	public $account_id;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->session = $this->getLibrary("SessionHandler")->get("user_logged");
	}

	function index($account_id = null) {

		$this->doc->setTitle("Open House Announcements");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (subject LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		if(!is_null($account_id)) {
			$filters[] = " account_id = $account_id ";
		}

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" created_at DESC ");
		
		$open_house->page['limit'] = 20;
		$open_house->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$open_house->page['target'] = url("OpenHouseAnnouncementsController@index");
		$open_house->page['uri'] = (isset($uri) ? $uri : []);
		
		$data = $open_house->getList();

		if($data) {
			$account = $this->getModel("Account");
			
			for($i=0; $i<count($data); $i++) {
				$account->column['account_id'] = $data[$i]['account_id'];
				$account_data = $account->getById();

				$data[$i] = array_merge($data[$i], $account_data);
			}
		}

		$this->setTemplate("openHouse/open_house.php");
		return $this->getTemplate($data, $open_house);
		
	}

	function add($account_id = 0) {

		if(in_array($this->session['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
			$this->getLibrary("Factory")->setMsg("Administrator cannot create open house announcement", "warning");
			response()->redirect(url("OpenHouseAnnouncementsController@index"));
		}
		
		$this->doc->setTitle("New Open House Announcements");

		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				$('#offcanvasEnd').on('shown.bs.offcanvas', function() {
					$.get('".url("OpenHouseAnnouncementsController@searchListings")."', function(data) {
						$('#offcanvasEnd').html(data);
					});
				});
			});

			$(document).on('click', '.selected', function() {
				listing_id = $(this).data('id');
				title = $(this).data('title');
				attachment = $(this).data('thumb-image');
				
				$('#listing_id').val(listing_id);
				$('#listing_title').val(title);
				$('#attachment').val(attachment);
				$('.listing-selection').text(title);

				$('#offcanvasEnd .btn-close').trigger('click');
			});
		");

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->column['account_id'] = $account_id;
		$open_house->select(" COUNT(announcement_id) as total_announcement ");
		$data = $open_house->getByAccountId();

		if($data['total_announcement'] >= $this->session['privileges']['max_open_house_announcement']) {
			$this->getLibrary("Factory")->setMsg("Max open house announcement has been reached","warning");
			response()->redirect(url("OpenHouseAnnouncementsController@index"));
		}

		$this->setTemplate("openHouse/add.php");
		return $this->getTemplate(null, $open_house);
		
		$this->response(404);
		
	}
	
	function edit($id) {

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->column['announcement_id'] = $id;
		$data = $open_house->getById();

		$account_id = null;
		if(in_array($this->session['account_type'], ["Administrator", "Customer Service", "Web Admin"])) {
			$account = $this->getModel("Account");
			$account->column['account_id'] = $data['account_id'];
			$data['account'] = $account->getById();

			$account_id = $data['account_id'];
		}

		$this->doc->setTitle("Update Open House Announcement");

		$this->doc->addScriptDeclaration("
			$(document).ready(function() {
				$('#offcanvasEnd').on('shown.bs.offcanvas', function() {
					$.get('".url("OpenHouseAnnouncementsController@searchListings", ["account_id" => $account_id])."', function(data) {
						$('#offcanvasEnd').html(data);
					});
				});
			});

			$(document).on('click', '.selected', function() {
				listing_id = $(this).data('id');
				title = $(this).data('title');
				attachment = $(this).data('thumb-image');
				
				$('#listing_id').val(listing_id);
				$('#listing_title').val(title);
				$('#attachment').val(attachment);
				$('.listing-selection').text(title);

				$('#offcanvasEnd .btn-close').trigger('click');
			});
		");

		if($data) {

			$this->setTemplate("openHouse/edit.php");
			return $this->getTemplate($data, $open_house);
		}

		$this->response(404);
		
	}

	function searchListings($account_id = null) {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 1000;
		
		if(!is_null($account_id)) {
			$listings->column['account_id'] = $account_id;
		}

		$listings->and(" status = 1 ");
		$data = $listings->getByAccountId();

		$this->setTemplate("openHouse/searchListings.php");
		return $this->getTemplate($data, $listings);

	}

	function saveNew($account_id = 0) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		$_POST['account_id'] = $account_id;
		$_POST['created_at'] = DATE_NOW;
		$_POST['status'] = 1;
		$_POST['started_at'] = strtotime($_POST['started_at']);
		$_POST['ended_at'] = strtotime("+8 days", $_POST['started_at']);

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$response = $open_house->saveNew($_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function saveUpdate($id) {
		
		parse_str(file_get_contents('php://input'), $_POST);

		if(isset($_POST['ended_at'])) {
			$_POST['ended_at'] = strtotime($_POST['ended_at']);
		}

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->column['announcement_id'] = $id;
		$data = $open_house->getById();

		$response = $open_house->save($id, $_POST);
		
		$this->getLibrary("Factory")->setMsg($response['message'],$response['type']);

		return json_encode(array(
			"status" => $response['status'],
			"message" => getMsg()
		));
		
	}
	
	function delete($id) {

		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->column['announcement_id'] = $id;
		$data = $open_house->getById();
		
		if($data) {

			if(isset($_REQUEST['delete'])) {

				$open_house->deleteOpenHouseAnnouncement($id);
				
				$this->getLibrary("Factory")->setMsg("Open House Announcement permanently deleted!","success");
				return json_encode(
					array(
						"status" => 1,
						"message" => getMsg()
					)
				);

			}

		}else {
			$this->getLibrary("Factory")->setMsg("Open House Announcement not found.","warning");
		}

		$this->setTemplate("openHouse/delete.php");
		return $this->getTemplate($data);

	}

}