<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraceabilityCodeApplicationRequest;
use App\Http\Resources\TraceabilityCodeApplicationCollection;
use App\Http\Resources\TraceabilityCodeApplicationResource;
use App\Services\TraceabilityCodeApplicationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TraceabilityCodeApplicationController extends Controller
{
    public function __construct(private readonly TraceabilityCodeApplicationService $service)
    {
    }

    public function index(Request $request)
    {
        return new TraceabilityCodeApplicationCollection($this->service->list($request->user(), $request->input()));
    }

    /**
     * @param TraceabilityCodeApplicationRequest $request
     * @return Response
     */
    public function save(TraceabilityCodeApplicationRequest $request)
    {
        $data = $request->validationData();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return success(
            new TraceabilityCodeApplicationResource($this->service->save($data))
        );
    }

    public function show(int $id, Request $request)
    {
        return success(
            new TraceabilityCodeApplicationResource($this->service->get($request->user(), $id))
        );
    }

    public function delete(Request $request, int $id)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
