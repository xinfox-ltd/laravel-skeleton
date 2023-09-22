<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\EnterpriseProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin EnterpriseProduct */
class EnterpriseProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'product_id' => $this->product_id,
            'product' => $this->whenLoaded('product'),
            'product_name' => $this->whenHas('product_name'),
            'trademark_id' => $this->trademark_id,
            'trademark' => $this->whenLoaded('trademark'),
            'warranty_period' => $this->warranty_period,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
//            'updated_at' => $this->updated_at,
        ];
    }
}
