<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

use Library\SessionHandler;
use Library\CsrfVerifier;
use Webadmin\Application\Controller\AuthenticatorController as Authenticator;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request as Request;
use Pecee\Http\Middleware\IMiddleware;

if (extension_loaded('zlib')) { ob_end_clean(); }

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define("AJAX_REQUEST",true);
}else {
	define("AJAX_REQUEST",false);
}

define("BASE",dirname(__FILE__));
define("ACCESS", 1);

require_once("../Includes/define.php");
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

Authenticator::getInstance()->beginSession();

class Middleware implements IMiddleware {

    public function handle(Request $request): void 
    {

		SessionHandler::getInstance()->getUserClient();

		$verifier = new CsrfVerifier();
		$verifier->setIgnore("/transactions/*");

		Router::enableMultiRouteRendering(false);
		Router::csrfVerifier($verifier);

		Router::group(['prefix' => WEB_ADMIN_ALIAS], function () {
			Router::get('/2-step-verification-code', 'AuthenticatorController@getTwoStepVerificationCodeForm');
			Router::get('/resetPassword', 'AuthenticatorController@getResetPasswordForm', ['as' => 'resetPassword']);
			Router::get('/forgotPassword', 'AuthenticatorController@getForgotPasswordForm', ['as' => 'forgotPassword']);

			Router::post('/checkCredentials', 'AuthenticatorController@checkCredentials');
			Router::post('/saveNewPassword', 'AuthenticatorController@saveNewPassword');
			Router::post('/forgotPassword', 'AuthenticatorController@sendPasswordResetLink');
		});

		$request->user = Authenticator::getInstance()->monitor();

		if($request->user['status'] == 0) {
			Router::get(WEB_ADMIN_ALIAS, 'AuthenticatorController@getLoginForm');
			$request->setRewriteUrl(url(""));
			$template = "Templates/login.template.php";
		}else {
			require_once('routes.php');
			$template = "Templates/template.php";
		}

		Router::error(function(Request $request, \Exception $exception) {
			$request->setRewriteCallback('ErrorsController@notFound');
		});

		Router::setDefaultNamespace('\Webadmin\Application\Controller');
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