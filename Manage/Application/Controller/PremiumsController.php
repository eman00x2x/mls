<?php

namespace Manage\Application\Controller;

class PremiumsController extends \Admin\Application\Controller\PremiumsController {

	function __construct() {
		parent::__construct();
		$this->setTempalteBasePath(ROOT."Manage");
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

				if($data[$i]['category'] == "package") {
					$package_id[] = $data[$i]['premium_id'];
				}
					
			}
        }
		
		$data['premiums'] = $list;

		$subscription = $this->getModel("AccountSubscription");
		$subscription->join(" s JOIN #__premiums p ON p.premium_id = s.premium_id JOIN #__transactions t ON t.transaction_id = s.transaction_id");
		$subscription->where(" s.premium_id IN(".implode(",", $package_id).") ");
		$subscription->and(" s.account_id = ".$this->session['account_id']);
		$data['subscription'] = $subscription->getList();

		$this->setTemplate("premiums/premiums.php");
		return $this->getTemplate($data,$premium);

	}
	
	
	
}