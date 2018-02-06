<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Picture extends Model
{
    protected $fillable = ['extension', 'mime_type', 'width', 'height', 'size'];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public static function garbageCollection() {
        $deletablePictures = DB::connection(env("DB_CONNECTION"))
            ->statement('
                SELECT pictures.*
                FROM pictures
                LEFT JOIN profiles ON pictures.id = profiles.picture_id
                WHERE profiles.id IS NULL
            ')->get();
    }
}
