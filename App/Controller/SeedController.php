<?php

namespace App\Controller;
use App\Model\Player;

class SeedController
{
    public function seed() {
        $json = file_get_contents("http://www.json-generator.com/api/json/get/bPdyglnUoi?indent=2");
        $playersData = json_decode($json);
        Player::deleteAll();

        foreach ($playersData as $playerData) {
            $player = new Player();
            $player->email = $playerData->email;
            $player->nick = $playerData->nick;
            $player->game = $playerData->game;
            $player->score = $playerData->score;
            $player->country = $playerData->country;
            $player->city = $playerData->city;
            $player->save();
            var_dump($player);
        }
    }
}