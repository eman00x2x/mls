<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::enableMultiRouteRendering(false);

/** DASHBOARD ROUTES */

Router::get(ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** NOTIFICATIONS ROUTES */
Router::get(ALIAS.'/articles', 'ArticlesController@index', ['as' => 'index']);
Router::get(ALIAS.'/articles/new', 'ArticlesController@add', ['as' => 'addArticle']);
Router::get(ALIAS.'/articles/{id}', 'ArticlesController@edit', ['as' => 'editArticle'])->where([ 'id' => '[0-9]+' ]);
Router::get(ALIAS.'/articles/{id}/delete', 'ArticlesController@delete', ['as' => 'deleteArticle'])->where([ 'id' => '[0-9]+' ]);

Router::post(ALIAS.'/articles/{id}/save', 'ArticlesController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(ALIAS.'/articles/saveNew', 'ArticlesController@saveNew', ['as' => 'accountSubscriptionSaveNew']);


Router::get('/settings/{page}', 'SettingsController@webSettings', ['as' => 'webSettings'])->where([ 'page' => '[\w\-\=]+' ]);
Router::post('/settings/saveUpdate', 'SettingsController@saveUpdate', ['as' => 'saveUpdate']);

Router::get(ALIAS.'/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::post(ALIAS.'/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);