<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'max:150'],

            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users', 'phone')->ignore($userId),
            ],

            'password' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'string',
                'min:8',
            ],

            'role' => ['required', Rule::in(['admin', 'personal', 'professional'])],

            'account_type' => ['required', Rule::in(['free', 'premium'])],

            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Name is required.',
            'email.required'        => 'Email address is required.',
            'email.unique'          => 'This email address is already in use.',
            'phone.unique'          => 'This phone number is already in use.',
            'password.required'     => 'Password is required.',
            'password.min'          => 'Password must be at least 8 characters.',
            'role.required'         => 'Please select a role.',
            'role.in'               => 'Selected role is invalid.',
            'account_type.required' => 'Please select an account type.',
            'account_type.in'       => 'Selected account type is invalid.',
        ];
    }
}
