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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1'], function() {
    Route::get('/characters', 'CharacterController@index');
    Route::post('/characters', 'CharacterController@create')->middleware('auth:api');
    Route::put('/characters/{id}', 'CharacterController@update');
    Route::delete('/characters/{id}', 'CharacterController@delete');

    Route::post('/login','UserController@login');
    Route::post('/register','UserController@register');
    Route::get('/logout', 'UserController@logout')->middleware('auth:api');
});
