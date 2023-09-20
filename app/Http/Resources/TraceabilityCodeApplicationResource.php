<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\TraceabilityCodeApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TraceabilityCodeApplication */
class TraceabilityCodeApplicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'reason' => $this->reason,
            'remark' => $this->remark,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'audit_at' => $this->audit_at?->format('Y-m-d H:i:s'),
            'enterprise' => new EnterpriseResource($this->whenLoaded('enterprise'))
        ];
    }
}
