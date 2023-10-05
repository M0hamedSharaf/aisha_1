<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{

    public function uploadImage(?UploadedFile $imageObject, string $path): ?string
    {
        if ($imageObject) {
            $fileName = now()->timestamp . "_" . $imageObject->getClientOriginalName();
            $imageObject->move($path, $fileName);
        }
        return $fileName ?? null;
    }

    public function deleteImage(string $path): void
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
    
}