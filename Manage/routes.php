<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

/** DASHBOARD ROUTES */

Router::get(MANAGE_ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** NOTIFICATIONS ROUTES */
Router::get(MANAGE_ALIAS.'/notifications', 'NotificationsController@index', ['as' => 'index']);
Router::get(MANAGE_ALIAS.'/notifications/getLatest', 'NotificationsController@getLatest', ['as' => 'getLatest']);
Router::get(MANAGE_ALIAS.'/notifications-{id}-update-status', 'NotificationsController@updateNotification', ['as' => 'updateNotification'])->where([ 'id' => '[0-9]+' ]);

/** ACCOUNTS ROUTES */
Router::get(MANAGE_ALIAS.'/account', 'AccountsController@index', ['as' => 'accounts']);
Router::get(MANAGE_ALIAS.'/account', 'AccountsController@view', ['as' => 'accountView']);
Router::get(MANAGE_ALIAS.'/account/profile', 'AccountsController@accountProfile', ['as' => 'profile']);

Router::post(MANAGE_ALIAS.'/account/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate']);
Router::post(MANAGE_ALIAS.'/account/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

/** KYC ROUTES */
Router::get(MANAGE_ALIAS.'/kyc', 'KYCController@kycVerificationForm', ['as' => 'kycVerificationForm']);

Router::post(MANAGE_ALIAS.'/kyc/{id}/kycVerificationForm', 'KYCController@saveNew', ['as' => 'saveNewKYC'])->where([ 'id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/kyc/{id}/kycDocsUpload', 'KYCController@kycDocsUpload', ['as' => 'kycDocsUpload'])->where([ 'id' => '[0-9]+' ]);

/** USERS ROUTES */
Router::get(MANAGE_ALIAS.'/account/users', 'UsersController@index', ['as' => 'users']);
Router::get(MANAGE_ALIAS.'/account/user/new', 'UsersController@new', ['as' => 'userAdd']);
Router::get(MANAGE_ALIAS.'/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::get(MANAGE_ALIAS.'/account/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/account/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

Router::post(MANAGE_ALIAS.'/account/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/account/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'usersUploadPhoto']);

/** USERS MANAGE_ALIAS ROUTES */
Router::get(MANAGE_ALIAS.'/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userMANAGE_ALIASEdit'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY LISTINGS ROUTES */
Router::get(MANAGE_ALIAS.'/listings', 'ListingsController@listingIndex', ['as' => 'listings']);
Router::get(MANAGE_ALIAS.'/listings/new', 'ListingsController@addListing', ['as' => 'listingsAdd']);
Router::get(MANAGE_ALIAS.'/listings/{id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/listings/{id}/edit', 'ListingsController@editListing', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/listings/{id}/sold', 'ListingsController@soldSettings', ['as' => 'listingsSoldSettings'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/listings/{id}/featured', 'ListingsController@setFeatured', ['as' => 'listingsSetFeatured'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(MANAGE_ALIAS.'/listings/{id}/setSold', 'ListingsController@setSold', ['as' => 'listingsSetSold'])->where([ 'id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/listings/{id}/uploadImages', 'ListingsController@uploadImages', ['as' => 'uploadImages'])->where([ 'id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
Router::post(MANAGE_ALIAS.'/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** PROPERTY IMAGES ROUTES */
Router::get(MANAGE_ALIAS.'/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[0-9]+' ]);

/** MLS ROUTES */
Router::get(MANAGE_ALIAS.'/mls', 'MlsController@MLSIndex', ['as' => 'mls']);
Router::get(MANAGE_ALIAS.'/mls/region/{region}', 'MlsController@MLSRegional', ['as' => 'MLSRegional'])->where([ 'region' => '[\w\-\=]+' ]);
Router::get(MANAGE_ALIAS.'/mls/board/{local_board}', 'MlsController@MLSLocalBoard', ['as' => 'MLSLocalBoard'])->where([ 'local_board' => '[\w\-\=]+' ]);

Router::get(MANAGE_ALIAS.'/mls/handshaked', 'MlsController@handshakedIndex', ['as' => 'handshakedIndex']);
Router::get(MANAGE_ALIAS.'/mls/compare', 'MlsController@compareListings', ['as' => 'compareListings']);
Router::get(MANAGE_ALIAS.'/mls/comparePreview', 'MlsController@comparePreview', ['as' => 'comparePreview']);
Router::get(MANAGE_ALIAS.'/mls/handshaked/{id}/acceptRequest', 'MlsController@acceptRequest', ['as' => 'acceptRequest'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/mls/handshaked/{id}/deniedRequest', 'MlsController@deniedRequest', ['as' => 'deniedRequest'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/mls/handshaked/{id}/doneHandshake', 'MlsController@doneHandshake', ['as' => 'doneHandshake'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/mls/handshaked/{listing_id}/cancelHandshake', 'MlsController@cancelHandshake', ['as' => 'cancelHandshake'])->where([ 'listing_id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/related-properties', 'MlsController@relatedProperties');

/** DOWNLOAD MLS LISTING URL */
Router::get(MANAGE_ALIAS.'/mls/{id}/download', 'MlsController@downloadPDFFormat', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);

Router::get(MANAGE_ALIAS.'/mls/{id}', 'MlsController@viewListing', ['as' => 'viewListing'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/mls/{listing_id}/requestHandshake', 'MlsController@requestHandshake', ['as' => 'requestHandshake'])->where([ 'listing_id' => '[0-9]+' ]);

Router::post(MANAGE_ALIAS.'/mls/compare/add', 'MlsController@addToCompare', ['as' => 'addToCompare']);
Router::post(MANAGE_ALIAS.'/mls/compare/remove', 'MlsController@removeFromCompare', ['as' => 'removeFromCompare']);

/** LEADS ROUTES */
Router::get(MANAGE_ALIAS.'/leads', 'LeadsController@index', ['as' => 'leads']);
Router::get(MANAGE_ALIAS.'/leads/{id}', 'LeadsController@view', ['as' => 'leadView'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/leads/{id}/edit', 'LeadsController@edit', ['as' => 'leadEdit'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/leads/{id}/delete', 'LeadsController@delete', ['as' => 'leadDelete'])->where([ 'id' => '[0-9]+' ]);

Router::post(MANAGE_ALIAS.'/leads/{id}/saveUpdate', 'LeadsController@saveUpdate', ['as' => 'leadSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

/** THREADS ROUTES */
Router::get(MANAGE_ALIAS.'/threads', 'MessagesController@index', ['as' => 'messages']);
Router::get(MANAGE_ALIAS.'/threads/{id}/downloadThreadMessages', 'MessagesController@downloadThreadMessages', ['as' => 'downloadThreadMessages'])->where([ 'id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/threads/{participants}', 'MessagesController@conversation', ['as' => 'conversation'])->where([ 'participants' => '[\w\-\=]+' ]);
Router::get(MANAGE_ALIAS.'/threads/{participants}/getMessages/{lastMessageId}', 'MessagesController@getMessages', ['as' => 'getMessages'])->where([ 'participants' => '[\w\-\=]+', 'lastMessageId' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/threads/getThreadInfoByParticipants/{participants}', 'MessagesController@getThreadInfoByParticipants', ['as' => 'showMessages'])->where([ 'participants' => '[\w\-\=]+' ]);

Router::get(MANAGE_ALIAS.'/message/stream/{participants}/{lastMessageId}', 'MessagesController@messageStream', ['as' => 'messageStream'])->where([ 'participants' => '[\w\-\=]+', 'lastMessageId' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/threads/getKeys/{participants}', 'MessagesController@getKeys', ['as' => 'getKeys'])->where([ 'participants' => '[\w\-\=]+' ]);

/** MESSAGES ROUTES */
Router::get(MANAGE_ALIAS.'/messages/{thread_id}/removeMessage', 'MessagesController@saveDeletedThread', ['as' => 'saveDeletedThread'])->where([ 'thread_id' => '[0-9]+' ]);
Router::get(MANAGE_ALIAS.'/messages/upload/{filename}/removeAttachment', 'MessagesController@removeAttachment', ['as' => 'removeAttachment'])->where([ 'filename' => '[\w\-\=\.]+' ]);
Router::get(MANAGE_ALIAS.'/downloadFile', 'MessagesController@downloadMessages', ['as' => 'downloadFile']);

Router::post(MANAGE_ALIAS.'/messages/scrapeUrl', 'MessagesController@scrapeUrl', ['as' => 'scrapeUrl']);
Router::post(MANAGE_ALIAS.'/messages/saveNewMessage', 'MessagesController@saveNewMessage', ['as' => 'saveNewMessage']);
Router::post(MANAGE_ALIAS.'/messages/upload', 'MessagesController@uploadAttachment', ['as' => 'uploadMessageAttachment']);
Router::post(MANAGE_ALIAS.'/createDownloadFile', 'MessagesController@createDownloadFile', ['as' => 'createDownloadFile']);

/** ACCOUNT SUBSCRIPTIONS ROUTES */
Router::get(MANAGE_ALIAS.'/subscriptions', 'AccountSubscriptionController@index', ['as' => 'subscriptions']);

Router::post(MANAGE_ALIAS.'/subscriptions/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

if(PREMIUM) {
    /** PREMIUMS ROUTES */
    Router::get(MANAGE_ALIAS.'/premiums', 'PremiumsController@index', ['as' => 'premiums']);

    /** TRANSACTIONS ROUTES */
    Router::get(MANAGE_ALIAS.'/transactions', 'TransactionsController@transactions', ['as' => 'transactions']);
    Router::get(MANAGE_ALIAS.'/transactions/cart/{premium_id}', 'TransactionsController@mycart', ['as' => 'cart'])->where([ 'premium_id' => '[0-9]+' ]);
    Router::get(MANAGE_ALIAS.'/transactions/paymentStatus', 'TransactionsController@paymentStatus', ['as' => 'paymentStatus']);
    Router::get(MANAGE_ALIAS.'/transactions/{id}/invoice', 'TransactionsController@invoice', ['as' => 'invoice'])->where([ 'id' => '[0-9]+' ]);

    Router::post(MANAGE_ALIAS.'/transactions/checkout/{premium_id}', 'TransactionsController@checkout', ['as' => 'checkout'])->where([ 'premium_id' => '[0-9]+' ]);
    Router::post(MANAGE_ALIAS.'/transactions/validateCheckOut', 'TransactionsController@validateCheckOut', ['as' => 'validateCheckOut']);
}

/** INVOICE ROUTES */
Router::get(MANAGE_ALIAS.'/invoices', 'InvoicesController@index', ['as' => 'deleteInvoice']);
Router::get(MANAGE_ALIAS.'/invoices/{id}/delete', 'InvoicesController@delete', ['as' => 'deleteInvoice'])->where([ 'id' => '[0-9]+' ]);


/** DEBUGGING */
Router::get('/debug', 'DebugController@debug', ['as' => 'debug']);