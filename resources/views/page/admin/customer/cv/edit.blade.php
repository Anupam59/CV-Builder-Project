@extends('layout.admin.adminLayout')
@section('page_title', 'Edit CV')
@section('page_subtitle', $cv->title)

@push('toolbar_actions')
    <a href="{{ route('admin.cvs.show', $cv->id) }}" class="btn btn-sm btn-light">← Cancel</a>
@endpush

@section('content')
    <div class="row g-6">

        <div class="col-xl-5">
            <div class="card card-flush">
                <div class="card-header pt-6">
                    <div class="card-title">
                        <h3>Edit CV</h3>
                    </div>
                </div>
                <div class="card-body pt-5">

                    <div class="alert alert-info p-4 mb-6">
                        <i class="fas fa-info-circle me-2"></i>
                        Editing will create a new version. Previous versions are preserved.
                    </div>

                    <form method="POST" action="{{ route('admin.cvs.update', $cv->id) }}">
                        @csrf @method('PUT')
                        <input type="hidden" name="customer_id" value="{{ $cv->customer_id }}">

                        <div class="mb-6">
                            <label class="form-label fw-bold">CV Title</label>
                            <input type="text" name="title" class="form-control form-control-solid"
                                value="{{ old('title', $cv->title) }}">
                        </div>

                        <div class="row mb-6">
                            <div class="col-sm-6">
                                <label class="form-label fw-bold">Language</label>
                                <select name="language" class="form-select form-select-solid">
                                    <option value="en" {{ $language === 'en' ? 'selected' : '' }}>English</option>
                                    <option value="bn" {{ $language === 'bn' ? 'selected' : '' }}>বাংলা</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold">Template</label>
                                <select name="template_name" class="form-select form-select-solid">
                                    @foreach ($templates as $key => $tpl)
                                        <option value="{{ $key }}" {{ $templateName === $key ? 'selected' : '' }}>
                                            {{ $tpl['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="form-label fw-bold">Include Sections</label>
                            <div class="d-flex flex-column gap-3">
                                @php
                                    $sections = [
                                        'personal_detail' => 'Personal Information',
                                        'educations' => 'Education',
                                        'experiences' => 'Experience',
                                        'skills' => 'Skills',
                                        'projects' => 'Projects',
                                        'languages' => 'Languages',
                                        'certifications' => 'Certifications',
                                    ];
                                @endphp
                                @foreach ($sections as $key => $label)
                                    <label class="d-flex align-items-center gap-3 p-3 border rounded cursor-pointer">
                                        <input type="checkbox" name="include[{{ $key }}]" value="1"
                                            class="form-check-input mt-0"
                                            {{ !empty($snapshot[$key === 'personal_detail' ? 'detail' : $key]) ? 'checked' : '' }}>
                                        <span class="fw-bold text-dark fs-7">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="separator mb-5"></div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Update & Save New Version
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="card card-flush">
                <div class="card-header pt-6">
                    <div class="card-title">
                        <h3>Current Snapshot Preview</h3>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4" style="transform-origin: top left; transform: scale(0.72); width: 138%;">
                        @include('page.admin.customer.cv.templates.' . $cv->template_name, [
                            's' => $cv->snapshot,
                            'isBn' => $cv->language === 'bn',
                        ])
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
