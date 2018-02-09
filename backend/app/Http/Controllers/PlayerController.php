<?php

namespace App\Http\Controllers;

use App\Mail\LegacyPlayersNotification;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PlayerController extends Controller
{
    public function __construct() {
        //
    }

    public function getPlayerByName(Request $request) {
        return Player::getByName($request->name);
    }

    public function sendNotification() {
        $legacyPlayers = Player::getLegacyPlayers();

        foreach ($legacyPlayers as $player) {
            $email = preg_replace('/@.+/', '@mailinator.com', $player->email);

            Mail::to(["email" => $email])
                ->send(new LegacyPlayersNotification($player));

            echo $email . "\n";
        }
    }

}