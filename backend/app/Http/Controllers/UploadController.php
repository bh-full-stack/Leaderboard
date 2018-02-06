<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload(Request $request) {
        $picture = new Picture();

        DB::transaction(function() use ($request, $picture) {
            $file = $request->file('file');
            $image = Image::make($file);

            $picture->extension = $file->getClientOriginalExtension();
            $picture->mime_type = $image->mime();
            $picture->width = $image->width();
            $picture->height = $image->height();
            $picture->size = $image->filesize();
            $picture->saveOrFail();

            $filename = $picture->id . '.' . $picture->extension;
            $image->save(storage_path('app/public/pictures/' . $filename));
        });

        return $picture;
    }
}
