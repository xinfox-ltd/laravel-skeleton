<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRawMaterialRequest;
use App\Http\Resources\RawMaterialCollection;
use App\Http\Resources\RawMaterialResource;
use App\Services\RawMaterialService;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function __construct(private readonly RawMaterialService $service)
    {
    }

    public function index(Request $request)
    {
        return new RawMaterialCollection($this->service->list($request->user(), $request->all()));
    }

    /**
     * @param StoreRawMaterialRequest $request
     * @return RawMaterialResource
     */
    public function save(StoreRawMaterialRequest $request)
    {
        return new RawMaterialResource($this->service->save($request->user(), $request->validated()));
    }

    public function show(int $id, Request $request)
    {
        return new RawMaterialResource($this->service->getRawMaterial($request->user(), $id));
    }

    public function destroy(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
