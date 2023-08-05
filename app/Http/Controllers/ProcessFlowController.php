<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessFlowRequest;
use App\Http\Resources\ProcessFlowCollection;
use App\Http\Resources\ProcessFlowResource;
use App\Services\ProcessFlowService;
use Illuminate\Http\Request;

class ProcessFlowController extends Controller
{
    public function __construct(private readonly ProcessFlowService $service)
    {
    }

    public function index(Request $request)
    {
        return new ProcessFlowCollection($this->service->list($request->user(), $request->all()));
    }

    public function save(StoreProcessFlowRequest $request)
    {
        return new ProcessFlowResource($this->service->save($request->user(), $request->validated()));
    }

    public function show(int $id, Request $request)
    {
        return new ProcessFlowResource($this->service->getProcessFlow($request->user(), $id));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
