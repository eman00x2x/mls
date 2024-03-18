<?php

namespace Website\Application\Controller;

class PagesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function about() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->setTemplate("pages/about.php");
		return $this->getTemplate();
	}

	function contact() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['contact_info'] = CONFIG['contact_info'];
		$this->setTemplate("pages/contact.php");
		return $this->getTemplate();
	}

	function articles() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->setTemplate("pages/articles.php");
		return $this->getTemplate();
	}

	function privacy() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$data['data_privacy'] = CONFIG['data_privacy'];
		$this->setTemplate("pages/privacy.php");
		return $this->getTemplate($data);
	}

	function terms() {

		$title = "MLS";
		$description = "MLS";
		$image = "";

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);
		
		$data['terms'] = CONFIG['terms'];

		$this->setTemplate("pages/terms.php");
		return $this->getTemplate($data);
	}

}