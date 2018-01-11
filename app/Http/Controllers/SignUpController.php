<?php

namespace App\Http\Controllers;

use App\Model\Player;
use App\Providers\HttpService;

class SignUpController extends Controller
{
    public function index() {
        return view('layout', [
            "page" => "sign-up"
        ]);
    }
    public function create() {
        $player = new Player();
        $player->nick = HttpService::getPostVar('nick');
        $player->email = HttpService::getPostVar('email');
        $player->password_hash = password_hash(HttpService::getPostVar('password'), PASSWORD_DEFAULT);
        $player->save();
        return view('layout', [
            "page" => "sign-up"
        ]);
    }
}