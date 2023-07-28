<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionBaseRequest;
use App\Http\Resources\ProductionBaseCollection;
use App\Services\ProductionBaseService;
use Illuminate\Http\Request;

class ProductionBaseController extends Controller
{
    public function __construct(private readonly ProductionBaseService $service)
    {
    }

    public function index(Request $request)
    {
        return new ProductionBaseCollection($this->service->list($request->user(), $request->input()));
    }

    public function save(StoreProductionBaseRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        if ($user->isEnterprise()) {
            $data['enterprise_id'] = $user->enterprise_id;
        }
        $this->service->save($data);
        return success();
    }
}
