<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

Router::group(['prefix' => API_ALIAS], function () {

    /** RESOURCE ROUTES */
    Router::get('/V1/account', 'AccountsController@getAccountDetails');
    Router::get('/V1/properties', 'ListingsController@getPostedProperties');
    Router::get('/V1/properties/{id}', 'ListingsController@getProperty')->where([ 'id' => '[0-9]+' ]);

});