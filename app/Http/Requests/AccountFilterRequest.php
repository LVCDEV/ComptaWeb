<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountFilterRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number' => ['required', 'numeric', 'min:9'],
            'account_type_id' => ['required', 'exists:account_types,id'],
            'user_id' => ['required', 'exists:users,id'],
            'bank_id' => ['required', 'exists:banks,id'],
            'balance' => ['required'],
        ];
    }
}
