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

    public function index(Request $request)
    {
        return new ProductionBaseItemCollection($this->service->list($request->user(), $request->all()));
    }

    public function save(int $baseId, ProductionBaseItemRequest $request)
    {
        $data = $request->validationData();
        $data['production_base_id'] = $baseId;
        return new ProductionBaseItemResource($this->service->save($request->user(), $data));
    }

    public function delete(int $baseId, int $id, Request $request)
    {
        $this->service->delete($request->user(), $baseId, $id);
        return success();
    }
}
