<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model
{
    protected $fillable = ["nick", "email"];
    protected $hidden = ["password_hash"];

    public function rounds() {
        return $this->hasMany("Round");
    }

    public static function getByNick($nick) {
        return self::firstOrNew(["nick" => $nick]);
    }

    public static function listTopPlayersByGame() {
        return DB::table("rounds")
            ->join("players", "rounds.player_id", "=", "players.id")
            ->select(
                "players.nick",
                "rounds.game",
                DB::raw("count(rounds.id) as number_of_rounds"),
                DB::raw("max(rounds.score) as top_score")
            )
            ->groupBy("rounds.player_id", "rounds.game")
            ->get();
    }
}