<?php

use Admin\Application\Controller\SettingsController;
define("CONFIG", SettingsController::getInstance()->getConfig());

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

$paypal_credential = require_once(ROOT . "paypal.credentials");

define("PAYPAL_CLIENT_ID", $paypal_credential['client_id']);
define("PAYPAL_CLIENT_SECRET", $paypal_credential['client_secret']);
define("PAYPAL_ENVIRONMENT", "sandbox");
define("CURRENCY", "PHP");

define("ANALYTICS", CONFIG['analytics']);
define("HEADER_SCRIPT", CONFIG['header_script']);