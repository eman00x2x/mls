<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

Router::group(['prefix' => WEB_ALIAS], function () {

    /** PAGES ROUTES */
    Router::get('/', 'HomeController@index');
    Router::get('/about', 'PagesController@about');
    Router::get('/contact', 'PagesController@contact');
    Router::get('/data-privacy', 'PagesController@privacy');
    Router::get('/terms', 'PagesController@terms');

    Router::get('/featuredPost', 'HomeController@featuredPost');
    Router::get('/latestArticles', 'HomeController@latestArticles');
    Router::get('/popularLocations', 'HomeController@popularLocations');

    /** ARTICLES ROUTES */
    Router::get('/articles', 'ArticlesController@index');
    Router::get('/articles/{name}', 'ArticlesController@view')->where([ 'name' => '[\w\-]+' ]);

    /** LISTINGS ROUTES */
    Router::get('/buy', 'ListingsController@buy');
    Router::get('/buy/{category}', 'ListingsController@buy')->where([ 'category' => '[\w\-]+' ]);
    Router::get('/buy/{category}/{type}', 'ListingsController@buy')->where(['category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

    Router::get('/rent', 'ListingsController@rent');
    Router::get('/rent/{category}', 'ListingsController@rent')->where([  'category' => '[\w\-]+' ]);
    Router::get('/rent/{category}/{type}', 'ListingsController@rent')->where([  'category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

    Router::get('/p-{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);
    Router::get('/related-properties', 'ListingsController@relatedProperties');

    Router::post('/validate-message', 'ListingsController@validateMessageInput');
    Router::post('/send-message-{id}', 'ListingsController@sendMessage')->where([ 'id' => '[0-9]+' ]);

    /** MLS PUBLIC ROUTES */
    Router::get('/mls/{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);
    Router::get('/comparative-analysis/{uri}', 'ListingsController@comparativeAnalysis')->where([ 'uri' => '[\w\-\=]+' ]);

    /** MEMBER ROUTES */
    Router::get('/members', 'AccountsController@memberDirectory');

    /** PROFILE ROUTES */
    Router::get('/profile/{id}/{name}', 'AccountsController@profile')->where([ 'id' => '[0-9]+', 'name' => '[\w\-]+' ]);
    Router::get('/profile/{id}/{name}/listings', 'AccountsController@accountListings')->where([ 'id' => '[0-9]+', 'name' => '[\w\-]+' ]);
    Router::get('/profile/{id}', 'AccountsController@profilePreview')->where([ 'id' => '[0-9]+' ]);

    /** ADS ROUTES */
    Router::get('/showAds/{placement}', 'PageAdsController@showAds')->where([ 'placement' => '[\w\-]+' ]);
    
    Router::get('/getCurrencyConverter', 'ListingsController@getCurrencyConverter');
    Router::get('/listings/getThumbnail', 'ListingsController@getThumbnail', ['as' => 'getThumbnail']);
    Router::post('/tracker', 'SessionController@saveTraffic', ['as' => 'saveTraffic']);

});