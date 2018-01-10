<?php

namespace App\Controller;

use App\Model\Player;

class TopScoresController
{
    public function index() {
        $playersData = Player::listTopPlayersByGame();
        include "../templates/layout.php";
    }
}