<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionBaseItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'regional_location' => ['required'],
            'area' => ['required'],
            'lng' => ['nullable', 'numeric'],
            'lat' => ['nullable', 'numeric'],
            'remark' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->isEnterprise();
    }
}
