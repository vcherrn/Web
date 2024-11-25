<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificationWristStoreRequest extends FormRequest
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
            'category_id' => ['required', 'integer', 'exists:Categories,id'],
            'product_type' => ['nullable', 'string', 'max:100'],
            'type_of_side' => ['nullable', 'string', 'max:10'],
            'arm_size' => ['nullable', 'string', 'max:15'],
            'voltage' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'temperature' => ['nullable', 'string', 'max:50'],
            'opening_width' => ['nullable', 'integer'],
            'gripping_power' => ['nullable', 'integer'],
            'gripping_speed' => ['nullable', 'integer'],
            'weight' => ['nullable', 'integer'],
            'color' => ['nullable', 'string', 'max:60'],
            'material' => ['nullable', 'string', 'max:60'],
        ];
    }
}
