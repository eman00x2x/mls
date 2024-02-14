<?php

use Admin\Application\Controller\SettingsController;
define("CONFIG", SettingsController::getInstance()->getConfig());

/** Set the Email Address to use by the system to send email notifications to users */
define("EMAIL_ADDRESS_RESPONDER", CONFIG['email_address_responder']);

/** Enable premium set this to true */
define("PREMIUM", CONFIG['enable_premium']);

/** if you want to include vat computation in INVOICE set this to true */
define("VAT", CONFIG['show_vat']);

define("PROPERTY_TAGS", CONFIG['property_tags']);

define("PAYPAL_CLIENT_ID", CONFIG['paypal_credentials']['client_id']);
define("PAYPAL_CLIENT_SECRET", CONFIG['paypal_credentials']['client_secret']);
define("CURRENCY", "PHP");
define("PAYPAL_ENVIRONMENT", "sandbox");

define("ANALYTICS", CONFIG['analytics']);
define("HEADER_SCRIPT", CONFIG['header_script']);