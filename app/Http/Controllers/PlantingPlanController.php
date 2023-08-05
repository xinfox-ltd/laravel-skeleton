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
        $data = $request->post();
        $this->validate($request, []);
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new PlantingPlanResource($this->service->save($data));
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
