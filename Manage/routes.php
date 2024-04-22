<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => MANAGE_ALIAS], function () {

    /** DASHBOARD ROUTES */
    Router::get('/', 'DashboardController@index', ['as' => 'dashboard']);

    /** NOTIFICATIONS ROUTES */
    Router::get('/notifications', 'NotificationsController@index', ['as' => 'index']);
    Router::get('/notifications/getLatest', 'NotificationsController@getLatest', ['as' => 'getLatest']);
    Router::get('/notifications-{id}-update-status', 'NotificationsController@updateNotification', ['as' => 'updateNotification'])->where([ 'id' => '[0-9]+' ]);

    /** ACCOUNTS ROUTES */
    Router::get('/account', 'AccountsController@index', ['as' => 'accounts']);
    Router::get('/account', 'AccountsController@view', ['as' => 'accountView']);
    Router::get('/account/profile', 'AccountsController@profile', ['as' => 'profile']);
    Router::get('/account/profile/{id}/preview', 'AccountsController@profilePreview', ['as' => 'profile'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/account/{id}/saveUpdate', 'AccountsController@saveUpdate', ['as' => 'accountsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/account/uploadPhoto', 'AccountsController@uploadPhoto', ['as' => 'accountsUploadPhoto']);

    /** KYC ROUTES */
    Router::get('/kyc', 'KYCController@kycVerificationForm', ['as' => 'kycVerificationForm']);

    Router::post('/kyc/{id}/kycVerificationForm', 'KYCController@saveNew', ['as' => 'saveNewKYC'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/kyc/{id}/kycDocsUpload', 'KYCController@kycDocsUpload', ['as' => 'kycDocsUpload'])->where([ 'id' => '[0-9]+' ]);

    /** USERS ROUTES */
    Router::get('/account/users', 'UsersController@index', ['as' => 'users']);
    Router::get('/account/user/new', 'UsersController@new', ['as' => 'userAdd']);
    Router::get('/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
    Router::get('/account/{id}/user/{user_id}/edit', 'UsersController@edit', ['as' => 'userEdit'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::get('/account/{id}/user/{user_id}/delete', 'UsersController@delete', ['as' => 'userDelete'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

    Router::post('/account/{id}/user/saveNew', 'UsersController@saveNew', ['as' => 'usersSaveNew'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);
    Router::post('/account/user/uploadPhoto', 'UsersController@uploadPhoto', ['as' => 'usersUploadPhoto']);

    /** USERS MANAGE_ALIAS ROUTES */
    Router::get('/user/{id}/edit', 'UsersController@userEdit', ['as' => 'userMANAGE_ALIASEdit'])->where([ 'id' => '[0-9]+' ]);

    /** PROPERTY LISTINGS ROUTES */
    Router::get('/listings', 'ListingsController@index', ['as' => 'listings']);
    Router::get('/listings/new', 'ListingsController@add', ['as' => 'listingsAdd']);
    Router::get('/listings/{id}', 'ListingsController@view', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/{id}/edit', 'ListingsController@edit', ['as' => 'listingsEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/{id}/sold', 'ListingsController@soldSettings', ['as' => 'listingsSoldSettings'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/{id}/featured', 'ListingsController@setFeatured', ['as' => 'listingsSetFeatured'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/{id}/delete', 'ListingsController@delete', ['as' => 'listingsDelete'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/{id}/remove', 'ListingsController@remove', ['as' => 'listingsRemove'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/listings/downloadPropertyListings', 'ListingsController@downloadPropertyListings', ['as' => 'downloadPropertyListings']);
    Router::get('/listings/getThumbnail', 'ListingsController@getThumbnail', ['as' => 'getThumbnail']);

    Router::post('/listings/{id}/setSold', 'ListingsController@setSold', ['as' => 'listingsSetSold'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/listings/{id}/uploadImages', 'ListingsController@uploadImages', ['as' => 'uploadImages'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/listings/new/saveNew', 'ListingsController@saveNew', ['as' => 'listingsSaveNew'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/listings/{id}/edit/saveUpdate', 'ListingsController@saveUpdate', ['as' => 'listingsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

    /** PROPERTY IMAGES ROUTES */
    Router::get('/listingImages/{id}/delete', 'ListingImagesController@delete', ['as' => 'ListingImagesDelete'])->where([ 'id' => '[0-9]+' ]);

    /** MLS ROUTES */
    Router::get('/mls', 'MlsController@MLSIndex', ['as' => 'mls']);
    Router::get('/mls/region/{region}', 'MlsController@MLSRegional', ['as' => 'MLSRegional'])->where([ 'region' => '[\w\-\=]+' ]);
    Router::get('/mls/board/{local_board}', 'MlsController@MLSLocalBoard', ['as' => 'MLSLocalBoard'])->where([ 'local_board' => '[\w\-\=]+' ]);

    Router::get('/mls/handshaked', 'MlsController@handshakedIndex', ['as' => 'handshakedIndex']);
    Router::get('/mls/compare', 'MlsController@compareListings', ['as' => 'compareListings']);
    Router::get('/mls/comparePreview', 'MlsController@comparePreview', ['as' => 'comparePreview']);
    Router::get('/mls/handshaked/{id}/acceptRequest', 'MlsController@acceptRequest', ['as' => 'acceptRequest'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/mls/handshaked/{id}/deniedRequest', 'MlsController@deniedRequest', ['as' => 'deniedRequest'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/mls/handshaked/{id}/doneHandshake', 'MlsController@doneHandshake', ['as' => 'doneHandshake'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/mls/handshaked/{listing_id}/cancelHandshake', 'MlsController@cancelHandshake', ['as' => 'cancelHandshake'])->where([ 'listing_id' => '[0-9]+' ]);
    Router::get('/mls/related-properties', 'MlsController@relatedProperties', ['as' => 'relatedProperties']);

    /** DOWNLOAD MLS LISTING URL */
    Router::get('/mls/{id}/download', 'MlsController@downloadPDFFormat', ['as' => 'listingsView'])->where([ 'id' => '[0-9]+' ]);

    Router::get('/mls/{id}', 'MlsController@viewListing', ['as' => 'viewListing'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/mls/{listing_id}/requestHandshake', 'MlsController@requestHandshake', ['as' => 'requestHandshake'])->where([ 'listing_id' => '[0-9]+' ]);

    Router::post('/mls/compare/add', 'MlsController@addToCompare', ['as' => 'addToCompare']);
    Router::post('/mls/compare/remove', 'MlsController@removeFromCompare', ['as' => 'removeFromCompare']);

    /** LEADS ROUTES */
    Router::get('/leads', 'LeadsController@index', ['as' => 'leads']);
    Router::get('/leads/add', 'LeadsController@add', ['as' => 'leadAdd']);
    Router::get('/leads/{id}', 'LeadsController@view', ['as' => 'leadView'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/leads/{id}/edit', 'LeadsController@edit', ['as' => 'leadEdit'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/leads/{id}/delete', 'LeadsController@delete', ['as' => 'leadDelete'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/leads/saveNew', 'LeadsController@saveNew', ['as' => 'leadSaveNew']);
    Router::post('/leads/{id}/saveUpdate', 'LeadsController@saveUpdate', ['as' => 'leadSaveUpdate'])->where([ 'id' => '[0-9]+' ]);

    /** THREADS ROUTES */
    Router::get('/threads', 'MessagesController@index', ['as' => 'messages']);
    Router::get('/threads/{id}/downloadThreadMessages', 'MessagesController@downloadThreadMessages', ['as' => 'downloadThreadMessages'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/threads/{participants}', 'MessagesController@conversation', ['as' => 'conversation'])->where([ 'participants' => '[\w\-\=]+' ]);
    Router::get('/threads/{participants}/getMessages/{lastMessageId}', 'MessagesController@getMessages', ['as' => 'getMessages'])->where([ 'participants' => '[\w\-\=]+', 'lastMessageId' => '[0-9]+' ]);
    Router::get('/threads/getThreadInfoByParticipants/{participants}', 'MessagesController@getThreadInfoByParticipants', ['as' => 'showMessages'])->where([ 'participants' => '[\w\-\=]+' ]);

    Router::get('/message/stream/{participants}/{lastMessageId}', 'MessagesController@messageStream', ['as' => 'messageStream'])->where([ 'participants' => '[\w\-\=]+', 'lastMessageId' => '[0-9]+' ]);
    Router::get('/threads/getKeys/{participants}', 'MessagesController@getKeys', ['as' => 'getKeys'])->where([ 'participants' => '[\w\-\=]+' ]);

    /** MESSAGES ROUTES */
    Router::get('/messages/{thread_id}/removeMessage', 'MessagesController@saveDeletedThread', ['as' => 'saveDeletedThread'])->where([ 'thread_id' => '[0-9]+' ]);
    Router::get('/messages/upload/{filename}/removeAttachment', 'MessagesController@removeAttachment', ['as' => 'removeAttachment'])->where([ 'filename' => '[\w\-\=\.]+' ]);
    Router::get('/downloadFile', 'MessagesController@downloadMessages', ['as' => 'downloadFile']);

    Router::get('/messages/scrapeUrl', 'MessagesController@scrapeUrl', ['as' => 'scrapeUrl']);
    Router::post('/messages/saveNewMessage', 'MessagesController@saveNewMessage', ['as' => 'saveNewMessage']);
    Router::post('/messages/upload', 'MessagesController@uploadAttachment', ['as' => 'uploadMessageAttachment']);
    Router::post('/createDownloadFile', 'MessagesController@createDownloadFile', ['as' => 'createDownloadFile']);

    /** ACCOUNT SUBSCRIPTIONS ROUTES */
    Router::get('/subscriptions', 'AccountSubscriptionController@index', ['as' => 'subscriptions']);

    Router::post('/subscriptions/saveNew', 'AccountSubscriptionController@saveNew', ['as' => 'accountSubscriptionSaveNew']);

    if(PREMIUM) {
        /** PREMIUMS ROUTES */
        Router::get('/premiums', 'PremiumsController@index', ['as' => 'premiums']);

        /** TRANSACTIONS ROUTES */
        Router::get('/transactions', 'TransactionsController@transactions', ['as' => 'transactions']);
        Router::get('/transactions/cart/{premium_id}', 'TransactionsController@mycart', ['as' => 'cart'])->where([ 'premium_id' => '[0-9]+' ]);
        Router::get('/transactions/{id}/invoice', 'TransactionsController@invoice', ['as' => 'invoice'])->where([ 'id' => '[0-9]+' ]);

        Router::post('/transactions/checkout/{premium_id}', 'TransactionsController@checkout', ['as' => 'checkout'])->where([ 'premium_id' => '[0-9]+' ]);

        /** PAYPAL */
        Router::get('/transactions/paymentStatus', 'TransactionsController@paymentStatus', ['as' => 'paymentStatus']);
        Router::post('/transactions/validateCheckOut', 'TransactionsController@validateCheckOut', ['as' => 'validateCheckOut']);
    
        /** XENDIT */
        Router::post('/transactions/xenditCreateInvoce', 'TransactionsController@xenditCreateInvoce', ['as' => 'xenditCreateInvoce']);
        
    }

    /** INVOICE ROUTES */
    Router::get('/invoices', 'InvoicesController@index', ['as' => 'deleteInvoice']);
    Router::get('/invoices/{id}/delete', 'InvoicesController@delete', ['as' => 'deleteInvoice'])->where([ 'id' => '[0-9]+' ]);

    Router::get('/getCurrencyConverter', 'ListingsController@getCurrencyConverter');
    Router::post('/tracker', 'SessionController@saveTraffic', ['as' => 'saveTraffic']);

    /** DEBUGGING */
    Router::get('/debug', 'DebugController@debug', ['as' => 'debug']);

});