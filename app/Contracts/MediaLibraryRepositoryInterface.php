<?php

namespace App\Contracts;

use App\Enums\MediaCollection;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface MediaLibraryRepositoryInterface
{
    public function addMedia(HasMedia $model, UploadedFile $file, MediaCollection $collection): Media;

    public function delete(HasMedia $model, MediaCollection $collection): bool;
}
