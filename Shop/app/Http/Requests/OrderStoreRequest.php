<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:Users,id'],
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'patronymic' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:50'],
            'town' => ['required', 'string', 'max:50'],
            'area' => ['required', 'string', 'max:50'],
            'street' => ['required', 'string', 'max:50'],
            'house' => ['required', 'string', 'max:10'],
            'apartment' => ['required', 'string', 'max:10'],
            'telephone_number' => ['nullable', 'string', 'max:20'],
            'user_email' => ['nullable', 'string', 'max:50'],
            'message_text' => ['nullable', 'string'],
            'order_sum' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'created_at' => ['nullable'],
        ];
    }
}
