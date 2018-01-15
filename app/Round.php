<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return DB::table('rounds')->distinct('game')->pluck('game');
    }
}
