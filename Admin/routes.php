<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get(ADMIN_ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** ACCOUNTS ROUTES */
Router::get(ADMIN_ALIAS.'/accounts', 'AccountsController@index', ['as' => 'accounts']);
Router::get(ADMIN_ALIAS.'/accounts/new', 'AccountsController@add', ['as' => 'accountsAdd']);
Router::get(ADMIN_ALIAS.'/accounts/{id}', 'AccountsController@view', ['as' => 'accountsView'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/edit', 'AccountsController@edit', ['as' => 'accountsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/delete', 'AccountsController@delete', ['as' => 'accountsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(ADMIN_ALIAS.'/accounts/saveNewAccount', 'AccountsController@saveNew', ['as' => 'saveNewAccount']);
Router::post(ADMIN_ALIAS.'/accounts/{id}/edit/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/accounts/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

/** KYC ROUTES */
Router::get(ADMIN_ALIAS.'/kyc', 'KYCController@index', ['as' => 'kycIndex']);
Router::get(ADMIN_ALIAS.'/kyc/{id}/verify', 'KYCController@verify', ['as' => 'verify'])->where([ 'id' => '[0-9]+' ]);

Router::post(ADMIN_ALIAS.'/kyc/{id}/verify', 'KYCController@saveUpdate', ['as' => 'saveKYCUpdate'])->where([ 'kyc_id' => '[0-9]+' ]);

/** USERS ROUTES */
Router::get(ADMIN_ALIAS.'/accounts/{id}/users', 'UsersController@index', ['as' => 'users'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/user/new', 'UsersController@add', ['as' => 'userAdd'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/user/{user_id}', 'UsersController@view', ['as' => 'usersView'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

Router::post(ADMIN_ALIAS.'/accounts/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/accounts/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/accounts/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'uploadPhoto']);

/** USERS ADMIN_ALIAS ROUTES */
Router::get(ADMIN_ALIAS.'/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userADMIN_ALIASEdit'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY LISTINGS ROUTES */
Router::get(ADMIN_ALIAS.'/accounts/{id}/listings', 'ListingsController@index', ['as' => 'listings'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/listings/new', 'ListingsController@add', ['as' => 'listingsAdd'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/listings/{listing_id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{id}/listings/{listing_id}/edit', 'ListingsController@edit', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(ADMIN_ALIAS.'/accounts/{id}/listings/uploadImages', 'ListingsController@uploadImages', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/accounts/{id}/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/accounts/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY IMAGES ROUTES */
Router::get(ADMIN_ALIAS.'/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[\w\-]+' ]);

/** ACCOUNT SUBSCRIPTIONS ROUTES */
Router::get(ADMIN_ALIAS.'/account_subscription/{id}/delete', 'AccountSubscriptionController@delete', ['as' => 'deleteAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/account_subscription/{id}/updateStatus', 'AccountSubscriptionController@updateStatus', ['as' => 'updateStatusAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
Router::post(ADMIN_ALIAS.'/account_subscription/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

/** PREMIUMS ROUTES */
Router::get(ADMIN_ALIAS.'/premiums', 'PremiumsController@index', ['as' => 'premiums']);
Router::get(ADMIN_ALIAS.'/accounts/{id}/subscriptionSelectionNew', 'PremiumsController@premiumSelection', ['as' => 'accountsSubscriptionSelectionNew'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/premiums/new', 'PremiumsController@add', ['as' => 'premiumsAdd']);
Router::get(ADMIN_ALIAS.'/premiums/{id}', 'PremiumsController@view', ['as' => 'premiumsView'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/premiums/{id}/edit', 'PremiumsController@edit', ['as' => 'premiumsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/premiums/{id}/delete', 'PremiumsController@delete', ['as' => 'premiumsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(ADMIN_ALIAS.'/premiums/new/save', 'PremiumsController@saveNew', ['as' => 'premiumsSaveNew']);
Router::post(ADMIN_ALIAS.'/premiums/{id}/edit/saveUpdate', 'PremiumsController@saveUpdate', ['as' => 'premiumsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** TRANSACTIONS ROUTES */
Router::get(ADMIN_ALIAS.'/accounts/{account_id}/transactions', 'TransactionsController@index', ['as' => 'transactionIndex'])->where([ 'account_id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/accounts/{account_id}/transactions/{id}/invoice', 'TransactionsController@invoices', ['as' => 'transactionInvoice'])->where([ 'account_id' => '[0-9]+', 'id' => '[0-9]+' ]);
Router::get(ADMIN_ALIAS.'/transactions/{id}/delete', 'TransactionsController@delete', ['as' => 'deleteTransaction'])->where([ 'id' => '[0-9]+' ]);

/** ADMINISTRATION ROUTES */
Router::get(ADMIN_ALIAS.'/settings/{page}', 'SettingsController@index', ['as' => 'settings'])->where([ 'page' => '[\w\-\=]+' ]);
Router::get(ADMIN_ALIAS.'/web-settings/{page}', 'SettingsController@webSettings', ['as' => 'webSettings'])->where([ 'page' => '[\w\-\=]+' ]);
Router::post(ADMIN_ALIAS.'/settings/saveUpdate', 'SettingsController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'page' => '[\w\-\=]+' ]);

Router::get(ADMIN_ALIAS.'/administration', 'AdministrationController@index', ['as' => 'administration']);
Router::post(ADMIN_ALIAS.'/administration', 'AdministrationController@queryResult', ['as' => 'administration-queryResult']);


/** DEBUGGING */
Router::get(ADMIN_ALIAS.'/debug', 'DebugController@debug', ['as' => 'debug']);