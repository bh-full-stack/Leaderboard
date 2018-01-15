<?php

namespace App\Http\Controllers;

use App\Player;
use App\Round;

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