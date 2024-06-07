<?php

namespace Manage\Application\Controller;

class OpenHouseAnnouncementsController extends \Admin\Application\Controller\OpenHouseAnnouncementsController {

    function __construct() {
        parent::__construct();
        $this->account_id = $this->session['account_id'];
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