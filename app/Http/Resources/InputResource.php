<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Input;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Input */
class InputResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'input_category_id' => $this->input_category_id,
            'category_name' => $this->whenHas('category_name'),
            'dosage_form_id' => $this->dosage_form_id,
            'dosage_form_name' => $this->whenHas('dosage_form_name'),
            'name' => $this->name,
            'supplier_id' => $this->supplier_id,
            'supplier_name' => $this->supplier_name ?? '自制',
            'supplier' => $this->whenLoaded('supplier'),
            'enterprise' => $this->enterprise,
            'registration_no' => $this->registration_no,
            'component' => $this->component,
            'executive_standard' => $this->executive_standard,
            'annex' => $this->annex ?? '',
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
