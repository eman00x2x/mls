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
define("API_V1",	"http://localhost/mls/Api/v1/");
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
		"CALOOCAN MALABON NAVOTAS VALENZUELA REAL ESTATE BOARD (CAMANAVA)",
		"CITY OF TAGUIG REAL ESTATE BOARD (CTREB)",
		"LAS PIÑAS CITY REAL ESTATE BOARD (LPCREB)",
		"MANDALUYONG CITY REALTORS BOARD (MANDAREB)",
		"MANILA BOARD OF REALTORS (MBR)",
		"MARIKINA VALLEY REALTORS BOARD (MVRB)",
		"MUNTINLUPA REAL ESTATE BOARD (MUNREB)",
		"PARAÑAQUE-LAS PIÑAS ALABANG REAL ESTATE BOARD (PLAREB)",
		"PASAY MAKATI REALTY BOARD (PMRB)",
		"PASIG REAL ESTATE BOARD (PRB)",
		"PATEROS REALTY BOARD, INC. (PATREB)",
		"QUEZON CITY REAL ESTATE BOARDS (QCRB)",
		"SAN JUAN REAL ESTATE BOARD (SJRB)"
	],
	"NORTH_LUZON" => [
		"BULACAN REAL ESTATE BOARD (BRB)",
		"CITY OF SAN FERNANDO PAMPANGA REAL ESTATE BOARD (CSFPREB)",
		"ILOCOS NORTE REAL ESTATE BOARD (INREB)",
		"METRO ANGELES REAL ESTATE BOARD (MAREB)",
		"METRO BAGUIO REALTORS BOARD (MBRB)",
		"METRO PANGASINAN REAL ESTATE BOARD (MPREB)",
		"SANTIAGO CITY REALTORS BOARD (RBSC)",
		"TARLAC CITY REALTORS BOARD (TCRB)"
	],
	"SOUTH_LUZON" => [
		"ANTIPOLO CITY REAL ESTATE BOARD, INC. (ACRB)",
		"BATANGAS CITY REAL ESTATE BOARD (BCREBA)",
		"CAINTA REALTORS BOARD (CRB)",
		"CALAMBA LAGUNA REAL ESTATE BOARD (CLRB)",
		"CAVITE CITY REALTORS BOARD (CCRB)",
		"CITY OF IMUS REAL ESTATE BOARD (CIREB)",
		"DASMARIÑAS REAL ESTATE BOARD (DASMAREB)",
		"REAL ESTATE BOARD OF LIPA CITY, INC. (RBLC)",
		"LUCENA CITY QUEZON REALTORS BOARD (LCQBRI)",
		"NAGA CITY (CAMSUR) REALTORS BOARD, INC. (NCRB)",
		"PALAWAN REALTORS BOARD, INC, (PALREB)",
		"REAL ESTATE BOARD OF RIZAL (RBR)",
		"SAN PABLO CITY REALTORS (SPCRB)"
	],
	"VISAYAS" => [
		"BOHOL REAL ESTATE BOARD, INC. (BOREB)",
		"CEBU REAL ESTATE BOARD (CEREB)",
		"CEBU NORTH REAL ESTATE BOARD, INC. (CENOREB)",
		"CEBU SOUTH REAL ESTATE BOARD, INC. (CESOREB)",
		"ILO-ILO CITY REALTORS BOARD (ICRB)",
		"MACTAN MANDAUE BRIDGE CITIES REALTORS BOARD, INC. (MAMAREB)",
		"METRO TACLOBAN REAL ESTATE BOARD, INC (METREB)",
		"NEGROS OCCIDENTAL REALTORS BOARD (NOREBI)",
		"CITY OF ROXAS REALTY BORD (CRRB)",
		"LEYTE BILIRAN REAL ESTATE BOARD (LBREB )"
	],
	"MINDANAO" => [
		"CAGAYAN DE ORO REAL ESTATE BOARD (COREB)",
		"DAVAO BOARD OF REALTORS FOUNDATION, INC (DBRFI)",
		"DIPOLOG DAPITAN REAL ESTATE BOARD (DDREB)",
		"GENERAL SANTOS-SARANGANI REAL ESTATE BOARD (GENSAN-SAR REB)",
		"SOUTH COTABATO REAL ESTATE BOARD, INC. (SOCOREB)",
		"SURIGAO NICKEL REAL ESTATE BOARD (SUNREB)",
		"ZAMBOANGA REAL ESTATE BOARD (ZAREB)"
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
