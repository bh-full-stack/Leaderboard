<?php

namespace App\Http\Controllers;

use App\Player;
use App\Squad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SquadController extends Controller
{
    public function index() {
        if (!Auth::user()) {
            return Squad::listSquads();
        }
        return Squad::listSquadsWithAuth();
    }

    public function create(Request $request) {
        $squad = new Squad();
        $squad->name = $request['squad']['name'];
        $squad->color = $request['squad']['color'];
        $squad->save();

        $player = Auth::user();

        $squad->players()->attach($player->id);

        return $squad;
    }

    public function join(Request $request) {
        $player = Auth::user();

        $player->squads()->attach($request['squad']['id']);
    }

    public function leave(Request $request) {
        $player = Auth::user();
        $squad_id = $request['squad']['id'];

        $player->squads()->detach($squad_id);

        if (!Squad::hasPlayer($squad_id)) {
            Squad::find($squad_id)->delete();
        }
    }

    public function getSquadsOfPlayer($playerId) {
        return Player::with("squads")->find($playerId);
    }
}
