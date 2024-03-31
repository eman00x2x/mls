<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** PAGES ROUTES */
Router::get( WEB_ALIAS . '/', 'HomeController@index');
Router::get( WEB_ALIAS . '/about', 'PagesController@about');
Router::get( WEB_ALIAS . '/contact', 'PagesController@contact');
Router::get( WEB_ALIAS . '/data-privacy', 'PagesController@privacy');
Router::get( WEB_ALIAS . '/terms', 'PagesController@terms');

Router::get( WEB_ALIAS . '/featuredPost', 'HomeController@featuredPost');
Router::get( WEB_ALIAS . '/latestArticles', 'HomeController@latestArticles');
Router::get( WEB_ALIAS . '/popularLocations', 'HomeController@popularLocations');

/** ARTICLES ROUTES */
Router::get( WEB_ALIAS . '/articles', 'ArticlesController@index');
Router::get( WEB_ALIAS . '/articles/{name}', 'ArticlesController@view')->where([ 'name' => '[\w\-]+' ]);

/** LISTINGS ROUTES */
Router::get( WEB_ALIAS . '/buy', 'ListingsController@buy');
Router::get( WEB_ALIAS . '/buy/{category}', 'ListingsController@buy')->where([ 'category' => '[\w\-]+' ]);
Router::get( WEB_ALIAS . '/buy/{category}/{type}', 'ListingsController@buy')->where(['category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get( WEB_ALIAS . '/rent', 'ListingsController@rent');
Router::get( WEB_ALIAS . '/rent/{category}', 'ListingsController@rent')->where([  'category' => '[\w\-]+' ]);
Router::get( WEB_ALIAS . '/rent/{category}/{type}', 'ListingsController@rent')->where([  'category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get( WEB_ALIAS . '/p-{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);
Router::get( WEB_ALIAS . '/related-properties', 'ListingsController@relatedProperties');

Router::post(WEB_ALIAS . '/validate-message', 'ListingsController@validateMessageInput');
Router::post(WEB_ALIAS . '/send-message-{id}', 'ListingsController@sendMessage')->where([ 'id' => '[0-9]+' ]);

/** MLS PUBLIC ROUTES */
Router::get( WEB_ALIAS . '/mls/{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);
Router::get( WEB_ALIAS . '/comparative-analysis/{uri}', 'ListingsController@comparativeAnalysis')->where([ 'uri' => '[\w\-\=]+' ]);

/** PROFILE ROUTES */
Router::get( WEB_ALIAS . '/profile/{name}', 'AccountController@profile')->where([ 'name' => '[\w\-]+' ]);

/** ADS ROUTES */
Router::get( WEB_ALIAS . '/showAds/{placement}', 'PageAdsController@showAds')->where([ 'placement' => '[\w\-]+' ]);