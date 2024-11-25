<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActiveRequestStoreRequest extends FormRequest
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
            'request_id' => ['required', 'integer', 'exists:requests,id'],
            'request_status' => ['required'],
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'patronymic' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:50'],
            'town' => ['required', 'string', 'max:50'],
            'telephone_number' => ['nullable', 'string', 'max:20'],
            'user_email' => ['nullable', 'string', 'max:50'],
            'message_text' => ['nullable', 'string'],
            'created_at' => ['nullable'],
            'request_type_user_id' => ['required', 'integer', 'exists:request_type_users,id'],
        ];
    }
}
