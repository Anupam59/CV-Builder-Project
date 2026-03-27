<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'professional';
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:150'],
            'phone'   => ['required', 'string', 'max:20', 'unique:customers,phone'],
            'email'   => ['nullable', 'email', 'max:150'],
            'address' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Customer name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.unique'   => 'A customer with this phone number already exists.',
        ];
    }
}
