<?php

namespace Webadmin\Application\Controller;

class UsersController extends \Admin\Application\Controller\UsersController {
    
    private $account_id;

    function __construct() {

        parent::__construct();
		$this->account_id = $this->session['account_id'];

    }

    function changePassword($id = null, $account_id = null) {
		return parent::changePassword($this->session['user_id'], $this->account_id);
	}

}