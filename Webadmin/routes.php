<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => WEB_ADMIN_ALIAS], function () {

    /** DASHBOARD ROUTES */
    Router::get('/', 'DashboardController@index', ['as' => 'dashboard']);

    /** ARTICLES ROUTES */
    Router::get('/articles', 'ArticlesController@index', ['as' => 'index']);
    Router::get('/articles/new', 'ArticlesController@add', ['as' => 'addArticle']);
    Router::get('/articles/{id}', 'ArticlesController@edit', ['as' => 'editArticle'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/articles/{id}/delete', 'ArticlesController@delete', ['as' => 'deleteArticle'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/articles/{id}/save', 'ArticlesController@saveUpdate', ['as' => 'saveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/articles/saveNew', 'ArticlesController@saveNew', ['as' => 'articlesSaveNew']);
    Router::post('/articles/upload', 'ArticlesController@uploadPhoto', ['as' => 'uploadPhoto']);

    /** PAGE ADS ROUTES */
    Router::get('/ads', 'PageAdsController@index', ['as' => 'ads']);
    Router::get('/ads/new', 'PageAdsController@add', ['as' => 'addAds']);
    Router::get('/ads/{id}', 'PageAdsController@edit', ['as' => 'editAds'])->where([ 'id' => '[0-9]+' ]);
    Router::get('/ads/{id}/delete', 'PageAdsController@delete', ['as' => 'deleteAds'])->where([ 'id' => '[0-9]+' ]);

    Router::post('/ads/{id}/save', 'PageAdsController@saveUpdate', ['as' => 'addAdsSaveUpdate'])->where([ 'id' => '[0-9]+' ]);
    Router::post('/ads/saveNew', 'PageAdsController@saveNew', ['as' => 'addAdsSaveNew']);
    Router::post('/ads/upload', 'PageAdsController@uploadPhoto', ['as' => 'adsUploadPhoto']);


    /** WEB SETTINGS ROUTES */
    Router::get('/settings/{page}', 'SettingsController@webSettings', ['as' => 'webSettings'])->where([ 'page' => '[\w\-\=]+' ]);
    Router::post('/settings/saveUpdate', 'SettingsController@saveUpdate', ['as' => 'saveUpdate']);

    Router::get('/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
    Router::post('/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);

});