<?php

namespace App\Http\Controllers;

use App\Http\Resources\TraceabilityCodeApplicationCollection;
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
        return new TraceabilityCodeApplicationCollection($this->service->list($request->input()));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function save(Request $request)
    {
        $this->validate($request, []);
        $this->service->save($request->post());
        return success();
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
