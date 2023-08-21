<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaseUnitRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'region_id' => ['required'],
            'name' => ['required'],
            'unit_no' => ['required'],
            'director' => ['required'],
            'phone' => ['required'],
            'village_num' => ['required', 'integer'],
            'farmer_num' => ['required', 'integer'],
            'area' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
