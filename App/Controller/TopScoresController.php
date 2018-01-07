<?php

namespace App\Controller;

use App\Model\Player;

class TopScoresController
{
    public function index() {
        if (isset($_GET['sort-by'])) Player::setListSorting($_GET['sort-by']);
        if (isset($_GET['sort-direction'])) Player::setListSorting(null, $_GET['sort-direction']);
        $playersData = Player::list();
        include "../templates/layout.php";
    }
}