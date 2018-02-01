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

Route::group(['middleware' => ['jwt.auth']], function () {
     //
});

Route::get('rounds/games', 'RoundController@listGames');
Route::resource('rounds', 'RoundController');

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('register/activate', 'Auth\RegisterController@activate');
