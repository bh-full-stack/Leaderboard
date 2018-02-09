<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    public $fillable = ['name', 'color'];

    public function players() {
        return $this->belongsToMany(Player::class);
    }
}
