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
    Route::put('profile/{playerId}', 'ProfileController@updateProfile');
    Route::put('password-change', 'Auth\PasswordChangeController@changePassword');
    Route::delete('player/delete', 'Auth\PlayerDeleteController@deletePlayer');

    Route::post('rounds/save-with-account', 'RoundController@store');

    Route::post('squad', 'SquadController@create');
});

Route::get('player/{name}', 'PlayerController@getPlayerByName');
Route::get('profile/{playerId}', 'ProfileController@getProfile');
Route::post('upload', 'UploadController@upload');

Route::post('rounds/save-without-account', 'RoundController@store');
Route::get('rounds/games', 'RoundController@listGames');
Route::resource('rounds', 'RoundController');

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('register/activate', 'Auth\RegisterController@activate');