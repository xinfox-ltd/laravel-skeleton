<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraceabilityCodeEditRequest;
use App\Http\Resources\TraceabilityCodeCollection;
use App\Services\TraceabilityCodeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TraceabilityCodeController extends Controller
{
    public function __construct(private readonly TraceabilityCodeService $service)
    {
    }

    public function index(Request $request)
    {
        return new TraceabilityCodeCollection($this->service->list($request->user(), $request->all()));
    }

    /**
     * @param TraceabilityCodeEditRequest $request
     * @return Response
     */
    public function save(TraceabilityCodeEditRequest $request)
    {
        $data = $request->validationData();
        return success($this->service->save($request->user(), $data));
    }

    public function operate(int $id, Request $request)
    {
        $data = $this->validate($request, ['action' => ['required', Rule::in(['enable', 'disable'])]]);
        $this->service->operate($request->user(), $id, $data['action'], $data['data'] ?? []);
        return success();
    }

    public function show(int $id)
    {
    }

    public function delete(int $id)
    {
    }
}
