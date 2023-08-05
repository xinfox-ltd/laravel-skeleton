<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Resources\PackageCollection;
use App\Http\Resources\PackageResource;
use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private readonly PackageService $service)
    {
    }

    public function index(Request $request)
    {
        return new PackageCollection($this->service->list($request->user(), $request->all()));
    }

    public function save(StorePackageRequest $request)
    {
        return new PackageResource($this->service->save($request->user(), $request->validated()));
    }

    public function show(int $id, Request $request)
    {
        return new PackageResource($this->service->getPackage($request->user(), $id));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
