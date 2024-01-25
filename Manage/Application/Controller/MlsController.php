<?php

namespace Manage\Application\Controller;

class MlsController extends \Admin\Application\Controller\ListingsController {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['account_id'];
	}
	
	function MLSIndex() {

        $this->doc->setTitle("MLS System");

		$filters[] = " status = 1 ";

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		if(isset($_REQUEST['foreclosure'])) {
			$filters[] = " foreclosed = 1 ";
			$uri['foreclosure'] = 1;
		}

		if(isset($_REQUEST['offer'])) {
			$filters[] = " (offer LIKE '%".$_REQUEST['offer']."%')";
			$uri['offer'] = $_REQUEST['offer'];
		}

		if(isset($_REQUEST['type'])) {
			$filters[] = " (type LIKE '%".$_REQUEST['type']."%')";
			$uri['type'] = $_REQUEST['type'];
		}

		if(isset($_REQUEST['bedroom']) && $_REQUEST['bedroom'] != "") {
			$filters[] = " (bedroom = '".$_REQUEST['bedroom']."')";
			$uri['bedroom'] = $_REQUEST['bedroom'];
		}

		if(isset($_REQUEST['bathroom']) && $_REQUEST['bathroom'] != "") {
			$filters[] = " (bathroom = '".$_REQUEST['bathroom']."')";
			$uri['bathroom'] = $_REQUEST['bathroom'];
		}

		if(isset($_REQUEST['parking']) && $_REQUEST['parking'] != "") {
			$filters[] = " (parking = '".$_REQUEST['parking']."')";
			$uri['parking'] = $_REQUEST['parking'];
		}

		$listing = $this->getModel("Listing");
		$listing->addresses = $this->getModel("Address");
		$listing->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" last_modified DESC ");
		
		$listing->page['limit'] = 20;
		$listing->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listing->page['target'] = url("MlsController@index");
		$listing->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['listings'] = $listing->getList();

		if($data['listings']) {

			$account = $this->getModel("Account");

			for($i=0; $i<count($data['listings']); $i++) {
				
				$account->column['account_id'] = $data['listings'][$i]['account_id'];
				$data['listings'][$i]['account'] = $account->getById();

				unset($data['listings'][$i]['account_id']);

			}

		}

		$this->setTemplate("mls/list.php");
		return $this->getTemplate($data,$listing);

	}

	function viewListing($id) {
		return parent::view($id);
	}

    function handshakes() {

        

    }
	
	
}