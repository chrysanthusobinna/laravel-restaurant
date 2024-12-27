<?php

namespace App\Http\Controllers\Traits;

use Intervention\Image\Laravel\Facades\Image;


trait ImageHandlerTrait
{
 
    private function handleImageUpload($imageFile, $path)
    {
        $image = Image::read($imageFile); 
        $imageName = time() . '-' . $imageFile->getClientOriginalName();
        $storagePath = storage_path("app/public/$path");

        // Save Main Image
        $image->save($storagePath . '/' . $imageName);

        // Generate cropped image (500x400)
        $image->cover(500, 400);
        $image->save($storagePath . '/' . $imageName);

        return "$path/$imageName";
    }
}


 