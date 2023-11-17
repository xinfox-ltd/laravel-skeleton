<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileService
{
    public function uploadImage(UploadedFile $file): bool|string
    {
        return $file->storePubliclyAs('images', $file->hashName(), 'public');
    }

    public function uploadFile(UploadedFile $file): bool|string
    {
        return $file->storePubliclyAs('file', $file->hashName(), 'public');
    }
}
