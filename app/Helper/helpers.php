<?php

if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder)
    {
        $extension  = $file->getClientOriginalExtension();
        $filename = rand(0, 999) . now()->timestamp . '.' . $extension;
        $file->move('upload/' . $folder, $filename);
        return 'upload/' . $folder . '/' . $filename;
    }
}