<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// Home
Route::get('/', 'HomeController@home')->name('home');

// Panel Routes
Route::middleware(['auth'])->group( function () {

    Route::middleware(['role:' . \App\Role::ADMIN_USERS])->group( function () {
        Route::resource('users','UserController', ['except' => ['show']]);
        Route::get('users/{user}/delete', 'UserController@delete')->name('users.delete');
        Route::get('users/{user}/restore', 'UserController@restoreView')->name('users.restoreView');
        Route::put('users/{user}/restore', 'UserController@restore')->name('users.restore');
    });


    Route::middleware(['role:' . \App\Role::CASHIER])->group( function () {
        Route::resource('purchases', 'PurchaseController');
    });

    Route::middleware(['role:' . \App\Role::ADMIN_PUSH])->group( function () {
        Route::get('notifications', 'NotificationController@index')->name('notifications.index');
        Route::get('notifications/create', 'NotificationController@create')->name('notifications.create');
        Route::post('notifications', 'NotificationController@store')->name('notifications.store');
    });

});