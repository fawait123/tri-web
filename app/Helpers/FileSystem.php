<?php


namespace App\Helpers;

use Illuminate\Support\Facades\File;

class FileSystem
{
    public static function getFile(string $directory)
    {
        $mediaPath = public_path($directory);

        $files = File::allFiles($mediaPath);

        $data = [];
        foreach ($files as $file) {
            $data[] = [
                'filename' => $directory . '/' . $file->getFilename(),
            ];
        }

        return $data;
    }
}
