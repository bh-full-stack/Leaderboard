<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $fillable = ['extension', 'mime_type', 'width', 'height', 'size'];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public static function garbageCollection() {
        $deletablePictures = DB::connection(env("DB_CONNECTION"))
            ->table('pictures')
            ->leftJoin('profiles', 'pictures.id', '=', 'profiles.picture_id')
            ->select('pictures.*')
            ->whereNull('profiles.id')
            ->where('pictures.created_at', '<', Carbon::now()->subHour(1));

        foreach ($deletablePictures->get() as $picture) {
            $filename = $picture->id . '.' . $picture->extension;
            if (Storage::delete('public/pictures/' . $filename)) {
                DB::connection(env("DB_CONNECTION"))
                    ->table('pictures')
                    ->where('id', '=', $picture->id)
                    ->delete();
            }
        }
    }
}
