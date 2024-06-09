<?php

namespace Website\Application\Controller;

class SitemapsController extends \Main\Controller
{
    function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
	}

    function sitemap() {

        $data['pages'] = [
            "buy", "rent", "members", "about", "contact", "terms", "data-privacy"
        ];

        $listings = $this->getModel("Listing");
        $listings->page['limit'] = 99999;
        $data['listings'] = $listings->where(" status = 1 AND display = 1 AND is_website = 1 ")->orderby(" modified_at DESC ")->getList();

        $accounts = $this->getModel("Account");
        $accounts->page['limit'] = 99999;
        $data['accounts'] = $accounts->where(" status = 'active' ")->getList();

        $articles = $this->getModel("Article");
        $articles->page['limit'] = 99999;
        $data['articles'] = $articles->where(" publish = 1 ")->getList();

        $open_house = $this->getModel("OpenHouseAnnouncement");
        $open_house->page['limit'] = 99999;
        $data['open_house'] = $open_house->where(" ended_at < ".DATE_NOW." ")->getList();

        $this->setTemplate("sitemap/sitemap.php");
		echo $this->getTemplate($data);
        exit();

    }

}