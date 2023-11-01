<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer'],
            'type' => ['required', 'integer'],
            'name' => ['required'],
            'data' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
