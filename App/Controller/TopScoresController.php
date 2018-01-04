<?php

namespace App\Controller;

use App\Model\Player;

class TopScoresController
{
    public function index() {
        $playersData = Player::list();
        include "../templates/layout.php";
    }
}