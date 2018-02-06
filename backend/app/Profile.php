<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ["introduction"];

    public function save(array $options = []) {
        // Defaults introduction to empty string, since MySQL cannot do it for TEXT fields
        if (is_null($this->introduction)) {
            $this->introduction = '';
        }
        return parent::save($options);
    }

    public function player() {
        return $this->hasOne(Player::class);
    }

    public function picture() {
        return $this->belongsTo(Picture::class);
    }
}
