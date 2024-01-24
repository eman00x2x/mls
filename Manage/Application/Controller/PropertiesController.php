<?php

namespace Manage\Application\Controller;

class PropertiesController extends \Main\Controller {
	
	private $account_id;
	
	function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
		$this->account_id = $_SESSION['account_id'];
	}
	
	function index() {

        $this->doc->setTitle("MLS Service");

		if(isset($_REQUEST['search'])) {
			$filters[] = " (title LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

		#$filters[] = " account_id != ".$this->account_id;
		
		$listing = $this->getModel("Listing");
		$listing->where((isset($filters) ? implode(" AND ",$filters) : null))->orderby(" last_modified DESC ");
		
		$listing->page['limit'] = 20;
		$listing->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$listing->page['target'] = url("ListingsController@index");
		$listing->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['listings'] = $listing->getList();

		$this->setTemplate("properties/list.php");
		return $this->getTemplate($data,$listing);

	}

    function handshakes() {

        

    }
	
	
}