<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** RESOURCE ROUTES */
Router::get( API_ALIAS . '/v1/account', 'AccountsController@getAccountDetails');
Router::get( API_ALIAS . '/v1/properties', 'ListingsController@getPostedProperties');
Router::get( API_ALIAS . '/v1/properties/{id}', 'ListingsController@getProperty')->where([ 'id' => '[0-9]+' ]);