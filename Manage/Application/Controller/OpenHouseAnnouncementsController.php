<?php

namespace Manage\Application\Controller;

class OpenHouseAnnouncementsController extends \Admin\Application\Controller\OpenHouseAnnouncementsController {

    function __construct() {
        parent::__construct();
        $this->account_id = $this->session['account_id'];

        if(DATE_NOW > strtotime("2024-12-31")) {
            if(!isset($this->session['privileges']['max_open_house_announcement']) || $this->session['privileges']['max_open_house_announcement'] == 0) {
                $this->getLibrary("Factory")->setMsg("You do not have enough privileges to access open house announcement","warning");
                response()->redirect(url("DashboardController@index"));
            }
        }
        
    }

    function index($account_id = null) {
        return parent::index($this->account_id);
    }

    function searchListings($account_id = null) {
        return parent::searchListings($this->account_id);
    }

    function saveNew($account_id = null) {
        return parent::saveNew($this->account_id);
    }

}