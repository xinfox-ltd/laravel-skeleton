<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\ProductionBaseItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductionBaseItem */
class ProductionBaseItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'production_base_id' => $this->production_base_id,
            'enterprise_staff_id' => $this->enterprise_staff_id,
            'name' => $this->name,
            'regional_location' => $this->regional_location,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'lng' => $this->lng,
            'lat' => $this->lat,
            'remark' => $this->remark,
            'manager' => $this->whenLoaded('manager'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
