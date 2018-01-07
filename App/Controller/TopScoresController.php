<?php

namespace App\Controller;

use App\Model\Player;

class TopScoresController
{
    public function index() {
        $playersData = Player::list();
        if (Player::$sort) {
            include "../templates/top-scores.php";
        } else {
            include "../templates/layout.php";
        }
    }
}