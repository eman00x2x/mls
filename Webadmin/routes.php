<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

/** DASHBOARD ROUTES */

Router::get(WEB_ADMIN_ALIAS.'/', 'DashboardController@index', ['as' => 'dashboard']);

/** ARTICLES ROUTES */
Router::get(WEB_ADMIN_ALIAS.'/articles', 'ArticlesController@index', ['as' => 'index']);
Router::get(WEB_ADMIN_ALIAS.'/articles/new', 'ArticlesController@add', ['as' => 'addArticle']);
Router::get(WEB_ADMIN_ALIAS.'/articles/{id}', 'ArticlesController@edit', ['as' => 'editArticle'])->where([ 'id' => '[0-9]+' ]);
Router::get(WEB_ADMIN_ALIAS.'/articles/{id}/delete', 'ArticlesController@delete', ['as' => 'deleteArticle'])->where([ 'id' => '[0-9]+' ]);

Router::post(WEB_ADMIN_ALIAS.'/articles/{id}/save', 'ArticlesController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(WEB_ADMIN_ALIAS.'/articles/saveNew', 'ArticlesController@saveNew', ['as' => 'articlesSaveNew']);
Router::post(WEB_ADMIN_ALIAS.'/articles/upload', 'ArticlesController@uploadPhoto', ['as' => 'uploadPhoto']);

/** PAGE ADS ROUTES */
Router::get(WEB_ADMIN_ALIAS.'/ads', 'PageAdsController@index', ['as' => 'ads']);
Router::get(WEB_ADMIN_ALIAS.'/ads/new', 'PageAdsController@add', ['as' => 'addAds']);
Router::get(WEB_ADMIN_ALIAS.'/ads/{id}', 'PageAdsController@edit', ['as' => 'editAds'])->where([ 'id' => '[0-9]+' ]);
Router::get(WEB_ADMIN_ALIAS.'/ads/{id}/delete', 'PageAdsController@delete', ['as' => 'deleteAds'])->where([ 'id' => '[0-9]+' ]);

Router::post(WEB_ADMIN_ALIAS.'/ads/{id}/save', 'PageAdsController@saveUpdate', ['as' => 'addAdsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
Router::post(WEB_ADMIN_ALIAS.'/ads/saveNew', 'PageAdsController@saveNew', ['as' => 'addAdsSaveNew']);
Router::post(WEB_ADMIN_ALIAS.'/ads/upload', 'PageAdsController@uploadPhoto', ['as' => 'adsUploadPhoto']);


/** WEB SETTINGS ROUTES */
Router::get(WEB_ADMIN_ALIAS.'/settings/{page}', 'SettingsController@webSettings', ['as' => 'webSettings'])->where([ 'page' => '[\w\-\=]+' ]);
Router::post(WEB_ADMIN_ALIAS.'/settings/saveUpdate', 'SettingsController@saveUpdate', ['as' => 'saveUpdate']);

Router::get(WEB_ADMIN_ALIAS.'/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::post(WEB_ADMIN_ALIAS.'/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);