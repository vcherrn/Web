<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificationFootStoreRequest extends FormRequest
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
            'type_of_side' => ['nullable', 'string', 'max:10'],
            'size_of_prosthes' => ['nullable', 'string', 'max:20'],
            'weight' => ['nullable', 'integer'],
            'foot_shape' => ['nullable', 'string', 'max:200'],
            'color' => ['nullable', 'string', 'max:60'],
            'height' => ['nullable', 'integer'],
            'material' => ['nullable', 'string', 'max:60'],
        ];
    }
}
