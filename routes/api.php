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

Route::get('/keywords', 'IndexController@getKeywords');
Route::get('/sites', 'IndexController@getSites');
Route::post('/stats', 'IndexController@getStats');
