<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Upload multiple images.
     *
     * @param  array $images
     * @param  string $folder
     * @return array
     */
    public function uploadMultipleImages($images, $folder)
    {
        $uploadedImages = [];

        foreach ($images as $image) {
            if ($image->isValid()) {
                // Store the image and return the path
                $uploadedImages[] = $image->store($folder, 'public');
            }
        }

        return $uploadedImages;
    }
}
