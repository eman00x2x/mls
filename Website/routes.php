<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get('/', 'PagesController@index');
Router::get('/buy', 'ListingsController@index');
Router::get('/rent', 'ListingsController@index');

Router::get('/data-privacy', 'PagesController@privacy');
Router::get('/terms', 'PagesController@terms');
Router::get('/refund-policy', 'PagesController@refundPolicy');
