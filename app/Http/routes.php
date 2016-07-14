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

Route::group(['prefix' => '/auth', 'namespace' => 'Auth'], function () {
    Route::controller('/forgot', 'PasswordController');
    Route::controller('/', 'AuthController');
});

Route::group(['prefix' => '/admin' , 'namespace' => 'Admin' , 'middleware' => ['auth', 'role:admin']] , function () {
    Route::controller('/permission', 'PermissionController');
    Route::controller('/role', 'RoleController');
    Route::controller('/user', 'UserController');
    Route::controller('/', 'IndexController');
});
