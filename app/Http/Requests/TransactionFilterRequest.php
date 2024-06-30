<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TransactionFilterRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'transaction_type_id' => ['required', 'exists:transaction_types,id'],
            'account_id' => ['required', 'exists:accounts,id'],
            'beneficiary' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'amount' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }
}
