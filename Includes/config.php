<?php

use Admin\Application\Controller\SettingsController;

ini_set('session.save_path', SESSION_SAVE_PATH);

define("CONFIG", SettingsController::getInstance()->getConfig());

define("WEBSOCKET_SERVER_ADDRESS", "wss://".CONFIG['websocket']['ip_address'].":".CONFIG['websocket']['port']."/webSocketServer.php");

/* define("SITE_NAME", CONFIG['site_name']); */
define("SITE_NAME", CONFIG['site_name']);

/** Set the Email Address to use by the system to send email notifications to users */
define("EMAIL_ADDRESS_RESPONDER", CONFIG['email_address_responder']);

/** Enable premium set this to true */
define("PREMIUM", CONFIG['enable_premium']);

/** Enable KYC set this to true */
define("KYC", CONFIG['enable_kyc_verification']);

/** if you want to include vat computation in INVOICE set this to true */
define("VAT", CONFIG['show_vat']);

define("PROPERTY_TAGS", CONFIG['property_tags']);

/** API CREDENTIALS */

$credential = require_once(ROOT . "/credentials");

/** PAYPAL */
define("PAYPAL_CLIENT_ID", $credential['PAYPAL']['client_id']);
define("PAYPAL_CLIENT_SECRET", $credential['PAYPAL']['client_secret']);
define("PAYPAL_ENVIRONMENT", "sandbox");

/** XENDIT */
define("XENDIT_API_KEY", $credential['XENDIT']['api_key']);

define("CURRENCY", "PHP");

/** ANALYTICS AND CUSTOM META TAGS */
define("ANALYTICS", CONFIG['analytics']);
define("HEADER_SCRIPT", CONFIG['header_script']);