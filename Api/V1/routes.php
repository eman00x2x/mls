<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

Router::group(['prefix' => API_ALIAS], function () {

    /** RESOURCE ROUTES */
    Router::get('/v1/account', 'AccountsController@getAccountDetails');
    Router::get('/v1/properties', 'ListingsController@getPostedProperties');
    Router::get('/v1/properties/{id}', 'ListingsController@getProperty')->where([ 'id' => '[0-9]+' ]);

});