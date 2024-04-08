<?php

header('Content-Type: application/json; charset=utf-8');
header('HTTP/1.0 404 Not Found');

define("ROOT","D:/wamp64/www/mls/");
define("BASE",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define("ACCESS", 1);

require_once(ROOT."/Includes/define.php");

echo json_encode([
    "message" => "The requested resource could not be found. Please refer to the documentation",
    "url" => API. "documentation"
], JSON_PRETTY_PRINT);

exit();