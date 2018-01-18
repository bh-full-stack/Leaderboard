<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    use Notifiable;

    protected $fillable = ["nick", "email"];
    protected $hidden = ["password", "activation_code"];


    public function rounds() {
        return $this->hasMany(Round::class);
    }

    public static function getByNick($nick) {
        return self::firstOrNew(["nick" => $nick]);
    }

    public static function listTopPlayersByGame() {
        return DB::connection(env("DB_CONNECTION"))
            ->table("rounds")
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
