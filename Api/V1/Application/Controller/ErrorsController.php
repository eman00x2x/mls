<?php

namespace Api\Application\Controller;

class ErrorsController extends \Admin\Application\Controller\ErrorsController {

    function resourceNotFound() {
        $this->getLibrary("HttpHeaders")->setHeaderStatus(404);
        return json_encode([
            "message" => "The requested resource could not be found. Please refer to the documentation",
            "url" => API. "documentation/v1"
        ]);
    }


}