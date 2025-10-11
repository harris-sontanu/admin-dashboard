<?php

if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder)
    {
        $path = public_path('upload/' . $folder);
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 999) . now()->timestamp . '.' . $extension;
            $file->move($path, $filename);
            return 'upload/' . $folder . '/' . $filename;
        }

        if (is_string($file)) {
            $filename = rand(0, 999) . now()->timestamp . '.webp';
            file_put_contents($path . '/' . $filename, $file);
            return 'upload/' . $folder . '/' . $filename;
        }

        throw new \Exception('Invalid file type for upload');
    }
}