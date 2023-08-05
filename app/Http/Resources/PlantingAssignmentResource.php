<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\PlantingAssignment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PlantingAssignment */
class PlantingAssignmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'planting_plan_id' => $this->planting_plan_id,
            'planting_plan_name' => $this->whenHas('planting_plan_name'),
            'assignment_content' => $this->assignment_content,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'date' => [
                $this->start_date,
                $this->end_date,
            ],
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
