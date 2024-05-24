<?php

namespace Api\Documentation\Application\Controller;

class ApiV1Controller extends \Main\Controller {

    public $doc;

    function __construct() {
        $this->setTempalteBasePath(ROOT."/Api/Documentation");
        $this->doc = $this->getLibrary("Factory")->getDocument();
    }

    function docs() {

        $title = CONFIG['site_name'] . " API Documentation";

        $this->doc->setTitle($title);

        $this->doc->setDescription($title);
		$this->doc->setMetaData("Keywords", $title);

		$this->doc->setFacebookMetaData("og:url", "https://account.mlspareb.com/Api/Documentation");
		$this->doc->setFacebookMetaData("og:title", $title);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", CDN."images/real-estate.jpg");
		$this->doc->setFacebookMetaData("og:description", $description);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

        $this->doc->addScriptDeclaration("
            $(document).ready(function() {
                $('.menu').clone().appendTo('.offcanvas-body');

                $('.menu a').click(function() {
                    $('.offcanvas .btn-close').trigger('click');
                });
            });
        ");

        $this->setTemplate("v1/documentation.php");
        return $this->getTemplate();
    }

}