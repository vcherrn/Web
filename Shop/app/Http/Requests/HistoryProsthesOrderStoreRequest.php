<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryProsthesOrderStoreRequest extends FormRequest
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
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'prosthes_id' => ['required', 'integer', 'exists:prosthes,id'],
            'count' => ['required', 'integer'],
            'created_at' => ['nullable'],
            'history_order_prosthes_id' => ['required', 'integer', 'exists:history_order_prosthes,id'],
        ];
    }
}
