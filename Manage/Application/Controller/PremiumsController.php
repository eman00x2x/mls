<?php

namespace Manage\Application\Controller;

class PremiumsController extends \Admin\Application\Controller\PremiumsController {

	private $doc;

	function __construct() {
		parent::__construct();
		$this->setTempalteBasePath(ROOT."Manage");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}
	
	function index() {

		if(!PREMIUM) {
			$this->response(404);
		}

        $this->doc->setTitle("Premiums");
        
        $premium = $this->getModel("Premium");
		$premium->where(" visibility = 1 ");
		
		$premium->page['limit'] = 20;
		$premium->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$premium->page['target'] = url("PremiumsController@index");
		$premium->page['uri'] = (isset($uri) ? $uri : []);

		$data = $premium->getList();

		if($data) {
			for($i=0; $i<count($data); $i++) {
				$list[$data[$i]['category']][] = $data[$i];
			}
        }
		
		$data['premiums'] = $list;

		$this->setTemplate("premiums/premiums.php");
		return $this->getTemplate($data,$premium);

	}
	
	
	
}