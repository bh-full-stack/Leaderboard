<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Round extends Model
{
    use SoftDeletes;

    protected $fillable = ['game', 'score', 'player_id', 'location_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
