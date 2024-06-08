<?php

defined("ACCESS")or die("Restricted page!");

date_default_timezone_set("Asia/Manila");

define("DATE_NOW",strtotime("Now"));
define("LIST_LIMIT",20);
define("DEVELOPMENT", true);

define("ROOT","D:/wamp64/www/mls");
define("DS",DIRECTORY_SEPARATOR);

define("SESSION_SAVE_PATH", ROOT."/sessions");

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

	define("API_DOCS_ALIAS","/mls/Api/Documentation");
	define("API_ALIAS","/mls/Api");
	define("ADMIN_ALIAS","/mls/Admin");
	define("WEB_ADMIN_ALIAS","/mls/Webadmin");
	define("MANAGE_ALIAS","/mls/Manage");
	define("WEB_ALIAS","/mls/Website");
	define("CS_ALIAS","/mls/CS");

}else {

	define("API_DOCS_ALIAS","");
	define("API_ALIAS","");
	define("ADMIN_ALIAS","");
	define("WEB_ADMIN_ALIAS","");
	define("MANAGE_ALIAS","");
	define("WEB_ALIAS","");
	define("CS_ALIAS","");

}

define("DOMAIN",	"http://localhost");
define("API",		"http://localhost/mls/Api/");
define("API_DOCS",	"http://localhost/mls/Api/Documentation/");
define("API_V1",	"http://localhost/mls/Api/V1/");
define("CDN",		"http://localhost/mls/Cdn/");
define("WEBDOMAIN",	"http://localhost/mls/Website/");
define("WEBADMIN",	"http://localhost/mls/Webadmin/");
define("CS",		"http://localhost/mls/CS/");
define("ADMIN",		"http://localhost/mls/Admin/");
define("MANAGE",	"http://localhost/mls/Manage/");

/* define("API",	"http://192.168.254.250/mls/api/");
define("API_V1",	"http://localhost/mls/api/v1");
define("CDN",		"http://192.168.254.250/mls/cdn/");
define("WEBDOMAIN",	"http://192.168.254.250/mls/website/");
define("WEBADMIN",	"http://192.168.254.250/mls/webadmin/");
define("CS",		"http://192.168.254.250/mls/cs/");
define("ADMIN",		"http://192.168.254.250/mls/admin/");
define("MANAGE",	"http://192.168.254.250/mls/manage/"); */

define("VRSN","v1.0");

define("LOCAL_BOARDS", [
	"NCR" => [
		"CAMANAVA - CALOOCAN MALABON NAVOTAS VALENZUELA REAL ESTATE BOARD",
		"CTREB - CITY OF TAGUIG REAL ESTATE BOARD",
		"LPCREB - LAS PI\u00d1AS CITY REAL ESTATE BOARD",
		"MANDAREB - MANDALUYONG CITY REALTORS BOARD",
		"MBR - MANILA BOARD OF REALTORS",
		"MVRB - MARIKINA VALLEY REALTORS BOARD",
		"MUNREB - MUNTINLUPA REAL ESTATE BOARD",
		"PLAREB - PARA\u00d1AQUE-LAS PI\u00d1AS ALABANG REAL ESTATE BOARD",
		"PMRB - PASAY MAKATI REALTY BOARD",
		"PRB - PASIG REAL ESTATE BOARD",
		"PATREB - PATEROS REALTY BOARD, INC.",
		"QCRB - QUEZON CITY REAL ESTATE BOARDS",
		"SJRB - SAN JUAN REAL ESTATE BOARD"
	],
	"NORTH_LUZON" => [
		"BRB - BULACAN REAL ESTATE BOARD",
		"CSFPREB - CITY OF SAN FERNANDO PAMPANGA REAL ESTATE BOARD",
		"INREB - ILOCOS NORTE REAL ESTATE BOARD",
		"MAREB - METRO ANGELES REAL ESTATE BOARD",
		"MBRB - METRO BAGUIO REALTORS BOARD",
		"MPREB - METRO PANGASINAN REAL ESTATE BOARD",
		"RBSC - SANTIAGO CITY REALTORS BOARD",
		"TCRB - TARLAC CITY REALTORS BOARD"
	],
	"SOUTH_LUZON" => [
		"ACRB - ANTIPOLO CITY REAL ESTATE BOARD, INC.",
		"BCREBA - BATANGAS CITY REAL ESTATE BOARD",
		"CRB - CAINTA REALTORS BOARD",
		"CLRB - CALAMBA LAGUNA REAL ESTATE BOARD",
		"CCRB - CAVITE CITY REALTORS BOARD",
		"CIREB - CITY OF IMUS REAL ESTATE BOARD",
		"DASMAREB - DASMARI\u00d1AS REAL ESTATE BOARD",
		"RBLC - REAL ESTATE BOARD OF LIPA CITY, INC.",
		"LCQBRI - LUCENA CITY QUEZON REALTORS BOARD",
		"NCRB - NAGA CITY (CAMSUR) REALTORS BOARD, INC.",
		"PALREB - PALAWAN REALTORS BOARD, INC,",
		"RBR - REAL ESTATE BOARD OF RIZAL",
		"SPCRB - SAN PABLO CITY REALTORS"
	],
	"VISAYAS" => [
		"BOREB - BOHOL REAL ESTATE BOARD, INC.",
		"CEREB - CEBU REAL ESTATE BOARD",
		"CENOREB - CEBU NORTH REAL ESTATE BOARD, INC.",
		"CESOREB - CEBU SOUTH REAL ESTATE BOARD, INC.",
		"ICRB- ILO-ILO CITY REALTORS BOARD",
		"MAMAREB - MACTAN MANDAUE BRIDGE CITIES REALTORS BOARD, INC.",
		"METREB - METRO TACLOBAN REAL ESTATE BOARD, INC",
		"NOREBI - NEGROS OCCIDENTAL REALTORS BOARD",
		"CRRB - CITY OF ROXAS REALTY BORD",
		"LBREB - LEYTE BILIRAN REAL ESTATE BOARD"
	],
	"MINDANAO" => [
		"COREB - CAGAYAN DE ORO REAL ESTATE BOARD",
		"DBRFI - DAVAO BOARD OF REALTORS FOUNDATION, INC",
		"DDREB - DIPOLOG DAPITAN REAL ESTATE BOARD",
		"GENSAN-SAR REB - GENERAL SANTOS-SARANGANI REAL ESTATE BOARD",
		"SOCOREB - SOUTH COTABATO REAL ESTATE BOARD, INC.",
		"SUNREB - SURIGAO NICKEL REAL ESTATE BOARD",
		"ZAREB - ZAMBOANGA REAL ESTATE BOARD"
	]
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
	]/* ,
	"leads" => [
		"access" => (boolean) true,
		"delete" => (boolean) true
	] */,
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
	"comparative_analysis_access" => (int) 0,
	"max_open_house_announcement" => (int) 1,
	"api_access" => (int) 1
]);

define("PREMIUM_SCRIPTS",[
    "max_post" => 20,
    "max_users" => 1,
	"mls_access" => 0,
    "chat_access" => 0,
    "featured_ads" => 0,
	"handshake_limit" => 1,
	"comparative_analysis_access" => 0,
	"max_open_house_announcement" => (int) 1,
	"api_access" => (int) 1
]);
