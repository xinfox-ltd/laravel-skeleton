<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Enums\TraceabilityCodeStatus;
use App\Models\TraceabilityCode;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class TraceabilityCodeService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return TraceabilityCode::with(['harvestPlan', 'report', 'package', 'process'])->paginate($params['page_size'] ?? 20);
    }

    public function save(User $user, array $data): TraceabilityCode
    {
        $id = $data['id'] ?? 0;
        if (!$id) {
            throw ValidationException::withMessages(['id' => '缺少参数ID']);
        }

        $traceabilityCode = TraceabilityCode::where('enterprise_id', $user->enterprise_id)
            ->where('id', $id)
            ->firstOrFail();

        $traceabilityCode->effective_day = $data['effective_day'] ?? 500;
        $traceabilityCode->process_end_date = $data['process_end_date'];
        $traceabilityCode->harvest_plan_id = $data['harvest_plan_id'];
        $traceabilityCode->report_id = $data['report_id'];
        $traceabilityCode->package_id = $data['package_id'];
        $traceabilityCode->process_id = $data['process_id'];
        $traceabilityCode->save();

        return $traceabilityCode;
    }

    public function operate(User $user, int $id, string $action, $data = []): TraceabilityCode
    {
        $traceabilityCode = TraceabilityCode::where('enterprise_id', $user->enterprise_id)
            ->where('id', $id)
            ->firstOrFail();
        if ($action == 'enable') {
            $enableDate = Carbon::now();
            $traceabilityCode->status = TraceabilityCodeStatus::Enable;
            $traceabilityCode->enable_date = $enableDate;
            $traceabilityCode->expire_date = (clone $enableDate)->addDays($traceabilityCode->effective_day);
        } else {
            $traceabilityCode->status = TraceabilityCodeStatus::Disable;
        }

        $traceabilityCode->save();

        return $traceabilityCode;
    }
}
