<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TraceabilityCodeApplicationHandleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', Rule::in(['pass', 'refuse'])],
            'data' => ['array']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
