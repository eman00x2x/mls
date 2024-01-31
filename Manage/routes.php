<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get('/', 'DashboardController@index', ['as' => 'dashboard']);

/** ACCOUNTS ROUTES */
Router::get('/account', 'AccountsController@index', ['as' => 'accounts']);
Router::get('/account', 'AccountsController@view', ['as' => 'accountView']);

Router::post('/account/{id}/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post('/account/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

/** USERS ROUTES */
Router::get('/account/users', 'UsersController@index', ['as' => 'users']);
Router::get('/account/user/new', 'UsersController@new', ['as' => 'userAdd']);
Router::get('/account/user/{id}/changePassword', 'UsersController@changePassword', ['as' => 'changePassword'])->where([ 'id' => '[0-9]+' ]);
Router::get('/account/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get('/account/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

Router::post('/account/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post('/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

/** USERS ALIAS ROUTES */
Router::get('/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userAliasEdit'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY LISTINGS ROUTES */
Router::get('/listings', 'ListingsController@listingIndex', ['as' => 'listings']);
Router::get('/listings/new', 'ListingsController@addListing', ['as' => 'listingsAdd']);
Router::get('/listings/{id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);
Router::get('/listings/{id}/edit', 'ListingsController@editListing', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get('/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post('/listings/{id}/uploadImages', 'ListingsController@uploadImages', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::post('/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post('/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY IMAGES ROUTES */
Router::get('/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[\w\-]+' ]);

/** MLS ROUTES */
Router::get('/mls', 'MlsController@MLSIndex', ['as' => 'mls']);
Router::get('/mls/handshaked', 'MlsController@handshakedIndex', ['as' => 'handshakedIndex']);
Router::get('/mls/compare', 'MlsController@compareListings', ['as' => 'compareListings']);
Router::get('/mls/comparePreview', 'MlsController@comparePreview', ['as' => 'comparePreview']);
Router::get('/mls/handshaked/{id}/acceptRequest', 'MlsController@acceptRequest', ['as' => 'acceptRequest'])->where([ 'id' => '[\w\-]+' ]);
Router::get('/mls/handshaked/{id}/deniedRequest', 'MlsController@deniedRequest', ['as' => 'deniedRequest'])->where([ 'id' => '[\w\-]+' ]);
Router::get('/mls/handshaked/{id}/doneHandshake', 'MlsController@doneHandshake', ['as' => 'doneHandshake'])->where([ 'id' => '[\w\-]+' ]);
Router::get('/mls/handshaked/{listing_id}/cancelHandshake', 'MlsController@cancelHandshake', ['as' => 'cancelHandshake'])->where([ 'listing_id' => '[\w\-]+' ]);

Router::get('/mls/{id}', 'MlsController@viewListing', ['as' => 'viewListing'])->where([ 'id' => '[\w\-]+' ]);
Router::get('/mls/{listing_id}/requestHandshake', 'MlsController@requestHandshake', ['as' => 'requestHandshake'])->where([ 'listing_id' => '[\w\-]+' ]);

Router::post('/mls/compare/add', 'MlsController@addToCompare', ['as' => 'addToCompare']);
Router::post('/mls/compare/remove', 'MlsController@removeFromCompare', ['as' => 'removeFromCompare']);

/** MESSAGES ROUTES */
Router::get('/messages', 'MessagesController@index', ['as' => 'messages']);
Router::get('/messages/{id}', 'MessagesController@view', ['as' => 'viewMessages'])->where([ 'id' => '[\w\-]+' ]);
Router::get('/messages/{id}/showMessages/{lastId}', 'MessagesController@showMessages', ['as' => 'showMessages'])->where([ 'id' => '[\w\-]+', 'lastId' => '[\w\-]+' ]);
Router::get('/messages/{id}/removeMessage', 'MessagesController@saveDeletedThread', ['as' => 'saveDeletedThread'])->where([ 'id' => '[\w\-]+' ]);

/** ACCOUNT SUBSCRIPTIONS ROUTES */
Router::get('/subscriptions', 'SubscriptionsController@index', ['as' => 'subscriptions']);
Router::post('/subscriptions/saveNew', 'SubscriptionsController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

/** Premiums ROUTES */
Router::get('/premiums', 'PremiumsController@index', ['as' => 'premiums']);

/** INVOICE ROUTES */
Router::get('/invoices', 'InvoicesController@index', ['as' => 'deleteInvoice']);
Router::get('/invoices/{id}/delete', 'InvoicesController@delete', ['as' => 'deleteInvoice'])->where([ 'id' => '[0-9]+' ]);