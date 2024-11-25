<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificationKneeUpdateRequest extends FormRequest
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
            'amputation_rate' => ['nullable', 'string', 'max:100'],
            'activity_level' => ['nullable', 'string', 'max:20'],
            'max_weight' => ['nullable', 'integer'],
            'weight' => ['nullable', 'integer'],
            'material' => ['nullable', 'string', 'max:60'],
            'distal_part_connection' => ['nullable', 'string', 'max:50'],
            'proximal_part_connection' => ['nullable', 'string', 'max:50'],
            'knee_angle' => ['nullable', 'integer'],
            'system_height_prox' => ['nullable', 'string', 'max:50'],
            'min_system_height_dist' => ['nullable', 'string', 'max:50'],
            'max_system_height_dist' => ['nullable', 'string', 'max:50'],
            'min_montage_height' => ['nullable', 'string', 'max:50'],
            'max_montage_height' => ['nullable', 'string', 'max:50'],
            'proximal_montage_height' => ['nullable', 'string', 'max:50'],
            'min_dist_montage_height' => ['nullable', 'string', 'max:50'],
            'max_dist_montage_height' => ['nullable', 'string', 'max:50'],
        ];
    }
}
