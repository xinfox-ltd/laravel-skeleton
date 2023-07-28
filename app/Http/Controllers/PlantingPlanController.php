<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantingPlanCollection;
use App\Http\Resources\PlantingPlanResource;
use App\Services\PlantingPlanService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PlantingPlanController extends Controller
{
    public function __construct(private readonly PlantingPlanService $service)
    {
    }

    public function index(Request $request)
    {
        return new PlantingPlanCollection($this->service->list($request->user(), $request->input()));
    }

    /**
     * @param Request $request
     * @return PlantingPlanResource
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        $this->validate($request, []);
        return new PlantingPlanResource($this->service->save($request->post()));
    }

    public function show(int $id)
    {
        return new PlantingPlanResource($this->service->get($id));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return success();
    }
}
