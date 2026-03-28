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
            'title'    => ['nullable', 'string', 'max:200'],
            'language' => ['required', 'string', 'in:en,bn'],
        ];
    }
}
