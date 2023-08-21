<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['required'],
            'enterprise_product_id' => ['required', 'integer'],
            'detection_type' => ['required'],
            'detection_institution' => ['required'],
            'is_qualified' => ['required'],
            'report_date' => ['nullable', 'date'],
            'remark' => ['nullable'],
            'scan_file' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->isEnterprise();
    }
}
