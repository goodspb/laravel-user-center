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

/* 首页 */
Route::get('/', [
    'middleware' => ['auth'],
    'uses' => function () {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        }
        return redirect('/user');
    },
]);

/* 登录管理 */
Route::group(['prefix' => '/auth', 'namespace' => 'Auth', 'middleware' => 'csrf'], function () {
    Route::controller('/forgot', 'PasswordController');
    Route::controller('/', 'AuthController');
});

/* 前台用户页面 */
Route::group(['prefix' => '/user', 'namespace' => 'Front', 'middleware' => ['auth', 'csrf']], function() {
    Route::controller('/', 'UserController');
});

/* 后台管理 */
Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin', 'csrf']], function () {
    Route::group(['prefix' => '/oauth', 'namespace' => 'Oauth'], function () {
        Route::controller('/grant', 'GrantController');
        Route::controller('/client', 'ClientController');
        Route::controller('/scope', 'ScopeController');
    });
    Route::controller('/permission', 'PermissionController');
    Route::controller('/role', 'RoleController');
    Route::controller('/user', 'UserController');
    Route::controller('/setting', 'SettingController');
    Route::controller('/', 'IndexController');
});

/* Oauth Authorizer */
Route::group(['prefix' => '/oauth'], function () {
    Route::post('/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });
    Route::get('/authorize', [
        'as' => 'oauth.authorize.get',
        'middleware' => ['check-authorization-params', 'auth'],
        'uses' => 'Api\OauthController@getAuthorize',
    ]);
    Route::post('oauth/authorize', [
        'as' => 'oauth.authorize.post',
        'middleware' => ['csrf', 'check-authorization-params', 'auth'],
        'uses' => 'Api\OauthController@postAuthorize',
    ]);
});

/* Api 接口路由 */
Route::group(['prefix' => '/api', 'namespace' => 'Api' , 'middleware' => ['oauth']], function() {
    Route::resource('/profile', 'Resource\ProfileController');
    Route::resource('/mobile', 'Resource\MobileController');
    Route::resource('/password', 'Resource\PasswordController');
});
