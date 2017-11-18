<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/facebookLogin', 'LoginController@facebookLogin');
Route::post('/googleLogin', 'LoginController@googleLogin');

Route::post('reader/purchases', ['uses' => 'PurchasesController@storeFromReader']);
Route::get('reader/purchases/pending', ['uses' => 'PurchasesController@pendingPurchase']);

Route::middleware(['auth:api'])->group( function () {
    Route::resource('groups', 'GroupController', ['except' => ['create', 'edit', 'delete']]);
    Route::resource('groups.lists', 'ListController', ['except' => ['create', 'edit', 'delete']]);

    Route::get('search/{model}', ['as' => 'search.model', 'uses' => 'SearcherController@search']);

    Route::resource('purchases', 'PurchasesController', ['only' => ['store']]);
    Route::resource('groups.purchases', 'PurchasesController', ['only' => ['index', 'show']]);
    Route::post('/groups/{group}/purchases/{purchase}/associate', ['uses' => 'PurchasesController@associate']);

    Route::post('clients/{client}/deviceToken', ['uses' => 'ClientController@addDeviceToken']);
});
