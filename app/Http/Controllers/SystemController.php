<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SystemService;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function menuList(Request $request, SystemService $service)
    {
        return response()->success($service->menuList($request->user()));
    }
}
