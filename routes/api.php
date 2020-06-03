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

Route::get('/characters', 'CharacterController@index');
Route::post('/characters', 'CharacterController@create');
Route::put('/characters/{id}', 'CharacterController@update');
Route::delete('/characters/{id}', 'CharacterController@delete');
