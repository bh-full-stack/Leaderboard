<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('garbage:collect', function () {
    \App\Picture::garbageCollection();
})->describe('Find and delete unused pictures');

Artisan::command('players:notify', function () {
    (new \App\Http\Controllers\PlayerController())->sendNotification();
})->describe('Send notification email to legacy players');
