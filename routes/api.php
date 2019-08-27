<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1'], function() {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('login', 'AuthController@login');

    Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function() {
        Route::get('dialogs', 'DialogsController@getAll');
        Route::get('message/{dialog}', 'MessagesController@getAll');
        Route::post('message/{dialog}', 'MessagesController@send');        
    });    
});