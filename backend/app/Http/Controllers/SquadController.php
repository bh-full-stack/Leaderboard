<?php

namespace App\Http\Controllers;

use App\Squad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SquadController extends Controller
{
    public function create(Request $request) {
        $squad = new Squad();
        $squad->name = $request['squad']['name'];
        $squad->color = $request['squad']['color'];
        $squad->save();

        $player = Auth::user();

        $squad->players()->attach($player->id);

        return $squad;
    }
}
