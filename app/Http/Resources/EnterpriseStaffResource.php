<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\EnterpriseStaff;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin EnterpriseStaff */
class EnterpriseStaffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
