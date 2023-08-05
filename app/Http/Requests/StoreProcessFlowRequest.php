<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessFlowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['required'],
            'steps' => ['nullable'],
            'remark' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->isEnterprise();
    }
}
