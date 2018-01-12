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

Route::get('/sign-up', 'SignUpController@index');

Route::post('/sign-up', 'SignUpController@create');

Route::resource('rounds', 'RoundController');
