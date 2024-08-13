<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class CustomPathGenerator extends DefaultPathGenerator
{
    /**
     * @param Media $media
     * @return string
     */
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');
        $path = $media->collection_name.'/'.$media->model_id;

        if ($prefix !== '') {
            return $prefix.'/'.$path;
        }

        return $path;
    }
}
