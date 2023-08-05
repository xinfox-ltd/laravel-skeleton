<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantingAssignmentInputRequest;
use App\Http\Requests\StorePlantingAssignmentRequest;
use App\Http\Resources\InputCollection;
use App\Http\Resources\PlantingAssignmentCollection;
use App\Http\Resources\PlantingAssignmentInputCollection;
use App\Http\Resources\PlantingAssignmentResource;
use App\Services\PlantingAssignmentService;
use Illuminate\Http\Request;

class PlantingAssignmentController extends Controller
{
    public function __construct(private readonly PlantingAssignmentService $service)
    {
    }

    public function index(Request $request)
    {
        return new PlantingAssignmentCollection($this->service->list($request->user(), $request->all()));
    }

    public function save(StorePlantingAssignmentRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return new PlantingAssignmentResource($this->service->save($data));
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }

    public function inputList(int $id, Request $request)
    {
        return new PlantingAssignmentInputCollection($this->service->getInputList($id, $request->all()));
    }

    public function saveInput(int $id, StorePlantingAssignmentInputRequest $request)
    {
        $data = $request->validated();
        $data['planting_assignment_id'] = $id;
        return success($this->service->saveInput($request->user(), $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyInput(int $id, int $iid, Request $request)
    {
        $this->service->destroyInput($request->user(), $id, $iid);
        return success();
    }
}
