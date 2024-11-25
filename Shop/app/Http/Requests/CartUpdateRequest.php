<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
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
            'prosthes_id' => ['required', 'integer', 'exists:prosthes,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'count' => ['required', 'integer'],
            'created_at' => ['nullable'],
            'updated_at' => ['nullable'],
            'user_prosthes_id' => ['required', 'integer', 'exists:user_prosthes,id'],
        ];
    }
}
