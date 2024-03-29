<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

/** DASHBOARD ROUTES */
Router::get(CS_ALIAS, 'DashboardController@index', ['as' => 'dashboard']);

/** ACCOUNTS ROUTES */
Router::get(CS_ALIAS.'/accounts', 'AccountsController@index', ['as' => 'accountsIndex']);
Router::get(CS_ALIAS.'/accounts/{id}', 'AccountsController@view', ['as' => 'accountsView'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/edit', 'AccountsController@edit', ['as' => 'accountsEdit'])->where([ 'id' => '[0-9]+' ]);

Router::post(CS_ALIAS.'/accounts/{id}/edit/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/accounts/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);


/** USERS ROUTES */
Router::get(CS_ALIAS.'/accounts/{id}/users', 'UsersController@index', ['as' => 'users'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/user/new', 'UsersController@add', ['as' => 'userAdd'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/user/{user_id}', 'UsersController@view', ['as' => 'usersView'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

Router::post(CS_ALIAS.'/accounts/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/accounts/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/accounts/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'uploadPhoto']);


/** PROPERTY LISTINGS ROUTES */
Router::get(CS_ALIAS.'/accounts/{id}/listings', 'ListingsController@index', ['as' => 'listings'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/listings/new', 'ListingsController@add', ['as' => 'listingsAdd'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/listings/{listing_id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{id}/listings/{listing_id}/edit', 'ListingsController@edit', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(CS_ALIAS.'/accounts/{id}/listings/uploadImages', 'ListingsController@uploadImages', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/accounts/{id}/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/accounts/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY IMAGES ROUTES */
Router::get(CS_ALIAS.'/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[\w\-]+' ]);

/** ACCOUNT SUBSCRIPTIONS ROUTES */
Router::get(CS_ALIAS.'/accounts/{id}/subscriptionSelectionNew', 'PremiumsController@premiumSelection', ['as' => 'accountsSubscriptionSelectionNew'])->where([ 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{account_id}/transactions/{id}/invoice', 'TransactionsController@invoices', ['as' => 'transactionInvoice'])->where([ 'account_id' => '[0-9]+', 'id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/account_subscription/{id}/delete', 'AccountSubscriptionController@delete', ['as' => 'deleteAccountSubscription'])->where([ 'id' => '[0-9]+' ]);

Router::get(CS_ALIAS.'/account_subscription/{id}/updateStatus', 'AccountSubscriptionController@updateStatus', ['as' => 'updateStatusAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
Router::post(CS_ALIAS.'/account_subscription/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

/** ACCOUNT TRANSACTIONS */
Router::get(CS_ALIAS.'/accounts/{account_id}/transactions', 'TransactionsController@transactions', ['as' => 'accountTransactions'])->where([ 'account_id' => '[0-9]+' ]);
Router::get(CS_ALIAS.'/accounts/{account_id}/transactions/{id}/invoice', 'TransactionsController@invoices', ['as' => 'transactionInvoice'])->where([ 'account_id' => '[0-9]+', 'id' => '[0-9]+' ]);

/** KYC ROUTES */
Router::get(CS_ALIAS.'/kyc', 'KYCController@index', ['as' => 'kycIndex']);
Router::get(CS_ALIAS.'/kyc/{id}/view', 'KYCController@view', ['as' => 'view'])->where([ 'id' => '[0-9]+' ]);

Router::post(CS_ALIAS.'/kyc/{id}/verify', 'KYCController@saveUpdate', ['as' => 'saveKYCUpdate'])->where([ 'kyc_id' => '[0-9]+' ]);

/** ACCOUNT ROUTES */
Router::get(CS_ALIAS . '/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::post(CS_ALIAS . '/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);