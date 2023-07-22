<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\InputCategoryCollection;
use App\Services\InputCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InputCategoryController extends Controller
{
    public function __construct(private readonly InputCategoryService $service)
    {
    }

    public function index(Request $request)
    {
        return new InputCategoryCollection($this->service->list($request->input()));
    }

    public function save(Request $request)
    {
        $data = $this->validate($request, ['name' => 'required', 'remark' => 'nullable', 'id' => 'integer']);
        $this->service->save($data);
        return success();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id)
    {
        $this->service->delete($id);
        return success();
    }
}
