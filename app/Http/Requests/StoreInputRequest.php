<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInputRequest extends FormRequest
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
            'input_category_id' => ['required', 'integer'],
            'dosage_form_id' => ['required', 'integer'],
            'name' => ['required'],
            'supplier_id' => ['integer', 'nullable'],
            'enterprise' => ['nullable'],
            'registration_no' => ['nullable'],
            'component' => ['nullable'],
            'executive_standard' => ['nullable'],
            'annex' => ['nullable'],
        ];
    }
}
