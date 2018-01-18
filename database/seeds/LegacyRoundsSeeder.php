<?php

use Illuminate\Database\Seeder;

class LegacyRoundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents("http://www.json-generator.com/api/json/get/bPdyglnUoi?indent=2");
        $playersData = json_decode($json);

        foreach ($playersData as $playerData) {
            $location = new \App\Location();
            $location->country = $playerData->country;
            $location->city = $playerData->city;
            $location->save();

            $player = new \App\Player();
            $player->name = $playerData->nick; //db has name
            $player->email = $playerData->email;
            $player->save();

            $round = new \App\Round();
            $round->game = $playerData->game;
            $round->score = $playerData->score;
            $round->location_id = $location->id;
            $round->player_id = $player->id;
            $round->save();
        }
    }
}
