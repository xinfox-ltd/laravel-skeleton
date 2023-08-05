<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductionBaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'integer|numeric',
            'type' => 'integer|numeric',
            'name' => 'string|max:128',
//            'base_no' => 'nullable',
//            'director',
//            'phone',
            'region' => 'string',
//            'village_num',
//            'farmer_num',
            'area' => 'string|max:128',
            'lng' => 'numeric',
            'lat' => 'numeric',
            'images' => 'string|nullable',
        ];
    }
}
