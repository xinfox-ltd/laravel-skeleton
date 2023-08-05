<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreInputRequest;
use App\Http\Resources\InputCollection;
use App\Http\Resources\InputResource;
use App\Services\InputService;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function __construct(private readonly InputService $service)
    {
    }

    public function index(Request $request)
    {
        return new InputCollection($this->service->list($request->user(), $request->input()));
    }

    public function save(StoreInputRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        $this->service->save($data);
        return success();
    }

    public function show(int $id)
    {
        return new InputResource($this->service->get($id));
    }
}
