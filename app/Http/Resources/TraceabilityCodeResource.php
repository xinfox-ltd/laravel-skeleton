<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\TraceabilityCode;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TraceabilityCode */
class TraceabilityCodeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'enterprise_id' => $this->enterprise_id,
            'harvest_plan_id' => $this->harvest_plan_id,
            'report_id' => $this->report_id,
            'package_id' => $this->package_id,
            'effective_day' => $this->effective_day,
            'enable_date' => $this->enable_date,
            'expire_date' => $this->expire_date,
            'scan_num' => $this->scan_num,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'serial_number' => $this->serial_number,
            'harvest_plan' => $this->whenLoaded('harvestPlan'),
            'report' => $this->whenLoaded('report'),
            'package' => $this->whenLoaded('package'),
            'process' => $this->whenLoaded('process'),
        ];
    }
}
