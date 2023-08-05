<?php
/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreHarvestPlanRequest;
use App\Http\Resources\HarvestPlanCollection;
use App\Http\Resources\HarvestPlanResource;
use App\Services\HarvestPlanService;
use Illuminate\Http\Request;

class HarvestPlanController extends Controller
{
    public function __construct(private readonly HarvestPlanService $service)
    {
    }

    public function index(Request $request)
    {
        return new HarvestPlanCollection($this->service->list($request->user(), $request->all()));
    }

    /**
     * @param StoreHarvestPlanRequest $request
     * @return HarvestPlanResource
     */
    public function save(StoreHarvestPlanRequest $request)
    {
        return new HarvestPlanResource($this->service->save($request->user(), $request->validated()));
    }

    public function show(int $id, Request $request)
    {
        return new HarvestPlanResource($this->service->getHarvestPlan($request->user(), $id));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
