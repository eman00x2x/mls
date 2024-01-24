<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get('/', 'PagesController@index');
