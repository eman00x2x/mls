<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

/** DASHBOARD ROUTES */

Router::get(CS_ALIAS, 'DashboardController@index', ['as' => 'dashboard']);

/** KYC ROUTES */
Router::get(CS_ALIAS.'/kyc', 'KYCController@index', ['as' => 'kycIndex']);
Router::get(CS_ALIAS.'/kyc/{id}/view', 'KYCController@view', ['as' => 'view'])->where([ 'id' => '[0-9]+' ]);

Router::post(CS_ALIAS.'/kyc/{id}/verify', 'KYCController@saveUpdate', ['as' => 'saveKYCUpdate'])->where([ 'kyc_id' => '[0-9]+' ]);

/** ACCOUNT ROUTES */
Router::get(CS_ALIAS . '/account/user/changePassword', 'UsersController@changePassword', ['as' => 'changePassword']);
Router::post(CS_ALIAS . '/account/{id}/user/{user_id}/edit/saveUpdate', 'UsersController@saveUpdate', ['as' => 'usersSaveUpdate'])->where([ 'id' => '[0-9]+', 'user_id' => '[0-9]+' ]);