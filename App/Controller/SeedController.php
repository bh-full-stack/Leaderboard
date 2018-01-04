<?php

namespace App\Controller;
use App\Model\Player;

class SeedController
{
    public function seed() {
        $json = file_get_contents("http://www.json-generator.com/api/json/get/bPdyglnUoi?indent=2");
        $playersData = json_decode($json, true);
        Player::deleteAll();

        foreach ($playersData as $playerData) {
            $player = new Player();
            $player->fillAttributes($playerData)->save();
        }
    }
}