<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $service)
    {
    }

    public function index(Request $request)
    {
        return new UserCollection($this->service->list($request->user(), $request->input()));
    }

    public function save(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $this->service->save($validated);
        return success();
    }
}
