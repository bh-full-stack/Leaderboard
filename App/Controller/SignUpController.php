<?php

namespace App\Controller;

use App\Model\Player;
use App\Service\HttpService;

class SignUpController
{
    public function index() {
        $page = "sign-up";
        include "../templates/layout.php";
    }
    public function create() {
        $player = new Player();
        $player->nick = HttpService::getPostVar('nick');
        $player->email = HttpService::getPostVar('email');
        $player->password_hash = password_hash(HttpService::getPostVar('password'), PASSWORD_DEFAULT);
        $player->save();
        $page = "sign-up";
        include "../templates/layout.php";
    }

}