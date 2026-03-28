<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'professional';
    }

    public function rules(): array
    {
        return [
            'father_name'       => ['nullable', 'string', 'max:150'],
            'father_name_bn'    => ['nullable', 'string', 'max:150'],
            'mother_name'       => ['nullable', 'string', 'max:150'],
            'mother_name_bn'    => ['nullable', 'string', 'max:150'],
            'date_of_birth'     => ['nullable', 'date'],
            'gender'            => ['nullable', 'string', 'in:male,female,other'],
            'marital_status'    => ['nullable', 'string', 'in:single,married,divorced,widowed'],
            'nationality'       => ['nullable', 'string', 'max:100'],
            'nationality_bn'    => ['nullable', 'string', 'max:100'],
            'religion'          => ['nullable', 'string', 'max:100'],
            'religion_bn'       => ['nullable', 'string', 'max:100'],
            'nid_number'        => ['nullable', 'string', 'max:50'],
            'profession'        => ['nullable', 'string', 'max:150'],
            'profession_bn'     => ['nullable', 'string', 'max:150'],
            'profile_summary'   => ['nullable', 'string'],
            'profile_summary_bn' => ['nullable', 'string'],
            'website'           => ['nullable', 'url', 'max:300'],
            'linkedin'          => ['nullable', 'url', 'max:300'],
            'github'            => ['nullable', 'url', 'max:300'],
        ];
    }
}
