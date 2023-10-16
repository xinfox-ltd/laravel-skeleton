<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\HarvestPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin HarvestPlan */
class HarvestPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'planting_plan_id' => $this->planting_plan_id,
            'planting_plan_name' => $this->whenHas('planting_plan_name'),
            'raw_material_id' => $this->raw_material_id,
            'raw_material_name' => $this->whenHas('raw_material_name'),
            'staff_id' => $this->raw_material_id,
            'staff_name' => $this->whenHas('staff_name'),
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'plan_date' => [
                $this->start_date,
                $this->end_date,
            ],
            'remark' => $this->remark,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
