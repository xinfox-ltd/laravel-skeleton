<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Process */
class ProcessResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'name' => $this->name,
            'process_flow_id' => $this->process_flow_id,
            'process_flow_name' => $this->whenHas('process_flow_name'),
            'enterprise_product_id' => $this->enterprise_product_id,
            'enterprise_product_name' => $this->whenHas('enterprise_product_name'),
            'production_base_id' => $this->production_base_id,
            'production_base_name' => $this->whenHas('production_base_name'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
