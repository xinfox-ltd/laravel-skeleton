<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraceabilityCodeApplicationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => ['required', 'numeric'],
            'remark' => ['string']
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->isEnterprise();
    }
}
