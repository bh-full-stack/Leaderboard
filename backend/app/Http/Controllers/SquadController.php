<?php

namespace App\Http\Controllers;

use App\Squad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SquadController extends Controller
{

    public function index() {
        return Squad::listSquads();
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
}
