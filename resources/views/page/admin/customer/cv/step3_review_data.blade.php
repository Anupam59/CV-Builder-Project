@extends('layout.admin.adminLayout')
@section('page_title', 'Create CV')
@section('page_subtitle', 'Step 3: Review & Save')

@section('content')
<div class="row g-6">

    {{-- Left: Form --}}
    <div class="col-xl-5">

        {{-- Step Indicator --}}
        <div class="d-flex flex-column gap-3 mb-6">
            <div class="d-flex align-items-center gap-3">
                <span class="w-30px h-30px rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bolder fs-8">✓</span>
                <span class="text-muted fs-7">Customer: <strong class="text-dark">{{ $customer->name }}</strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="w-30px h-30px rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bolder fs-8">✓</span>
                <span class="text-muted fs-7">Template: <strong class="text-dark">{{ $templates[$templateName]['name'] }}</strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="w-30px h-30px rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">3</span>
                <span class="fw-bold text-primary">Review & Save</span>
            </div>
        </div>

        <div class="card card-flush">
            <div class="card-header pt-6">
                <div class="card-title"><h3>Configure CV</h3></div>
            </div>
            <div class="card-body pt-5">
                <form method="POST" action="{{ route('admin.cvs.store') }}" id="cvForm">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <input type="hidden" name="template_name" value="{{ $templateName }}">
                    <input type="hidden" name="language" value="{{ $language }}">

                    <div class="mb-6">
                        <label class="form-label fw-bold">CV Title</label>
                        <input type="text" name="title" class="form-control form-control-solid"
                            value="{{ $customer->name }} - CV"
                            placeholder="e.g. John Doe - Software Engineer CV">
                    </div>

                    <div class="mb-6">
                        <label class="form-label fw-bold">Include Sections</label>
                        <div class="d-flex flex-column gap-3">

                            @php
                                $sections = [
                                    'personal_detail' => ['label' => 'Personal Information', 'icon' => 'fas fa-id-card', 'color' => 'primary',  'count' => $customer->detail ? 1 : 0],
                                    'educations'      => ['label' => 'Education',             'icon' => 'fas fa-graduation-cap', 'color' => 'primary',  'count' => $customer->educations->count()],
                                    'experiences'     => ['label' => 'Experience',            'icon' => 'fas fa-briefcase',      'color' => 'success',  'count' => $customer->experiences->count()],
                                    'skills'          => ['label' => 'Skills',                'icon' => 'fas fa-tools',          'color' => 'warning',  'count' => $customer->skills->count()],
                                    'projects'        => ['label' => 'Projects',              'icon' => 'fas fa-code',           'color' => 'danger',   'count' => $customer->projects->count()],
                                    'languages'       => ['label' => 'Languages',             'icon' => 'fas fa-language',       'color' => 'info',     'count' => $customer->languages->count()],
                                    'certifications'  => ['label' => 'Certifications',        'icon' => 'fas fa-certificate',    'color' => 'dark',     'count' => $customer->certifications->count()],
                                ];
                            @endphp

                            @foreach($sections as $key => $sec)
                                <label class="d-flex align-items-center gap-3 p-3 border rounded cursor-pointer section-toggle
                                    {{ $sec['count'] > 0 ? '' : 'opacity-50' }}">
                                    <input type="checkbox"
                                        name="include[{{ $key }}]"
                                        value="1"
                                        class="form-check-input section-check mt-0"
                                        {{ $sec['count'] > 0 ? 'checked' : 'disabled' }}>
                                    <i class="{{ $sec['icon'] }} text-{{ $sec['color'] }} fs-6"></i>
                                    <span class="fw-bold text-dark fs-7 flex-grow-1">{{ $sec['label'] }}</span>
                                    <span class="badge badge-light-{{ $sec['color'] }} fs-9">
                                        {{ $sec['count'] }} {{ $sec['count'] === 1 ? 'item' : 'items' }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="alert alert-warning p-4 mb-5">
                        <i class="fas fa-lock me-2"></i>
                        <strong>Note:</strong> Once saved, the CV will be locked. Use "Edit CV" to make changes later.
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.cvs.step2', ['customer_id' => $customer->id, 'template_name' => $templateName, 'language' => $language]) }}"
                            class="btn btn-light flex-grow-1">← Back</a>
                        <button type="submit" class="btn btn-success flex-grow-1">
                            <i class="fas fa-save me-2"></i> Save CV
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Right: Final Preview --}}
    <div class="col-xl-7">
        <div class="card card-flush">
            <div class="card-header pt-6">
                <div class="card-title">
                    <h3>Final Preview</h3>
                    <span class="badge badge-light-primary ms-3">{{ $templates[$templateName]['name'] }}</span>
                    <span class="badge badge-light-{{ $language === 'bn' ? 'warning' : 'info' }} ms-2">
                        {{ $language === 'bn' ? 'বাংলা' : 'English' }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="p-4" style="transform-origin: top left; transform: scale(0.72); width: 138%;">
                    @include('page.admin.customer.cv.templates.' . $templateName, [
                        's'    => $customer,
                        'isBn' => $language === 'bn',
                        'live' => true,
                    ])
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
