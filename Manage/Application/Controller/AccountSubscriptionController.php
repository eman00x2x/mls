<?php

namespace Manage\Application\Controller;

class AccountSubscriptionController extends \Admin\Application\Controller\AccountSubscriptionController {
	
	function __construct() {
		parent::__construct();
        $this->setTempalteBasePath(ROOT."Manage");
		$this->account_id = $this->session['account_id'];
	}
	
	function index() {

		if(!PREMIUM) {
			$this->response(404);
		}
		
        $this->doc->setTitle("Account Subscriptions");

        $account = $this->getModel("Account");
		$account->column['account_id'] = $this->account_id;
		$data = $account->getById();
	
		$filters[] = " s.account_id = ".$this->account_id;
		
		$subscription = $this->getModel("AccountSubscription");
        $subscription
        ->join(" s JOIN #__premiums p ON s.premium_id = p.premium_id ")
		->where((isset($filters) ? implode(" AND ",$filters) : null))
        ->orderby(" subscription_date DESC ");
		
		$subscription->page['limit'] = 20;
		$subscription->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$subscription->page['target'] = url("SubscriptionsController@index");
		$subscription->page['uri'] = (isset($uri) ? $uri : []);
		
		$data['subscriptions'] = $subscription->getList();

		$this->setTemplate("subscriptions/subscriptions.php");
		return $this->getTemplate($data,$subscription);

	}

}