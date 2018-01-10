<?php

namespace App\Controller;

use App\Model\Player;
use App\Model\Round;

class TopScoresController
{
    public function index() {
        $playersData = Player::listTopPlayersByGame();
        $listOfGames = Round::getListOfGames();
        include "../templates/layout.php";
    }
}