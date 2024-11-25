<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProstheStoreRequest extends FormRequest
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
            'specifiable_id' => ['required', 'integer'],
            'specifiable_type' => ['required', 'string', 'max:50'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'creator_id' => ['required', 'integer', 'exists:creators,id'],
            'status' => ['required'],
            'article' => ['nullable', 'string', 'max:40'],
            'name' => ['nullable', 'string', 'max:40'],
            'description' => ['nullable', 'string'],
            'photos' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'year_of_creating' => ['nullable', 'integer'],
            'created_at' => ['nullable'],
            'updated_at' => ['nullable'],
            'category_creator_id' => ['required', 'integer', 'exists:category_creators,id'],
        ];
    }
}
