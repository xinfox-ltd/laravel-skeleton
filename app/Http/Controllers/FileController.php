<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request, FileService $service)
    {
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = $service->upload($request->file('file'));
            return success(
                [
                    'file_name' => $fileName,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'src' => url('storage/' . $fileName)
                ]
            );
        }

        return success();
    }
}
