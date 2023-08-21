<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBaseUnitRequest;
use App\Http\Resources\BaseUnitCollection;
use App\Http\Resources\BaseUnitResource;
use App\Services\BaseUnitService;
use Illuminate\Http\Request;

class BaseUnitController extends Controller
{
    public function __construct(private readonly BaseUnitService $service)
    {
    }

    public function index(Request $request)
    {
        return new BaseUnitCollection($this->service->list($request->all()));
    }

    public function save(StoreBaseUnitRequest $request)
    {
        return new BaseUnitResource($this->service->save($request->validated()));
    }

    public function show(int $id)
    {
        return new BaseUnitResource($this->service->getBaseUnit($id));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return success();
    }
}
