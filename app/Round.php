<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Round extends Model
{
    protected $fillable = ['game', 'score', 'player_id', 'location_id'];

    public function player() {
        return $this->belongsTo('Player');
    }

    public function location() {
        return $this->belongsTo('Location');
    }

    public static function getListOfGames() {
        return DB::connection(env("DB_CONNECTION"))
            ->table('rounds')
            ->distinct('game')
            ->pluck('game');
    }
}
