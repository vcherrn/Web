<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificationHipUpdateRequest extends FormRequest
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
            'activity_level' => ['nullable', 'string', 'max:20'],
            'max_weight' => ['nullable', 'integer'],
            'weight' => ['nullable', 'integer'],
            'distal_part_connection' => ['nullable', 'string', 'max:50'],
            'proximal_part_connection' => ['nullable', 'string', 'max:50'],
            't_angle' => ['nullable', 'integer'],
            'system_height' => ['nullable', 'integer'],
            'montage_height' => ['nullable', 'integer'],
            'type_of_side' => ['nullable', 'string', 'max:10'],
            'material' => ['nullable', 'string', 'max:60'],
        ];
    }
}
