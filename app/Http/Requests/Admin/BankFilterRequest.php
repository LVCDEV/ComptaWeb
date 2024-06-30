<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankFilterRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:4'],
            'advise' => ['nullable', 'string'],
            'advise_phone' => ['nullable', 'string', 'min:10'],
            'advise_email' => ['nullable', 'string', 'email'],
            'address' => ['nullable', 'string', 'min:4'],
            'zipcode' => ['nullable', 'string', 'min:5', 'max:5'],
            'city' => ['required', 'string', 'min:4'],
            'phone' => ['nullable', 'string', 'min:10', 'max:10'],
            'email' => ['nullable', 'string', 'email'],
            'website' => ['nullable', 'string'],
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
