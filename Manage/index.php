<?php

use Library\SessionHandler;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request as Request;
use Pecee\Http\Middleware\IMiddleware;
use Manage\Application\Controller\LoginController as Login;

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define("AJAX_REQUEST",true);
}else {
	define("AJAX_REQUEST",false);
}

define("ROOT","D:/wamp64/www/mls/");
define("BASE",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define("ACCESS", 1);

require_once(ROOT."/Includes/definitions.php");
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

SessionHandler::getInstance()->begin();

class Middleware implements IMiddleware {

    public function handle(Request $request): void 
    {

		$request->user = SessionHandler::getInstance()->check();
		Router::router()->reset();

		$template = "templates/login.template.php";

		if(url()->contains("/2-step-verification-code")) {
			Router::get('/2-step-verification-code', 'LoginController@twoStepVerificationCode');
		}else if(url()->contains("/register")) {

			Router::get('/register', 'RegistrationController@register');
			Router::post('/register', 'RegistrationController@register');
			Router::post('/registerAccount', 'RegistrationController@registerAccount');
			Router::post('/registerAccountSave', 'RegistrationController@saveNew');
			
		}else if(url()->contains("/resetPassword")) {

			Router::get('/resetPassword', 'LoginController@resetPassword', ['as' => 'resetPassword']);
			Router::post('/resetPassword', 'LoginController@saveNewPassword');
			
		} else if(url()->contains("/forgotPassword")) {

			Router::get('/forgotPassword', 'LoginController@forgotPassword', ['as' => 'forgotPassword']);
			Router::post('/forgotPassword', 'LoginController@sendPasswordResetLink');

		}else {
		
			if($request->user == "") {

				Router::request()->setMethod('get');
				Router::request()->setRewriteUrl(url('/'));

				Router::get('/', 'LoginController@login');
				Router::post('/', 'LoginController@login');

			}else {
				require_once('routes.php');
				$template = "templates/template.php";
			}

		}

		Router::error(function(Request $request, \Exception $exception) {
			$request->setRewriteCallback('ErrorsController@notFound');
		});

		Router::setDefaultNamespace('\Manage\Application\Controller');
		$content = Router::start();

		if(AJAX_REQUEST === true) {
			echo $content;
		}else {
			require_once($template);
		}

    }
}

$middleWare = new \Middleware();
$middleWare->handle(new Request());

ob_flush();
flush();