<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get(ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** NOTIFICATIONS ROUTES */
Router::get(ALIAS.'/articles', 'ArticlesController@index', ['as' => 'index']);
Router::get(ALIAS.'/articles/{id}', 'ArticlesController@edit', ['as' => 'editArticle'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/articles/{id}/delete', 'ArticlesController@delete', ['as' => 'deleteArticle'])->where([ 'id' => '[0-9]+' ]);