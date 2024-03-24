<?php

namespace Website\Application\Controller;

class PagesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function about() {

		$data['title'] = "About ".CONFIG['site_name'];
		$data['description]'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description]']);
		$this->doc->setMetaData("keywords", $data['description]']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $data['description]']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['about'] = CONFIG['about'];
		$this->setTemplate("pages/about.php");
		return $this->getTemplate($data);
	}

	function contact() {

		$data['title'] = "Contact ".CONFIG['site_name'];
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['contact_info'] = CONFIG['contact_info'];
		$this->setTemplate("pages/contact.php");
		return $this->getTemplate($data);
	}

	function articles() {

		$data['title'] = "MLS";
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->setTemplate("pages/articles.php");
		return $this->getTemplate();
	}

	function privacy() {

		$data['title'] = "Data Privacy";
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['data_privacy'] = CONFIG['data_privacy'];
		$this->setTemplate("pages/privacy.php");
		return $this->getTemplate($data);
	}

	function terms() {

		$data['title'] = "Terms and Conditions";
		$data['description'] = "MLS";
		$data['image'] = "";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);
		
		$data['terms'] = CONFIG['terms'];

		$this->setTemplate("pages/terms.php");
		return $this->getTemplate($data);
	}

}