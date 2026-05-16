<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Media
{
    // Make storeImage static
    public static function uploadAndAttachImage($imageFile, $folder = 'uploads')
    {
        try {
            // Generate a unique filename
            $filename = $imageFile->hashName();

            // Define the full path
            $path = "{$folder}/{$filename}";

            // Initialize ImageManager
            $manager = new ImageManager(new Driver);

            $image = $manager->read($imageFile);

            // Save the image
            Storage::disk('public')->put($path, (string) $image->encode());

            return $filename;
        } catch (\Exception $e) {
            throw new \Exception('Error storing image: '.$e->getMessage());
        }
    }

    public static function removeFile($folder, $file)
    {
        $path = "{$folder}/{$file}";

        if (Storage::disk('public')->exists($path)) {
            try {
                Storage::disk('public')->delete($path);
            } catch (\Exception $e) {
                throw new \Exception("Failed to delete {$file}: ".$e->getMessage());
            }
        }
    }

    public static function uploadAndAttachFile($file, $folder, $username = 'user')
    {
        try {
            $filename = "{$username}-".hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs($folder, $file, $filename);

            return $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
