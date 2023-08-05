<?php
/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHarvestPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isEnterprise();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'planting_plan_id' => ['required', 'integer'],
            'raw_material_id' => ['required', 'integer'],
            'staff_id' => ['required', 'integer'],
            'name' => ['required'],
            'plan_date' => ['nullable', 'array'],
            'remark' => ['string', 'nullable'],
        ];
    }
}
