<?php

namespace App\Contracts\MediaLibrary;

use App\Enums\MediaCollection;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface MediaLibraryServiceInterface
{
    public function addOneMedia(
        HasMedia        $model,
        UploadedFile    $file,
        MediaCollection $collection = MediaCollection::DEFAULT
    ): Media;
}
