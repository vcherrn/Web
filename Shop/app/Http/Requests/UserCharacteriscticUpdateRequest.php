<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCharacteriscticUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'characteristic_id' => ['required', 'integer', 'exists:characteristics,id'],
            'characteristic_user_id' => ['required', 'integer', 'exists:characteristic_users,id'],
        ];
    }
}
