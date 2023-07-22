<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\ProductionBase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProductionBase */
class ProductionBaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'type' => $this->type,
            'name' => $this->name,
            'base_no' => $this->base_no,
            'director' => $this->director,
            'phone' => $this->phone,
            'region' => $this->region,
            'village_num' => $this->village_num,
            'farmer_num' => $this->farmer_num,
            'area' => $this->area,
            'lng' => $this->lng,
            'lat' => $this->lat,
            'images' => $this->images,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
