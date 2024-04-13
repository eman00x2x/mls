<?php
defined("ACCESS")or die("Restricted page!");

date_default_timezone_set("Asia/Manila");

define("DATE_NOW",strtotime("Now"));
define("LIST_LIMIT",20);
define("DEVELOPMENT", true);

define("WEBSOCKET_SERVER_ADDRESS", "ws://localhost:8980/mls/Manage/webSocketServer.php");

/* 
define("API","http://api.mls/");
define("WEBADMIN","http://webadmin.mls/");
define("CS","http://cs.mls/");
define("WEBDOMAIN","http://mls/");
define("ADMIN","http://admin.mls/");
define("MANAGE","http://manage.mls/");
define("CDN","http://cdn.mls/");

 */

if(DEVELOPMENT) {

	define("API_DOCS_ALIAS","/mls/api/documentation");
	define("API_ALIAS","/mls/api");
	define("ADMIN_ALIAS","/mls/admin");
	define("WEB_ADMIN_ALIAS","/mls/webadmin");
	define("MANAGE_ALIAS","/mls/manage");
	define("WEB_ALIAS","/mls/website");
	define("CS_ALIAS","/mls/cs");

}else {

	define("API_DOCS_ALIAS","");
	define("API_ALIAS","");
	define("ADMIN_ALIAS","");
	define("WEB_ADMIN_ALIAS","");
	define("MANAGE_ALIAS","");
	define("WEB_ALIAS","");
	define("CS_ALIAS","");

}

define("API",	"http://localhost/mls/api/");
define("API_V1",	"http://localhost/mls/api/v1");
define("CDN",		"http://localhost/mls/cdn/");
define("WEBDOMAIN",	"http://localhost/mls/website/");
define("WEBADMIN",	"http://localhost/mls/webadmin/");
define("CS",		"http://localhost/mls/cs/");
define("ADMIN",		"http://localhost/mls/admin/");
define("MANAGE",	"http://localhost/mls/manage/");

/* define("API",		"http://192.168.254.250/mls/api/");
define("API_V1",	"http://localhost/mls/api/v1");
define("CDN",		"http://192.168.254.250/mls/cdn/");
define("WEBDOMAIN",	"http://192.168.254.250/mls/website/");
define("WEBADMIN",	"http://192.168.254.250/mls/webadmin/");
define("CS",		"http://192.168.254.250/mls/cs/");
define("ADMIN",		"http://192.168.254.250/mls/admin/");
define("MANAGE",	"http://192.168.254.250/mls/manage/"); */

define("VRSN","v1.0");

define("LOCAL_BOARDS", [
	"PRB PASIG REAL ESTATE BOARD INC",
	"PMRB PASAY-MAKATI REALTY BOARD INC",
	"MCRB MANDALUYONG CITY REAL ESTATE BOARD INC",
	"QCRB QUEZON CITY REAL ESTATE BOARD INC",
	"ACREB ANTIPOLO CITY REAL ESTATE BOARD INC"
]);

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
	"kyc" => [
		"access" => (boolean) true
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
 		"delete" => (boolean) true
	],
    "users" => [
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
	],
	"kyc" => [
		"access" => (boolean) true
	]
]);

define("ADMIN_PERMISSIONS",[
    "accounts" => [
		"access" => (boolean) true,
		"add" => (boolean) true,
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
		"access" => (boolean) true
	],
    "settings" => [
		"access" => (boolean) true
	],
    "articles" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
	"kyc" => [
		"access" => (boolean) true
	],
	"page_ads" => [
		"access" => (boolean) true
	],
	"leads" => [
		"access" => (boolean) true,
		"delete" => (boolean) true
	],
	"transactions" => [
		"access" => (boolean) true
	],
	"reports" => [
		"access" => (boolean) true,
		"subscriber" => (boolean) true,
		"monthly_transaction" => (boolean) true
	]
]);

define("WEBADMIN_PERMISSIONS",[
    "web_settings" => [
 		"access" => (boolean) true
	],
    "articles" => [
		"access" => (boolean) true,
		"edit" => (boolean) true,
		"delete" => (boolean) true
	],
	"page_ads" => [
		"access" => (boolean) true
	]
]);

define("ACCOUNT_PRIVILEGES",[
    "max_post" => (int) 20,
    "max_users" => (int) 1,
    "mls_access" => (int) 0,
    "chat_access" => (int) 1,
    "featured_ads" => (int) 0,
    "handshake_limit" => (int) 1,
	"comparative_analysis_access" => (int) 0
]);

define("PREMIUM_SCRIPTS",[
    "max_post" => 20,
    "max_users" => 1,
	"mls_access" => 0,
    "chat_access" => 0,
    /* "display_ads" => 0, */
    "featured_ads" => 0,
	"handshake_limit" => 1,
	"comparative_analysis_access" => 0
]);
