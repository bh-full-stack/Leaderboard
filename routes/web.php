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

Route::get('/', 'TopScoresController@index');

Route::get('/register/activation/{activation_code}', 'Auth\RegisterController@activate');
//Route::post('/sign-up/handle-old-scores', 'SignUpController@handleOldScores');

Route::get('/profile', 'ProfileController@index')->name('profile');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');