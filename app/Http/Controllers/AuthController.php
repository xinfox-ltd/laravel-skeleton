<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\PasswordErrorException;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param LoginService $service
     * @return Response
     * @throws PasswordErrorException
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginService $service): Response
    {
        return response()->success($service->accountPasswordLogin($request->username, $request->password));
    }
}
