<?php
defined("ACCESS")or die("Restricted page!");

date_default_timezone_set("Asia/Manila");

define("DATE_NOW",strtotime("Now"));
define("LIST_LIMIT",20);

define("API","http://api.mls/");
define("ADMIN","http://admin.mls/");
define("WEBADMIN","http://webadmin.mls/");
define("CS","http://cs.mls/");
define("MANAGE","http://manage.mls/");
define("WEBDOMAIN","http://mls");
define("CDN","http://cdn.mls/");
define("ALIAS","");

/* define("API","http://192.168.254.250/mls/Api/");
define("ADMIN","http://192.168.254.250/mls/Admin/");
define("MANAGE","http://192.168.254.250/managemls/");
define("WEBDOMAIN","http://192.168.254.250/mls/");
define("CDN","http://192.168.254.250/cdnmls/");

define("ALIAS","managemls"); */

define("VRSN","v1.0");

define("USER_PERMISSIONS",[
	"accounts" => [
		"access" => (boolean) true
	],
    "users" => [
		"access" => (boolean) true,
 		"delete" => (boolean) true
	],
    "leads" => [
		"access" => (boolean) true,
		"delete" => (boolean) true
	],
    "properties" => [
		"access" => (boolean) true,
		"delete" => (boolean) true
	],
    "premiums" => [
		"process_subscription" => (boolean) true
	],
	"transactions" => [
		"access" => (boolean) true
	]
]);

define("CS_PERMISSIONS",[
    "accounts" => [
		"access" => (boolean) true,
 		"edit" => (boolean) true,
 		"delete" => (boolean) true
	],
    "users" => [
		"access" => (boolean) true,
 		"edit" => (boolean) true,
 		"delete" => (boolean) true
	],
    "properties" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
	"premiums" => [
		"process_subscription" => (boolean) true
	],
	"kyc" => [
		"access" => (boolean) true
	]
]);

define("ADMIN_PERMISSIONS",[
    "accounts" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
    "users" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
    "properties" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
	"premiums" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true,
		"process_subscription" => (boolean) true
	],
	"web_settings" => [
		"access" => (boolean) true,
		"edit" => (boolean) true
	],
    "settings" => [
		"access" => (boolean) true,
		"edit" => (boolean) true
	],
    "articles" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
	"kyc" => [
		"access" => (boolean) true
	]
]);

define("WEBADMIN_PERMISSIONS",[
    "web_settings" => [
 		"access" => (boolean) true,
 		"edit" => (boolean) true
	],
    "articles" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	]
]);

define("ACCOUNT_PRIVILEGES",[
    "max_post" => 20,
    "max_users" => 1,
    "mls_access" => 0,
    "chat_access" => 1,
    "display_ads" => 0,
    "featured_ads" => 0,
    "handshake_limit" => 1
]);

define("PREMIUM_SCRIPTS",[
    "max_post" => 20,
    "max_users" => 1,
	"mls_access" => 0,
    "chat_access" => 0,
    "display_ads" => 0,
    "featured_ads" => 0,
	"handshake_limit" => 1
]);
