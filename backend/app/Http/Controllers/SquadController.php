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

    public function show($id) {
        return Squad::with('players')->findOrFail($id);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'unique:squads'
        ]);

        $squad = new Squad();
        $squad->name = $request['name'];
        $squad->color = $request['color'];
        $squad->save();

        $player = Auth::user();

        $squad->players()->attach($player->id);

        return $squad;
    }

    public function join(Request $request) {
        $player = Auth::user();

        $player->squads()->attach($request['id']);
    }

    public function leave(Request $request) {
        $player = Auth::user();
        $squad_id = $request['id'];

        $player->squads()->detach($squad_id);

        if (!Squad::hasPlayer($squad_id)) {
            Squad::find($squad_id)->delete();
        }
    }

}
