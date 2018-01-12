<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function player() {
        return $this->belongsTo('Player');
    }

    public function location() {
        return $this->belongsTo('Location');
    }
}
