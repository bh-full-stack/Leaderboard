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
    Route::post('profile/handle-old-scores', 'ProfileController@handleOldScores');
});

Route::get('rounds/games', 'RoundController@listGames');
Route::resource('rounds', 'RoundController');

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('register/activate', 'Auth\RegisterController@activate');

Route::get('profile/{id}', 'ProfileController@getProfile');
Route::put('profile/{id}', 'ProfileController@updateProfile');