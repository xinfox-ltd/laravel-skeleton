<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnterpriseStaffRequest;
use App\Http\Resources\EnterpriseStaffCollection;
use App\Http\Resources\EnterpriseStaffResource;
use App\Services\EnterpriseStaffService;
use Illuminate\Http\Request;

class EnterpriseStaffController extends Controller
{
    public function __construct(private readonly EnterpriseStaffService $service)
    {
    }

    public function index(Request $request)
    {
        $enterpriseId = $request->user()->enterprise_id;
        return new EnterpriseStaffCollection($this->service->list($enterpriseId, $request->all()));
    }

    public function save(StoreEnterpriseStaffRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new EnterpriseStaffResource($this->service->save($data));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
