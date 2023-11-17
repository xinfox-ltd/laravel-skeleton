<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlantingAssignmentInputRequest extends FormRequest
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
            'input_id' => ['required', 'integer'],
            'quantity' => ['required'],
            'unit_type' => ['required'],
            'unit_id' => ['required', 'integer'],
            'method' => ['required'],
            'remark' => ['nullable'],
        ];
    }
}
