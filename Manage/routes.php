<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get(ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** NOTIFICATIONS ROUTES */
Router::get(ALIAS.'/notifications', 'NotificationsController@index', ['as' => 'index']);
Router::get(ALIAS.'/notifications/getLatest', 'NotificationsController@getLatest', ['as' => 'getLatest']);
Router::get(ALIAS.'/notifications-{id}-update-status', 'NotificationsController@updateNotification', ['as' => 'updateNotification'])->where([ 'id' => '[0-9]+' ]);

/** ACCOUNTS ROUTES */
Router::get(ALIAS.'/account', 'AccountsController@index', ['as' => 'accounts']);
Router::get(ALIAS.'/account', 'AccountsController@view', ['as' => 'accountView']);
Router::get(ALIAS.'/account/profile', 'AccountsController@accountProfile', ['as' => 'profile']);

Router::post(ALIAS.'/account/{id}/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(ALIAS.'/account/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

/** USERS ROUTES */
Router::get(ALIAS.'/account/users', 'UsersController@index', ['as' => 'users']);
Router::get(ALIAS.'/account/user/new', 'UsersController@new', ['as' => 'userAdd']);
Router::get(ALIAS.'/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::get(ALIAS.'/account/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(ALIAS.'/account/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

Router::post(ALIAS.'/account/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(ALIAS.'/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::post(ALIAS.'/account/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'usersUploadPhoto']);

/** USERS ALIAS ROUTES */
Router::get(ALIAS.'/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userAliasEdit'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY LISTINGS ROUTES */
Router::get(ALIAS.'/listings', 'ListingsController@listingIndex', ['as' => 'listings']);
Router::get(ALIAS.'/listings/new', 'ListingsController@addListing', ['as' => 'listingsAdd']);
Router::get(ALIAS.'/listings/{id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/listings/{id}/edit', 'ListingsController@editListing', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(ALIAS.'/listings/{id}/uploadImages', 'ListingsController@uploadImages', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::post(ALIAS.'/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(ALIAS.'/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY IMAGES ROUTES */
Router::get(ALIAS.'/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[0-9]+' ]);

/** MLS ROUTES */
Router::get(ALIAS.'/mls', 'MlsController@MLSIndex', ['as' => 'mls']);
Router::get(ALIAS.'/mls/handshaked', 'MlsController@handshakedIndex', ['as' => 'handshakedIndex']);
Router::get(ALIAS.'/mls/compare', 'MlsController@compareListings', ['as' => 'compareListings']);
Router::get(ALIAS.'/mls/comparePreview', 'MlsController@comparePreview', ['as' => 'comparePreview']);
Router::get(ALIAS.'/mls/handshaked/{id}/acceptRequest', 'MlsController@acceptRequest', ['as' => 'acceptRequest'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/mls/handshaked/{id}/deniedRequest', 'MlsController@deniedRequest', ['as' => 'deniedRequest'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/mls/handshaked/{id}/doneHandshake', 'MlsController@doneHandshake', ['as' => 'doneHandshake'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/mls/handshaked/{listing_id}/cancelHandshake', 'MlsController@cancelHandshake', ['as' => 'cancelHandshake'])->where([ 'listing_id' => '[0-9]+' ]);

/** DOWNLOAD MLS LISTING URL */
Router::get(ALIAS.'/mls/{id}/download', 'MlsController@downloadPDFFormat', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);

Router::get(ALIAS.'/mls/{id}', 'MlsController@viewListing', ['as' => 'viewListing'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/mls/{listing_id}/requestHandshake', 'MlsController@requestHandshake', ['as' => 'requestHandshake'])->where([ 'listing_id' => '[0-9]+' ]);

Router::post(ALIAS.'/mls/compare/add', 'MlsController@addToCompare', ['as' => 'addToCompare']);
Router::post(ALIAS.'/mls/compare/remove', 'MlsController@removeFromCompare', ['as' => 'removeFromCompare']);

/** LEADS ROUTES */
Router::get(ALIAS.'/leads', 'LeadsController@index', ['as' => 'leads']);
Router::get(ALIAS.'/leads/{id}', 'LeadsController@view', ['as' => 'leadView'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/leads/{id}/edit', 'LeadsController@edit', ['as' => 'leadEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/leads/{id}/delete', 'LeadsController@delete', ['as' => 'leadDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(ALIAS.'/leads/{id}/saveUpdate', 'LeadsController@saveUpdate', ['as' => 'leadSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** THREADS ROUTES */
Router::get(ALIAS.'/threads', 'MessagesController@index', ['as' => 'messages']);
Router::get(ALIAS.'/threads/{id}/downloadThreadMessages', 'MessagesController@downloadThreadMessages', ['as' => 'downloadThreadMessages'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/threads/{participants}', 'MessagesController@conversation', ['as' => 'conversation'])->where([ 'participants' => '[\w\-\=]+' ]);
Router::get(ALIAS.'/threads/{participants}/getMessages/{lastMessageId}', 'MessagesController@getMessages', ['as' => 'getMessages'])->where([ 'participants' => '[\w\-\=]+', 'lastMessageId' => '[0-9]+' ]);
Router::get(ALIAS.'/threads/getThreadInfoByParticipants/{participants}', 'MessagesController@getThreadInfoByParticipants', ['as' => 'showMessages'])->where([ 'participants' => '[\w\-\=]+' ]);


/** MESSAGES ROUTES */
Router::get(ALIAS.'/messages/{thread_id}/removeMessage', 'MessagesController@saveDeletedThread', ['as' => 'saveDeletedThread'])->where([ 'thread_id' => '[0-9]+' ]);
Router::get(ALIAS.'/messages/upload/{filename}/removeAttachment', 'MessagesController@removeAttachment', ['as' => 'removeAttachment'])->where([ 'filename' => '[\w\-\=\.]+' ]);

Router::post(ALIAS.'/messages/saveNewMessage', 'MessagesController@saveNewMessage', ['as' => 'saveNewMessage']);
Router::post(ALIAS.'/messages/upload', 'MessagesController@uploadAttachment', ['as' => 'uploadMessageAttachment']);

/** ACCOUNT SUBSCRIPTIONS ROUTES */
Router::get(ALIAS.'/subscriptions', 'AccountSubscriptionController@index', ['as' => 'subscriptions']);

Router::post(ALIAS.'/subscriptions/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

if(PREMIUM) {
    /** PREMIUMS ROUTES */
    Router::get(ALIAS.'/premiums', 'PremiumsController@index', ['as' => 'premiums']);

    /** TRANSACTIONS ROUTES */
    Router::get(ALIAS.'/transactions', 'TransactionsController@transactions', ['as' => 'transactions']);
    Router::get(ALIAS.'/transactions/{id}', 'TransactionsController@index', ['as' => 'transactions'])->where([ 'id' => '[0-9]+' ]);
    Router::get(ALIAS.'/transactions/checkout/{premium_id}', 'TransactionsController@checkout', ['as' => 'checkout'])->where([ 'premium_id' => '[0-9]+' ]);
    Router::get(ALIAS.'/transactions/paymentStatus', 'TransactionsController@paymentStatus', ['as' => 'paymentStatus']);
    Router::get(ALIAS.'/transactions/{id}/invoice', 'TransactionsController@invoice', ['as' => 'invoice'])->where([ 'id' => '[0-9]+' ]);

    Router::post(ALIAS.'/transactions/validateCheckOut', 'TransactionsController@validateCheckOut', ['as' => 'validateCheckOut']);
}

/** INVOICE ROUTES */
Router::get(ALIAS.'/invoices', 'InvoicesController@index', ['as' => 'deleteInvoice']);
Router::get(ALIAS.'/invoices/{id}/delete', 'InvoicesController@delete', ['as' => 'deleteInvoice'])->where([ 'id' => '[0-9]+' ]);