<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Squad extends Model
{
    public $fillable = ["name", "color"];

    public function players() {
        return $this->belongsToMany(Player::class)->withTimestamps();
    }

    public static function listSquads() {
        return self::all();
    }
    
    public static function hasPlayer($squad_id) {
        return DB::connection(env("DB_CONNECTION"))
            ->table("player_squad")
            ->where("squad_id", "=", $squad_id)
            ->count();
    }

    public static function listSquadsWithAuth() {
        $player_id = Auth::user()->id;
        return DB::connection(env("DB_CONNECTION"))
            ->table("squads")
            ->leftJoin(
                DB::raw("(SELECT * FROM player_squad WHERE player_id = $player_id) as player_squad"),
                "squads.id", "=", "player_squad.squad_id")
            ->select("squads.*", "player_squad.player_id")
            ->get();
    }
}
