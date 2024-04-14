<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => ADMIN_ALIAS], function () {

    /** DASHBOARD ROUTES */
    Router::get('/', 'DashboardController@index', ['as' => 'dashboard']);

    /** ACCOUNTS ROUTES */
    Router::get('/accounts', 'AccountsController@index', ['as' => 'accounts']);
    Router::get('/accounts/new', 'AccountsController@add', ['as' => 'accountsAdd']);
    Router::get('/accounts/{id}', 'AccountsController@view', ['as' => 'accountsView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/edit', 'AccountsController@edit', ['as' => 'accountsEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/delete', 'AccountsController@delete', ['as' => 'accountsDelete'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/accounts/saveNewAccount', 'AccountsController@saveNew', ['as' => 'saveNewAccount']);
    Router::post('/accounts/{id}/edit/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

    /** KYC ROUTES */
    Router::get('/kyc', 'KYCController@index', ['as' => 'kycIndex']);
    Router::get('/kyc/{id}/view', 'KYCController@view', ['as' => 'view'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/kyc/{id}/verify', 'KYCController@saveUpdate', ['as' => 'saveKYCUpdate'])->where([ 'kyc_id' => '[0-9]+' ]);

    /** USERS ROUTES */
    Router::get('/accounts/{id}/users', 'UsersController@index', ['as' => 'users'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/new', 'UsersController@add', ['as' => 'userAdd'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}', 'UsersController@view', ['as' => 'usersView'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::get('/accounts/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

    Router::post('/accounts/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/accounts/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::post('/accounts/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'uploadPhoto']);

    /** USERS ADMIN_ALIAS ROUTES */
    Router::get('/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userADMIN_ALIASEdit'])->where([ 'id' => '[0-9]+' ]);

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
    Router::get('/account_subscription/{id}/delete', 'AccountSubscriptionController@delete', ['as' => 'deleteAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/account_subscription/{id}/updateStatus', 'AccountSubscriptionController@updateStatus', ['as' => 'updateStatusAccountSubscription'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/account_subscription/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

    /** PREMIUMS ROUTES */
    Router::get('/premiums', 'PremiumsController@index', ['as' => 'premiums']);
    Router::get('/accounts/{id}/subscriptionSelectionNew', 'PremiumsController@premiumSelection', ['as' => 'accountsSubscriptionSelectionNew'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/premiums/new', 'PremiumsController@add', ['as' => 'premiumsAdd']);
    Router::get('/premiums/{id}', 'PremiumsController@view', ['as' => 'premiumsView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/premiums/{id}/edit', 'PremiumsController@edit', ['as' => 'premiumsEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/premiums/{id}/delete', 'PremiumsController@delete', ['as' => 'premiumsDelete'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/premiums/new/save', 'PremiumsController@saveNew', ['as' => 'premiumsSaveNew']);
    Router::post('/premiums/{id}/edit/saveUpdate', 'PremiumsController@saveUpdate', ['as' => 'premiumsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

    /** ACCOUNT TRANSACTIONS */
    Router::get('/accounts/{account_id}/transactions', 'TransactionsController@transactions', ['as' => 'accountTransactions'])->where([ 'account_id' => '[0-9]+' ]);
    Router::get('/accounts/{account_id}/transactions/{id}/invoice', 'TransactionsController@invoices', ['as' => 'transactionInvoice'])->where([ 'account_id' => '[0-9]+', 'id' => '[0-9]+' ]);

    /** TRANSACTIONS ROUTES */
    Router::get('/transactions', 'TransactionsController@index', ['as' => 'index']);
    Router::get('/transactions/{id}', 'TransactionsController@view', ['as' => 'TransactionsControllerView'])->where([ 'id' => '[0-9]+']);
    Router::get('/transactions/{id}/delete', 'TransactionsController@delete', ['as' => 'deleteTransaction'])->where([ 'id' => '[0-9]+' ]);

    /** REPORTS ROUTES */
    Router::get('/report/subscribers', 'ReportsController@subscribersReport', ['as' => 'subscribersReport']);
    Router::get('/report/transactions', 'ReportsController@transactionsReport', ['as' => 'transactionsReport']);
    Router::get('/report/propertiesReport', 'ReportsController@propertiesReport', ['as' => 'propertiesReport']);
    Router::get('/report/listingPerCategoriesReport', 'ReportsController@listingPerCategoriesReport', ['as' => 'listingPerCategoriesReport']);
    Router::get('/report/listingPerRegion', 'ReportsController@listingPerRegion', ['as' => 'listingPerRegion']);
    Router::get('/report/listingPerProvince', 'ReportsController@listingPerProvince', ['as' => 'listingPerProvince']);
    Router::get('/report/listingPerMunicipality', 'ReportsController@listingPerMunicipality', ['as' => 'listingPerMunicipality']);
    Router::get('/report/listingPerBarangay', 'ReportsController@listingPerBarangay', ['as' => 'listingPerBarangay']);
    Router::get('/report/getPriceRange', 'ReportsController@getPriceRange', ['as' => 'getPriceRange']);

    /** ARTICLES ROUTES */
    Router::get('/articles', 'ArticlesController@index', ['as' => 'index']);
    Router::get('/articles/new', 'ArticlesController@add', ['as' => 'addArticle']);
    Router::get('/articles/{id}', 'ArticlesController@edit', ['as' => 'editArticle'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/articles/{id}/delete', 'ArticlesController@delete', ['as' => 'deleteArticle'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/articles/{id}/save', 'ArticlesController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/articles/saveNew', 'ArticlesController@saveNew', ['as' => 'accountSubscriptionSaveNew']);
    Router::post('/articles/upload', 'ArticlesController@uploadPhoto', ['as' => 'uploadPhoto']);

    /** PAGE ADS ROUTES */
    Router::get('/ads', 'PageAdsController@index', ['as' => 'ads']);
    Router::get('/ads/new', 'PageAdsController@add', ['as' => 'addAds']);
    Router::get('/ads/{id}', 'PageAdsController@edit', ['as' => 'editAds'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/ads/{id}/delete', 'PageAdsController@delete', ['as' => 'deleteAds'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/ads/{id}/save', 'PageAdsController@saveUpdate', ['as' => 'addAdsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/ads/saveNew', 'PageAdsController@saveNew', ['as' => 'addAdsSaveNew']);
    Router::post('/ads/upload', 'PageAdsController@uploadPhoto', ['as' => 'adsUploadPhoto']);

    /** ADMINISTRATION ROUTES */
    Router::get('/settings/{page}', 'SettingsController@index', ['as' => 'settings'])->where([ 'page' => '[\w\-\=]+' ]);
    Router::get('/web-settings/{page}', 'SettingsController@webSettings', ['as' => 'webSettings'])->where([ 'page' => '[\w\-\=]+' ]);
    Router::post('/settings/saveUpdate', 'SettingsController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'page' => '[\w\-\=]+' ]);

    Router::get('/administration', 'AdministrationController@index', ['as' => 'administration']);
    Router::get('/administration/dbBackup', 'AdministrationController@backupDatabase', ['as' => 'administration-backupDatabase']);
    Router::get('/administration/downloadBackup', 'AdministrationController@downloadBackup', ['as' => 'administration-downloadBackup']);
    Router::get('/administration/deleteBackup', 'AdministrationController@deleteBackup', ['as' => 'administration-deleteBackup']);

    Router::post('/administration/queryResult', 'AdministrationController@queryResult', ['as' => 'administration-queryResult']);

    /** DEBUGGING */
    Router::get('/debug', 'DebugController@debug', ['as' => 'debug']);

});