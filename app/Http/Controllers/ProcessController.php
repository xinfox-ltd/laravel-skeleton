<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessRequest;
use App\Http\Resources\ProcessCollection;
use App\Http\Resources\ProcessResource;
use App\Services\ProcessService;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function __construct(private readonly ProcessService $service)
    {
    }

    public function index(Request $request)
    {
        return new ProcessCollection($this->service->list($request->user(), $request->all()));
    }

    public function save(StoreProcessRequest $request)
    {
        return new ProcessResource($this->service->save($request->user(), $request->validated()));
    }

    public function show(int $id, Request $request)
    {
        return new ProcessResource($this->service->getProcess($request->user(), $id));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
