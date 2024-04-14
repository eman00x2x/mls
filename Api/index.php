<?php

header('Content-Type: application/json; charset=utf-8');
header('HTTP/1.0 404 Not Found');

define("BASE",dirname(__FILE__));
define("ACCESS", 1);

require_once("../Includes/define.php");

echo json_encode([
    "message" => "The requested resource could not be found. Please refer to the documentation",
    "url" => API. "documentation"
], JSON_PRETTY_PRINT);

exit();