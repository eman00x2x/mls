<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** PAGES ROUTES */
Router::get( ALIAS . '/', 'PagesController@index');
Router::get( ALIAS . '/about', 'PagesController@about');
Router::get( ALIAS . '/contact', 'PagesController@contact');
Router::get( ALIAS . '/data-privacy', 'PagesController@privacy');
Router::get( ALIAS . '/terms', 'PagesController@terms');

/** ARTICLES ROUTES */
Router::get( ALIAS . '/articles', 'ArticlesController@index');
Router::get( ALIAS . '/articles/{name}', 'ArticlesController@view')->where([ 'name' => '[\w\-]+' ]);

/** LISTINGS ROUTES */
Router::get( ALIAS . '/buy', 'ListingsController@buy');
Router::get( ALIAS . '/buy/{category}', 'ListingsController@buy')->where([ 'category' => '[\w\-]+' ]);
Router::get( ALIAS . '/buy/{category}/{type}', 'ListingsController@buy')->where(['category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get( ALIAS . '/rent', 'ListingsController@rent');
Router::get( ALIAS . '/rent/{category}', 'ListingsController@rent')->where([  'category' => '[\w\-]+' ]);
Router::get( ALIAS . '/rent/{category}/{type}', 'ListingsController@rent')->where([  'category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get( ALIAS . '/p-{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);

Router::post(ALIAS . '/send-message-{id}', 'ListingsController@sendMessage')->where([ 'id' => '[0-9]+' ]);

/** MLS PUBLIC ROUTES */
Router::get( ALIAS . '/mls/{id}', 'ListingsController@mls')->where([ 'id' => '[0-9]+' ]);
Router::get( ALIAS . '/comparative-analysis/{uri}', 'ListingsController@comparativeAnalysis')->where([ 'uri' => '[\w\-\=]+' ]);

/** PROFILE ROUTES */
Router::get( ALIAS . '/profile/{name}', 'AccountController@profile')->where([ 'name' => '[\w\-]+' ]);