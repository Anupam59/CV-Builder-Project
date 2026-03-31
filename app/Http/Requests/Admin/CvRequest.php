<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'professional';
    }

    public function rules(): array
    {
        return [
            'customer_id'    => ['required', 'exists:customers,id'],
            'title'          => ['nullable', 'string', 'max:200'],
            'language'       => ['required', 'string', 'in:en,bn'],
            'template_name'  => ['required', 'string', 'in:template_1,template_2,template_3'],

            // include/exclude checkboxes
            'include'                => ['nullable', 'array'],
            'include.personal_detail' => ['nullable', 'boolean'],
            'include.educations'     => ['nullable', 'boolean'],
            'include.experiences'    => ['nullable', 'boolean'],
            'include.skills'         => ['nullable', 'boolean'],
            'include.projects'       => ['nullable', 'boolean'],
            'include.languages'      => ['nullable', 'boolean'],
            'include.certifications' => ['nullable', 'boolean'],
        ];
    }
}
