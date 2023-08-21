<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductionBaseItemRequest;
use App\Http\Resources\ProductionBaseItemCollection;
use App\Http\Resources\ProductionBaseItemResource;
use App\Services\ProductionBaseItemService;
use Illuminate\Http\Request;

class ProductionBaseItemController extends Controller
{
    public function __construct(private readonly ProductionBaseItemService $service)
    {
    }

    public function index(int $baseId, Request $request)
    {
        return new ProductionBaseItemCollection($this->service->list($request->user(), $baseId, $request->all()));
    }

    public function save(ProductionBaseItemRequest $request)
    {
        return new ProductionBaseItemResource($this->service->save($request->user(), $request->validated()));
    }
}
