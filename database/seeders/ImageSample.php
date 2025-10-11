<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use SplFileInfo;

class ImageSample
{
    public static function getRandomFile(): SplFileInfo
    {
        $path = database_path('seeders/image_sample');
        $files = File::files($path);

        if (empty($files)) {
            throw new \Exception("No image files found in {$path}");
        }

        return collect($files)->random();
    }
}
