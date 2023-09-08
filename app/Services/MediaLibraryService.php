<?php

namespace App\Services;

use App\Contracts\MediaLibrary\MediaLibraryRepositoryInterface;
use App\Contracts\MediaLibrary\MediaLibraryServiceInterface;
use App\Enums\MediaCollection;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

readonly class MediaLibraryService implements MediaLibraryServiceInterface
{
    public function __construct(
        private MediaLibraryRepositoryInterface $libraryRepository
    )
    {
    }

    public function addOneMedia(HasMedia $model, UploadedFile $file, MediaCollection $collection = MediaCollection::DEFAULT): Media
    {
        if ($model->hasMedia($collection->value)) {
            $this->libraryRepository->delete($model, $collection);
        }

        return $this->libraryRepository->addMedia($model, $file, $collection);
    }
}
