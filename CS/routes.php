<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => CS_ALIAS], function () {

    /** DASHBOARD ROUTES */
    Router::get("/", 'DashboardController@index', ['as' => 'dashboard']);

    /** ACCOUNTS ROUTES */
    Router::get('/accounts', 'AccountsController@index', ['as' => 'accountsIndex']);
    Router::get('/accounts/{id}', 'AccountsController@view', ['as' => 'accountsView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/edit', 'AccountsController@edit', ['as' => 'accountsEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/locked-account', 'AccountsController@lockedAccount', ['as' => 'lockedAccount']);

    Router::post('/accounts/verify-pin', 'AccountsController@verifyPin', ['as' => 'verifyPin']);
    Router::post('/accounts/{id}/edit/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);


    /** USERS ROUTES */
    Router::get('/accounts/{id}/users', 'UsersController@index', ['as' => 'users'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/new', 'UsersController@add', ['as' => 'userAdd'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}', 'UsersController@view', ['as' => 'usersView'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

    Router::post('/accounts/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::post('/accounts/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'uploadPhoto']);

    /** MY ACCOUNT ROUTES */
    Router::get('/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);

    /** PROPERTY LISTINGS ROUTES */
    Router::get('/accounts/{id}/listings', 'ListingsController@index', ['as' => 'listings'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/listings/new', 'ListingsController@add', ['as' => 'listingsAdd'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/listings/{listing_id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/listings/{listing_id}/edit', 'ListingsController@edit', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+', 'listing_id' => '[0-9]+' ]);
    Router::get('/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/accounts/{id}/listings/uploadImages', 'ListingsController@uploadImages', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/{id}/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

    /** PROPERTY IMAGES ROUTES */
    Router::get('/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[\w\-]+' ]);

    /** ACCOUNT SUBSCRIPTIONS ROUTES */
    Router::get('/accounts/{id}/subscriptionSelectionNew', 'PremiumsController@premiumSelection', ['as' => 'accountsSubscriptionSelectionNew'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/subscription/{id}/delete', 'AccountSubscriptionController@delete', ['as' => 'deleteAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/subscription/{id}/updateStatus', 'AccountSubscriptionController@updateStatus', ['as' => 'updateStatusAccountSubscription'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/subscription/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

    /** ACCOUNT TRANSACTIONS */
    Router::get('/accounts/{account_id}/transactions', 'TransactionsController@transactions', ['as' => 'accountTransactions'])->where([ 'account_id' => '[0-9]+' ]);
    Router::get('/accounts/transactions/{id}', 'TransactionsController@view', ['as' => 'transactionView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{account_id}/transactions/{id}/invoice', 'TransactionsController@invoices', ['as' => 'transactionInvoice'])->where([ 'account_id' => '[0-9]+', 'id' => '[0-9]+' ]);

    /** KYC ROUTES */
    Router::get('/kyc', 'KYCController@index', ['as' => 'kycIndex']);
    Router::get('/kyc/{id}/view', 'KYCController@view', ['as' => 'view'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/kyc/{id}/verify', 'KYCController@saveUpdate', ['as' => 'saveKYCUpdate'])->where([ 'kyc_id' => '[0-9]+' ]);

});