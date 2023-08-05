<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnterpriseProductRequest;
use App\Http\Resources\EnterpriseProductCollection;
use App\Http\Resources\EnterpriseProductResource;
use App\Services\EnterpriseProductService;
use Illuminate\Http\Request;

class EnterpriseProductController extends Controller
{
    public function __construct(private readonly EnterpriseProductService $service)
    {
    }

    public function index(Request $request)
    {
        return new EnterpriseProductCollection($this->service->list($request->all()));
    }

    public function save(StoreEnterpriseProductRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new EnterpriseProductResource($this->service->save($data));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return success();
    }
}
