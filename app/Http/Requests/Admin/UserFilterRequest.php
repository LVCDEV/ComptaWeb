<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:4'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
        ];
    }
}
