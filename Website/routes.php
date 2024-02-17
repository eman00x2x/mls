<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get('/', 'PagesController@index');
Router::get('/about', 'PagesController@about');
Router::get('/contact', 'PagesController@contact');
Router::get('/data-privacy', 'PagesController@privacy');
Router::get('/terms', 'PagesController@terms');

Router::get('/articles', 'ArticlesController@index');
Router::get('/articles/{name}', 'ArticlesController@view')->where([ 'name' => '[\w\-]+' ]);

Router::get('/buy', 'ListingsController@buy');
Router::get('/rent', 'ListingsController@rent');
Router::get('/p-{name}', 'ListingsController@view')->where([ 'name' => '[\w\-]+' ]);
Router::get('/mls/{id}', 'ListingsController@mls')->where([ 'id' => '[0-9]+' ]);

Router::get('/profile/{name}', 'AccountController@profile')->where([ 'name' => '[\w\-]+' ]);

Router::get('/send-message-{id}', 'ListingsController@sendMessage')->where([ 'id' => '[0-9]+' ]);

Router::get('/comparative-analysis/{uri}', 'ListingsController@comparativeAnalysis')->where([ 'uri' => '[\w\-\=]+' ]);
