<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['extension', 'mime_type', 'width', 'height', 'size'];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
