<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\BaseUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BaseUnit */
class BaseUnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'region_id' => $this->region_id,
            'name' => $this->name,
            'unit_no' => $this->unit_no,
            'director' => $this->director,
            'phone' => $this->phone,
            'village_num' => $this->village_num,
            'farmer_num' => $this->farmer_num,
            'area' => $this->area,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
