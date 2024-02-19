<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** PAGES ROUTES */
Router::get('/', 'PagesController@index');
Router::get('/about', 'PagesController@about');
Router::get('/contact', 'PagesController@contact');
Router::get('/data-privacy', 'PagesController@privacy');
Router::get('/terms', 'PagesController@terms');

/** ARTICLES ROUTES */
Router::get('/articles', 'ArticlesController@index');
Router::get('/articles/{name}', 'ArticlesController@view')->where([ 'name' => '[\w\-]+' ]);

/** LISTINGS ROUTES */
Router::get('/buy', 'ListingsController@buy');
Router::get('/buy/{category}', 'ListingsController@buy')->where([ 'category' => '[\w\-]+' ]);
Router::get('/buy/{category}/{type}', 'ListingsController@buy')->where([ 'category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get('/rent', 'ListingsController@rent');
Router::get('/rent/{category}', 'ListingsController@rent')->where([ 'category' => '[\w\-]+' ]);
Router::get('/rent/{category}/{type}', 'ListingsController@rent')->where([ 'category' => '[\w\-]+', 'type' => '[\w\-]+' ]);

Router::get('/p-{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);

Router::post('/send-message-{id}', 'ListingsController@sendMessage')->where([ 'id' => '[0-9]+' ]);

/** MLS PUBLIC ROUTES */
Router::get('/mls/{id}', 'ListingsController@mls')->where([ 'id' => '[0-9]+' ]);
Router::get('/comparative-analysis/{uri}', 'ListingsController@comparativeAnalysis')->where([ 'uri' => '[\w\-\=]+' ]);

/** PROFILE ROUTES */
Router::get('/profile/{name}', 'AccountController@profile')->where([ 'name' => '[\w\-]+' ]);