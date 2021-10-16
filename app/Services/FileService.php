<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Delete a file
     *
     * @param string $path
     * @param string $filename
     *
     * @return bool
     */
    public static function deleteFile(string $path, string $filename): bool
    {
        $fullPath = $path."/".$filename;
        $exists = Storage::exists($fullPath);

        if ($exists) {
            Storage::delete($fullPath);

            return true;
        }

        return false;
    }

    /**
     * Delete multiple files
     *
     * @param string $path
     * @param object $filenames
     *
     * @return bool
     */
    public static function deleteMultipleFiles(string $path, object $filenames): bool
    {
        foreach ($filenames as $filename) {
            $fullPath = $path."/".$filename;
            $exists = Storage::exists($fullPath);

            if ($exists) {
                Storage::delete($fullPath);
            }
        }

        return true;
    }

    /**
     * Upload a file
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     *
     * @return string
     */
    public static function upload(UploadedFile $file, string $path): string
    {
        $fileName = self::generateFileName($file->extension());

        $file->storeAs($path, $fileName);

        return $fileName;
    }

    /**
     * Generate a unique file name
     *
     * @param string $extension
     *
     * @return string
     */
    public static function generateFileName(string $extension): string
    {
        return Str::random(30).".".$extension;
    }
}
