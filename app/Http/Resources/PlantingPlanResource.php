<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PlantingPlan */
class PlantingPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'production_base_id' => $this->production_base_id,
            'production_base_name' => $this->whenHas('production_base_name'),
            'product_id' => $this->product_id,
            'product_name' => $this->whenHas('product_name'),
            'name' => $this->name,
            'user_id' => $this->user_id,
            'staff_name' => $this->whenHas('staff_name'),
            'end_date' => $this->end_date,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
