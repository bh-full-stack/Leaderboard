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

Route::resource('/sign-up', 'SignUpController');

Route::get('/sign-up/activation/{activation_code}', 'SignUpController@activate');