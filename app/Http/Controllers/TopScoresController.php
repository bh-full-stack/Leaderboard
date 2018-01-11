<?php

namespace App\Http\Controllers;

use App\Model\Player;
use App\Model\Round;

class TopScoresController
{
    public function index() {
        return view('layout', [
            "page" => "top-scores",
            "playersData" => Player::listTopPlayersByGame(),
            "listOfGames" => Round::getListOfGames()
        ]);
    }
}