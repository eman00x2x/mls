<?php

namespace Api\V1\Application\Controller;

class ErrorsController extends \Admin\Application\Controller\ErrorsController {

    private static $_instance = null;
		
	public static function getInstance () {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
		
        return self::$_instance;
    }

    function resourceNotFound() {

        response()->httpCode(404);
        echo json_encode([
            "message" => "The requested resource could not be found. Please refer to the documentation",
            "url" => API. "documentation/v1"
        ], JSON_PRETTY_PRINT);
        exit();
        
    }


}