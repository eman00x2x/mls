<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

use Api\V1\Application\Controller\AuthenticatorController as Authenticator;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request as Request;
use Pecee\Http\Middleware\IMiddleware;

if (extension_loaded('zlib')) { ob_end_clean(); }

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

define("BASE",dirname(__FILE__));
define("ACCESS", 1);

require_once("../../Includes/define.php");
require_once(ROOT."/Includes/definitions.php");
require_once(ROOT."/Includes/functions.php");
require_once(ROOT."/Vendor/autoload.php");
require_once(ROOT."/Vendor/pecee/simple-router/helpers.php");

function autoloader($class) {
	if (file_exists($file = BASE.'/'.str_replace('\\', '/', $class).'.php')) {
		require_once($file);
	}else if (file_exists($file = ROOT.'/'.str_replace('\\', '/', $class).'.php')) {
		require_once($file);
	}
}

spl_autoload_register('autoloader');

require_once(ROOT."/Includes/config.php");

class Middleware implements IMiddleware {

    public function handle(Request $request): void 
    {

		require_once('routes.php');

		Router::error(function(Request $request, \Exception $exception) {
			$request->setRewriteCallback('ErrorsController@resourceNotFound');
		});

		Router::setDefaultNamespace('\Api\V1\Application\Controller');
		
		try {
			echo Router::start();
		} catch(\Error $e) {
			response()->httpCode(500);
		}

    }
}

$middleWare = new \Middleware();
$middleWare->handle(new Request());

ob_flush();
flush();