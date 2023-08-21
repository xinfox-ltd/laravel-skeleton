<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportCollection;
use App\Http\Resources\ReportResource;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function __construct(private readonly ReportService $service)
    {
    }

    public function index(Request $request)
    {
        return new ReportCollection($this->service->list($request->user(), $request->all()));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        return $this->service->save($request->user(), $request->post());
    }

    public function show(int $id, Request $request)
    {
        return new ReportResource($this->service->getReport($request->user(), $id));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
