<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request as Request;
use Pecee\Http\Middleware\IMiddleware;

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

define("ROOT","D:/wamp64/www/mls/");
define("BASE",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define("ACCESS", 1);

require_once(ROOT."/Includes/define.php");
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

		Router::router()->reset();
		Router::enableMultiRouteRendering(false);

		Router::group(['prefix' => API_DOCS_ALIAS], function () {
			
			Router::get("/", "ApiV1Controller@docs");
		
			Router::error(function(Request $request, \Exception $exception) {
				$request->setRewriteCallback('ErrorsController@notFound');
			});

		});

		Router::setDefaultNamespace('\Api\Documentation\Application\Controller');
		$content = Router::start();
		require_once(BASE."/Templates/template.php");
		
    }
	
}

$middleWare = new \Middleware();
$middleWare->handle(new Request());

ob_flush();
flush();