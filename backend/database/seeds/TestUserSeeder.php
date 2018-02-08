<?php

use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new \App\Profile();
        $profile->save();

        $player = new \App\Player();
        $player->name = 'Test User';
        $player->email = 'testuser@mailinator.com';
        $player->password = \Illuminate\Support\Facades\Hash::make('secret');
        $player->profile_id = $profile->id;
        $player->activated_at = \Carbon\Carbon::now();
        $player->save();
    }
}
