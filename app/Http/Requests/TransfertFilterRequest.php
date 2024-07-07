<?php

namespace App\Http\Requests;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;


class TransfertFilterRequest extends FormRequest
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
        $account = Account::all();
        $this->merge([
            'transaction_type_id' => 3,
            //'beneficiary' => 'Transfert : '. $account->where('id', $this->input('account_id'))->value('number') . ' to ' . $account->where('id', $this->input('beneficiary'))->value('number'),
            'user_id' => auth()->user()->id,
        ]);
    }
}
