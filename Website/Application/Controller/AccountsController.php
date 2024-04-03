<?php

namespace Website\Application\Controller;

class AccountsController extends \Main\Controller {

    private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

    function profile($id, $name) {

        $accounts = $this->getModel("Account");
		$accounts->column['account_id'] = $id;
		$data = $accounts->getById();

        $name = $data['account_name']['prefix']." ".$data['account_name']['firstname']." ".$data['account_name']['lastname']." ".$data['account_name']['suffix'];
        $description = $name." - " . nicetrim($data['profile']['about_me'], 120) . " - " . CONFIG["site_name"];

        $this->doc->setTitle($name." Profile - ". CONFIG["site_name"]);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("Keywords", $description);

		$this->doc->setFacebookMetaData("og:url", WEBDOMAIN.url("AccountsController@profile", ["id" => $data['account_id'], "name" => sanitize($data['account_name']['firstname']."-".$data['account_name']['lastname']) ] ));
		$this->doc->setFacebookMetaData("og:title", $name." Profile - ". CONFIG["site_name"]);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->setTemplate("accounts/profile.php");
		return $this->getTemplate($data);

    }

}