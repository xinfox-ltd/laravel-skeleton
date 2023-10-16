<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SiteService;

/**
 * 前端展示控制器
 */
class HomeController extends Controller
{
    public function index(int $id, SiteService $service)
    {
        return success($service->getTraceabilityCode($id));
    }
}
