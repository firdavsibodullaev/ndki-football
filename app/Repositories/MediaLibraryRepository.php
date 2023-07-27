<?php

namespace App\Repositories;

use App\Contracts\MediaLibraryRepositoryInterface;
use App\Enums\MediaCollection;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryRepository implements MediaLibraryRepositoryInterface
{
    public function addMedia(HasMedia $model, UploadedFile $file, MediaCollection $collection): Media
    {
        return $model->addMedia($file)->toMediaCollection($collection->value);
    }

    public function delete(HasMedia $model, MediaCollection $collection): bool
    {
        return $model->media()->where('collection_name', $collection->value)->delete();
    }
}
