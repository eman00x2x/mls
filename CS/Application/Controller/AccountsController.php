<?php

namespace CS\Application\Controller;

class AccountsController extends \Admin\Application\Controller\AccountsController {

    function __construct() {
        parent::__construct();
		$this->setTempalteBasePath(ROOT."Admin");
	}
	
	function index() {

        $this->doc->setTitle("Accounts");
		
		if(isset($_REQUEST['search'])) {
			$filters[] = " (account_name LIKE '%".$_REQUEST['search']."%')";
			$uri['search'] = $_REQUEST['search'];
		}

        $filters[] = " account_type NOT IN('Administrator', 'Web Admin', 'Customer Service')";
		
		if(isset($filters)) {
			$clause[] = implode(" AND ",$filters);
		}
		
		$accounts = $this->getModel("Account");
		$accounts
		    ->where(isset($clause) ? implode(" ",$clause) : null)
		        ->orderBy(" registration_date DESC ");

		$accounts->page['limit'] = 20;
		$accounts->page['current'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$accounts->page['target'] = url("AccountsController@index");
		$accounts->page['uri'] = (isset($uri) ? $uri : []);

		$data = $accounts->getList();

		$this->setTemplate("accounts/accountList.php");
		return $this->getTemplate($data,$accounts);

    }

}