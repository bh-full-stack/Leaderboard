<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function rounds() {
        return $this->hasMany('Round');
    }
}
