<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model
{
    protected $hidden = ["password_hash"];

    public function rounds()
    {
        return $this->hasMany('Round');


        /*$sql = "SELECT
                        players.nick,
                        rounds.game,
                        MAX(rounds.score) AS top_score,
                        COUNT(rounds.id) AS number_of_rounds
                    FROM rounds
                    JOIN players
                        ON rounds.player_id = players.id
                    GROUP BY rounds.player_id, rounds.game";*/

    }

    public static function listTopPlayersByGame() {
        return DB::table("rounds")
            ->join("players", "rounds.player_id", "=", "players.id")
            ->select(
                'rounds.game',
                DB::raw("count(rounds.id) as number_of_rounds"),
                DB::raw("max(rounds.score) as top_score")
            )
            ->groupBy("rounds.player_id", "rounds.game")
            ->toSql();
    }
}
