<?php

namespace Website\Application\Controller;

class PagesController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function about() {

		$data['title'] = "About ".CONFIG['site_name'];
		$data['description]'] = "PAREB Network proudly spearheads the Philippine real estate arena, commanding a robust presence through its 68 Local Member Boards. With a collective force of 5,000 skilled practitioners, PAREB Network stands as a cornerstone of excellence and integrity in the industry, driving forward innovation and shaping the future landscape of real estate across the nation";
		$data['image'] = CDN."images/real-estate.jpg";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description]']);
		$this->doc->setMetaData("keywords", $data['description]']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description]']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'About',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});
		"));

		$data['about'] = CONFIG['about'];
		$this->setTemplate("pages/about.php");
		return $this->getTemplate($data);
	}

	function contact() {

		$data['title'] = "Contact ".CONFIG['site_name'];
		$data['description'] = CONFIG['contact_info']['contact_page_text'];
		$data['image'] = CDN."images/real-estate.jpg";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Contact',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});
		"));

		$data['contact_info'] = CONFIG['contact_info'];
		$this->setTemplate("pages/contact.php");
		return $this->getTemplate($data);
	}

	function privacy() {

		$data['title'] = "Data Privacy - " . CONFIG['site_name'];
		$data['description'] = "This Privacy Policy aims to provide information on how we collect, use, manage, and secure your personal information. Any information you provide to us indicates your express consent to our Privacy Policy.";
		$data['image'] = CDN."images/pareb-privacy.jpg";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Data Privacy',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});
		"));

		$data['data_privacy'] = CONFIG['data_privacy'];
		$this->setTemplate("pages/privacy.php");
		return $this->getTemplate($data);
	}

	function terms() {

		$data['title'] = "Terms and Conditions - " . CONFIG['site_name'];
		$data['description'] = "By using the Website, you are indicating your acceptance to be bound by these terms and conditions. The Website may revise these terms and conditions at any time by updating this page. You should visit this page periodically to review the terms and conditions, to which you are bound.";
		$data['image'] = CDN."images/pareb-mls-terms.jpg";

		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url());
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);
		
		$data['terms'] = CONFIG['terms'];

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Terms and Conditions',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});
		"));

		$this->setTemplate("pages/terms.php");
		return $this->getTemplate($data);
	}

}