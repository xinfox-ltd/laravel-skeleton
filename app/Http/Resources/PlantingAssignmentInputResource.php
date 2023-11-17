<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\PlantingAssignmentInput;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PlantingAssignmentInput */
class PlantingAssignmentInputResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->pivot->id,
            'enterprise_id' => $this->enterprise_id,
            'planting_assignment_id' => $this->planting_assignment_id,
            'input_id' => $this->id,
            'input_name' => $this->name,
            'quantity' => $this->pivot->quantity,
            'unit_type' => $this->pivot->unit_type,
            'unit_id' => $this->pivot->unit_id,
            'method' => $this->pivot->method,
            'input_date' => $this->pivot->input_date ?? [],
            'remark' => $this->pivot->remark,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
