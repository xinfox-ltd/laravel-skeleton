<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Report */
class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'name' => $this->name,
            'enterprise_product_id' => $this->enterprise_product_id,
            'product_name' => $this->whenHas('product_name'),
            'enterprise_product' => new EnterpriseProductResource($this->whenLoaded('enterpriseProduct')),
            'detection_type' => $this->detection_type,
            'detection_institution' => $this->detection_institution,
            'is_qualified' => $this->is_qualified,
            'report_date' => $this->report_date,
            'remark' => $this->remark,
            'scan_file' => $this->scan_file,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
