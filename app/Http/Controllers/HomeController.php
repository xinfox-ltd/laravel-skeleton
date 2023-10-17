<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SiteService;
use Illuminate\Http\Request;

/**
 * 前端展示控制器
 */
class HomeController extends Controller
{
    public function index(int $id, SiteService $service)
    {
        return success($service->getTraceabilityCode($id));
    }

    public function traceabilityCodeQuery(Request $request, SiteService $service)
    {
        $data = $request->post();
        $this->validate(
            $request,
            ['id' => 'required', 'end_number' => 'required'],
            ['id.required' => '缺少ID', 'end_number.required' => '缺少验证码后四位']
        );
        return success($service->traceabilityCodeQuery(intval($data['id']), $data['end_number']));
    }
}
