<?php

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

$server = new WebSocket\Server(ssl: false, port: 5465);
$server
    // Add standard middlewares
    ->addMiddleware(new WebSocket\Middleware\CloseHandler())
    ->addMiddleware(new WebSocket\Middleware\PingResponder())
    // Listen to incoming Text messages
    ->onText(function (WebSocket\Server $server, WebSocket\Connection $connection, WebSocket\Message\Message $message) {
        // Act on incoming message
        echo "Got message: {$message->getContent()} \n";
        
        // Possibly respond to all client
        $server->send(new WebSocket\Message\Text("{$message->getContent()}"));
    })
    ->start();

ob_flush();
flush();