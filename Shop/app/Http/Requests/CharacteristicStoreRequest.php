<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacteristicStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'right_hand' => ['nullable', 'string'],
            'left_hand' => ['nullable', 'string'],
            'right_leg' => ['nullable', 'string'],
            'left_leg' => ['nullable', 'string'],
            'weight' => ['nullable', 'numeric', 'between:-9999999.9,9999999.9'],
            'height' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'age' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'created_at' => ['nullable'],
        ];
    }
}
