<?php

define("BASE",dirname(__FILE__));
define("ACCESS", 1);

require_once("Includes/definitions.php");
require_once("Includes/define.php");
require_once("Includes/functions.php");
require_once("Vendor/autoload.php");
require_once("Vendor/pecee/simple-router/helpers.php");

function autoloader($class) {
	if (file_exists($file = BASE.'/'.str_replace('\\', '/', $class).'.php')) {
		require_once($file);
	}else if (file_exists($file = ROOT.'/'.str_replace('\\', '/', $class).'.php')) {
		require_once($file);
	}
}

spl_autoload_register('autoloader');

require_once("Includes/config.php");

$cron = new \Library\CronJob;
$cron->run();

echo "<p>Cron Successfully ended.</p>";