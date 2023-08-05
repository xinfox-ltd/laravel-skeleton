<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Trademark */
class TrademarkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'name' => $this->name,
            'registration_no' => $this->registration_no,
            'icd' => $this->icd,
            'awarding_bodies' => $this->awarding_bodies,
            'valid_date' => $this->valid_date,
            'scan_file' => $this->scan_file,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
//            'updated_at' => $this->updated_at,
        ];
    }
}
