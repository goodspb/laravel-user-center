<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('admin');
});

/* 登录管理 */
Route::group(['prefix' => '/auth', 'namespace' => 'Auth', 'middleware' => 'csrf'], function () {
    Route::controller('/forgot', 'PasswordController');
    Route::controller('/', 'AuthController');
});

/* 后台管理 */
Route::group(['prefix' => '/admin' , 'namespace' => 'Admin' , 'middleware' => ['auth', 'role:admin', 'csrf']] , function () {
    Route::group(['prefix' => '/oauth', 'namespace' => 'Oauth' ], function() {
        Route::controller('/grant', 'GrantController');
        Route::controller('/client', 'ClientController');
        Route::controller('/scope', 'ScopeController');
    });
    Route::controller('/permission', 'PermissionController');
    Route::controller('/role', 'RoleController');
    Route::controller('/user', 'UserController');
    Route::controller('/', 'IndexController');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});