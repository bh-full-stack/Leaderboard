<?php

namespace App\Controller;

use App\Model\Player;

class TopScoresController
{
    public function index() {
        $sortBy = isset($_GET['sort-by']) ? $_GET['sort-by'] : null;
        $sortDir = isset($_GET['sort-dir']) ? $_GET['sort-dir'] : null;
        $playerAttributeNames = Player::getAttributeNames();
        $playersData = Player::list($sortBy, $sortDir);
        include "../templates/layout.php";
    }
}