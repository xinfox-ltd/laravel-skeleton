<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrademarkRequest;
use App\Http\Resources\TrademarkCollection;
use App\Http\Resources\TrademarkResource;
use App\Services\TrademarkService;
use Illuminate\Http\Request;

class TrademarkController extends Controller
{
    public function __construct(private readonly TrademarkService $service)
    {
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new TrademarkCollection($this->service->list($data));
    }

    public function save(StoreTrademarkRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new TrademarkResource($this->service->save($data));
    }
}
