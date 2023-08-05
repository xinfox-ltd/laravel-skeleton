<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTrademarkRequest extends FormRequest
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
            'id' => ['integer', 'nullable'],
            'name' => ['required'],
            'registration_no' => ['required'],
            'icd' => ['string', 'nullable'],
            'awarding_bodies' => ['string', 'nullable'],
            'valid_date' => ['nullable'],
//            'scan_file' => ['required'],
        ];
    }
}
