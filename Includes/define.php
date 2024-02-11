<?php
defined("ACCESS")or die("Restricted page!");

date_default_timezone_set("Asia/Kuala_Lumpur");

define("DATE_NOW",strtotime("Now"));
/* define("DATE_NOW",strtotime("2023-11-06")); */
define("LIST_LIMIT",20);

define("API","http://api.mls/v1/");
define("ADMIN","http://admin.mls/");
define("MANAGE","http://manage.mls/");
define("WEBDOMAIN","http://mls/");
define("CDN","http://cdn.mls/");
define("ALIAS","");


/* define("API","http://192.168.254.250/mls/Api/");
define("ADMIN","http://192.168.254.250/mls/Admin/");
define("MANAGE","http://192.168.254.250/managemls/");
define("WEBDOMAIN","http://192.168.254.250/mls/");
define("CDN","http://192.168.254.250/cdnmls/");

define("ALIAS","managemls"); */

define("VRSN","v1.0");

/** Set the Email Address to use by the system to send email notifications to users */
define("EMAIL_RESPONDER_ADDRESS","no-reply@mls.com");

/** Enable premium set this to true */
define("PREMIUM", true);

/** if you want to enable premium from users set this to true */
define("SHOW_PREMIUM", true);

define("USER_PERMISSIONS",[
	"account" => array (
 		"access" => true
    ),
    "users" => array (
 		"access" => true,
 		"delete" => true
    ),
    "leads" => array (
		"access" => true,
		"delete" => true
    ),
    "properties" => array (
		"access" => true,
		"delete" => true
    ),
    "subscriptions" => array (
		"purchased" => true
    )
]);

define("CS_PERMISSIONS",[
    "accounts" => array (
		"access" => true,
 		"edit" => true,
 		"delete" => false
	),
    "users" => array (
 		"access" => true,
 		"edit" => true,
 		"delete" => false
	),
    "properties" => array (
		"access" => true,
		"edit" => true,
		"delete" => true
    )
]);

define("ADMIN_PERMISSIONS",[
    "accounts" => array (
		"access" => true,
 		"edit" => true,
 		"delete" => true
	),
    "users" => array (
 		"access" => true,
 		"edit" => true,
 		"delete" => true
	),
    "properties" => array (
		"access" => true,
		"edit" => true,
		"delete" => true
    )
]);

define("ACCOUNT_PRIVILEGES",[
    "max_post" => 30,
    "max_users" => 1,
    "display_ads" => 0,
    "featured_ads" => 0,
    "handshake_limit" => 1
]);

define("PREMIUM_SCRIPTS",[
    "max_post" => 30,
    "max_users" => 1,
    "display_ads" => 0,
    "featured_ads" => 0,
	"handshake_limit" => 1
]);

define("PROPERTY_TAGS", [
	"New","Pre Owned","Furnished Unit","Bare Unit","Ready For Occupancy"
]);

define("PAYPAL_CLIENT_ID", "AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF");
define("PAYPAL_CLIENT_SECRET", "EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0");
define("CURRENCY", "PHP");
define("PAYPAL_ENVIRONMENT", "sandbox");

/** if you want to include vat computation in INVOICE set this to true */
define("VAT", true);
