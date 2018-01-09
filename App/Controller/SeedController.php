<?php

namespace App\Controller;
use App\Model\Location;
use App\Model\Model;
use App\Model\Player;
use App\Model\Round;

class SeedController
{
    public function seed() {
        $json = file_get_contents("http://www.json-generator.com/api/json/get/bPdyglnUoi?indent=2");
        $playersData = json_decode($json);
        Model::deleteAll("players");
        Model::deleteAll("locations");
        Model::deleteAll("rounds");

        foreach ($playersData as $playerData) {

            $location = new Location();
            $location->country = $playerData->country;
            $location->city = $playerData->city;
            $location->save();

            $player = new Player();
            $player->nick = $playerData->nick;
            $player->email = $playerData->email;
            $player->save();

            $round = new Round();
            $round->game = $playerData->game;
            $round->score = $playerData->score;
            $round->location_id = $location->id;
            $round->player_id = $player->id;
            $round->save();

            echo $player->nick . "\n";
        }
    }
}