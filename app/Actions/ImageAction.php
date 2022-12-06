<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageAction
{
    public function __invoke($image, $pathInImage, int $width = 400, int $height = 220,): mixed
    {
        $filename = md5(time()) . '.' . $image->getClientOriginalExtension();
        $path = Storage::putFileAs("/public/image/$pathInImage/origin", $image, $filename);
        $thumbnail = Image::make(Storage::path($path));
        $thumbnail->fit($width, $height);
        Storage::delete($path);
        $thumbnail->save(Storage::path("/public/image/$pathInImage/thumbnail/" . $filename));
        return $filename;
    }
}
