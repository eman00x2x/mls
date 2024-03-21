<?php

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache');

use Admin\Application\Controller\AuthenticatorController as Authenticator;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request as Request;
use Pecee\Http\Middleware\IMiddleware;

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

Authenticator::getInstance()->beginSession();

class Middleware implements IMiddleware {

    public function handle(Request $request): void 
    {

		Router::router()->reset();
		$request->user = Authenticator::getInstance()->monitor();
		
		$template = "templates/login.template.php";
		
		if(url()->contains("/2-step-verification-code")) {

			Router::get('/2-step-verification-code', 'AuthenticatorController@getTwoStepVerificationCodeFrom');
			
		}else if(url()->contains("/resetPassword")) {

			Router::get('/resetPassword', 'AuthenticatorController@getResetPasswordForm', ['as' => 'resetPassword']);
			Router::post('/resetPassword', 'AuthenticatorController@saveNewPassword');
			
		} else if(url()->contains("/forgotPassword")) {

			Router::get('/forgotPassword', 'AuthenticatorController@getForgotPasswordForm', ['as' => 'forgotPassword']);
			Router::post('/forgotPassword', 'AuthenticatorController@sendPasswordResetLink');

		}else {
		
			if($request->user['status'] == 0) {

				Router::request()->setRewriteUrl(url('/'));

				Router::get('/', 'AuthenticatorController@getLoginForm');
				Router::post('/', 'AuthenticatorController@getLoginForm');

				
			}else {
				require_once('routes.php');
				$template = "templates/template.php";
			}

		}

		Router::error(function(Request $request, \Exception $exception) {
			$request->setRewriteCallback('ErrorsController@notFound');
		});

		Router::setDefaultNamespace('\Admin\Application\Controller');
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