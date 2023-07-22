<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\DosageFormCollection;
use App\Services\DosageFormService;
use Illuminate\Http\Request;

class DosageFormController extends Controller
{
    public function __construct(private readonly DosageFormService $service)
    {
    }

    public function index(Request $request)
    {
        return new DosageFormCollection($this->service->list($request->input()));
    }


    public function save(Request $request)
    {
        $data = $this->validate(
            $request,
            [
                'id' => 'integer',
                'input_category_id' => 'required',
                'name' => 'required|max:32',
                'remark' => 'nullable|string'
            ]
        );
        $this->service->save($data);
        return success();
    }
}
