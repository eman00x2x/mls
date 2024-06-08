<?php

namespace Website\Application\Controller;

class OpenHouseAnnouncementsController extends \Admin\Application\Controller\OpenHouseAnnouncementsController {

    function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."/Website");
    }

    function index($account_id = null) {

        $data['title'] = "Open Houses - " . CONFIG['site_name'];
		$data['description'] = $data['title'];
		$data['image'] = CDN."images/real-estate.jpg";
		
		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("Keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url("OpenHouseAnnouncementsController@index"));
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

        $filters[] = " ended_at > ".DATE_NOW." ";

		$open_house = $this->getModel("OpenHouseAnnouncement");
		
		$open_house->page['limit'] = 20;
		$open_house->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;
		$open_house->page['target'] = url("OpenHouseAnnouncementsController@index");
		$open_house->page['uri'] = (isset($uri) ? $uri : []);

		$open_house->where((isset($filters) ? implode(" AND ",$filters) : null))->orderBy(" DATE(JSON_EXTRACT(content, '$.date')) DESC ");
		$data = $open_house->getList();

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Open House',
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

		$this->setTemplate("openHouse/index.php");
		return $this->getTemplate($data, $open_house);

    }

    function view($id = null) {
        
    }

}