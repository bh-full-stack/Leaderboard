<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ["introduction"];

    public function player() {
        return $this->hasOne(Player::class);
    }
}
