<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'professional';
    }

    public function rules(): array
    {
        $section = $this->detectSection();

        return match ($section) {
            'education'     => $this->educationRules(),
            'experience'    => $this->experienceRules(),
            'skill'         => $this->skillRules(),
            'project'       => $this->projectRules(),
            'language'      => $this->languageRules(),
            'certification' => $this->certificationRules(),
            default         => [],
        };
    }

    private function detectSection(): string
    {
        $segments     = $this->segments();
        $profileIndex = array_search('profile', $segments);
        return $segments[$profileIndex + 1] ?? '';
    }

    // ── Section Rules ─────────────────────────────────────────────

    private function educationRules(): array
    {
        return [
            'degree'           => ['required', 'string', 'max:150'],
            'degree_bn'        => ['nullable', 'string', 'max:150'],
            'field_of_study'   => ['nullable', 'string', 'max:150'],
            'field_of_study_bn' => ['nullable', 'string', 'max:150'],
            'institute'        => ['required', 'string', 'max:200'],
            'institute_bn'     => ['nullable', 'string', 'max:200'],
            'result'           => ['nullable', 'string', 'max:50'],
            'start_year'       => ['nullable', 'string', 'max:10'],
            'end_year'         => ['nullable', 'string', 'max:10'],
            'description'      => ['nullable', 'string'],
            'description_bn'   => ['nullable', 'string'],
        ];
    }

    private function experienceRules(): array
    {
        return [
            'company_name'    => ['required', 'string', 'max:200'],
            'company_name_bn' => ['nullable', 'string', 'max:200'],
            'job_title'       => ['required', 'string', 'max:150'],
            'job_title_bn'    => ['nullable', 'string', 'max:150'],
            'employment_type' => ['nullable', 'string', 'in:full-time,part-time,freelance,contract,internship'],
            'start_date'      => ['nullable', 'date'],
            'end_date'        => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current'      => ['nullable', 'boolean'],
            'description'     => ['nullable', 'string'],
            'description_bn'  => ['nullable', 'string'],
        ];
    }

    private function skillRules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'name_bn' => ['nullable', 'string', 'max:100'],
            'level'   => ['nullable', 'string', 'in:beginner,intermediate,expert'],
        ];
    }

    private function projectRules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:200'],
            'title_bn'        => ['nullable', 'string', 'max:200'],
            'role'            => ['nullable', 'string', 'max:150'],
            'role_bn'         => ['nullable', 'string', 'max:150'],
            'technologies'    => ['nullable', 'string', 'max:300'],
            'technologies_bn' => ['nullable', 'string', 'max:300'],
            'project_url'     => ['nullable', 'url', 'max:300'],
            'description'     => ['nullable', 'string'],
            'description_bn'  => ['nullable', 'string'],
        ];
    }

    private function languageRules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100'],
            'name_bn'     => ['nullable', 'string', 'max:100'],
            'proficiency' => ['nullable', 'string', 'in:basic,conversational,fluent,native'],
        ];
    }

    private function certificationRules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:200'],
            'title_bn'        => ['nullable', 'string', 'max:200'],
            'organization'    => ['nullable', 'string', 'max:200'],
            'organization_bn' => ['nullable', 'string', 'max:200'],
            'issue_date'      => ['nullable', 'date'],
            'expiry_date'     => ['nullable', 'date', 'after_or_equal:issue_date'],
            'credential_id'   => ['nullable', 'string', 'max:150'],
        ];
    }
}
