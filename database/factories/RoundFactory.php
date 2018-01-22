<?php

use Faker\Generator as Faker;

$factory->define(\App\Round::class, function (Faker $faker) {
    return [
        "game" => ["Tetris", "Mario", "Yoyo", "Monopoly"][rand(0, 3)],
        "score" => $faker->numberBetween(0, 1000),
        "location_id" => 1,
    ];
});
