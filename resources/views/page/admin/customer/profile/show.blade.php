@extends('layout.admin.adminLayout')

@section('page_title', 'Customer Profile')
@section('page_subtitle', $customer->name)

@push('toolbar_actions')
    <a href="{{ route('admin.cvs.create', ['customer_id' => $customer->id]) }}" class="btn btn-sm btn-success me-2">
        <i class="fas fa-file-alt me-1"></i> Create CV
    </a>
    <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-light">← Back</a>
@endpush

@section('content')

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center p-4 mb-5">
            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- ── Personal Info Card ── --}}
    <div class="card mb-6">
        <div class="card-header pt-6">
            <div class="card-title">
                <i class="fas fa-id-card text-primary me-2 fs-4"></i>
                <h3 class="mb-0">Personal Information</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.customers.profile.detail.edit', $customer->id) }}"
                    class="btn btn-sm btn-light-primary">
                    <i class="fas fa-pen me-1"></i>
                    {{ $customer->detail ? 'Edit' : 'Add' }} Personal Info
                </a>
            </div>
        </div>
        <div class="card-body pt-4">
            @if ($customer->detail)
                <div class="row g-4">
                    @php
                        $d = $customer->detail;
                        $fields = [
                            'Father Name' => $d->father_name,
                            'Mother Name' => $d->mother_name,
                            'Date of Birth' => $d->date_of_birth?->format('d M Y'),
                            'Gender' => $d->gender ? ucfirst($d->gender) : null,
                            'Marital Status' => $d->marital_status ? ucfirst($d->marital_status) : null,
                            'Nationality' => $d->nationality,
                            'Religion' => $d->religion,
                            'NID Number' => $d->nid_number,
                            'Profession' => $d->profession,
                            'Website' => $d->website,
                            'LinkedIn' => $d->linkedin,
                            'GitHub' => $d->github,
                        ];
                    @endphp
                    @foreach ($fields as $label => $value)
                        @if ($value)
                            <div class="col-sm-6 col-lg-4">
                                <div class="bg-light rounded p-3">
                                    <div class="text-muted fs-8 mb-1">{{ $label }}</div>
                                    <div class="text-dark fw-bold fs-7">{{ $value }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($d->profile_summary)
                        <div class="col-12">
                            <div class="bg-light rounded p-3">
                                <div class="text-muted fs-8 mb-1">Profile Summary</div>
                                <div class="text-dark fs-7">{{ $d->profile_summary }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center text-muted py-8">
                    <i class="fas fa-id-card fs-3x opacity-25 d-block mb-3"></i>
                    No personal information added yet.
                    <a href="{{ route('admin.customers.profile.detail.edit', $customer->id) }}"
                        class="text-primary ms-1">Add now →</a>
                </div>
            @endif
        </div>
    </div>

    <div class="row g-6">

        {{-- Education --}}
        <div class="col-12">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Education',
                'icon' => 'fas fa-graduation-cap',
                'color' => 'primary',
                'createRoute' => route('admin.customers.profile.education.create', $customer->id),
                'items' => $customer->educations,
                'empty' => 'No education records added yet.',
                'template' => 'education',
                'customer' => $customer,
            ])
        </div>

        {{-- Experience --}}
        <div class="col-12">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Experience',
                'icon' => 'fas fa-briefcase',
                'color' => 'success',
                'createRoute' => route('admin.customers.profile.experience.create', $customer->id),
                'items' => $customer->experiences,
                'empty' => 'No experience records added yet.',
                'template' => 'experience',
                'customer' => $customer,
            ])
        </div>

        {{-- Skills --}}
        <div class="col-xl-6">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Skills',
                'icon' => 'fas fa-tools',
                'color' => 'warning',
                'createRoute' => route('admin.customers.profile.skill.create', $customer->id),
                'items' => $customer->skills,
                'empty' => 'No skills added yet.',
                'template' => 'skill',
                'customer' => $customer,
            ])
        </div>

        {{-- Languages --}}
        <div class="col-xl-6">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Languages',
                'icon' => 'fas fa-language',
                'color' => 'info',
                'createRoute' => route('admin.customers.profile.language.create', $customer->id),
                'items' => $customer->languages,
                'empty' => 'No languages added yet.',
                'template' => 'language',
                'customer' => $customer,
            ])
        </div>

        {{-- Projects --}}
        <div class="col-12">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Projects',
                'icon' => 'fas fa-code',
                'color' => 'danger',
                'createRoute' => route('admin.customers.profile.project.create', $customer->id),
                'items' => $customer->projects,
                'empty' => 'No projects added yet.',
                'template' => 'project',
                'customer' => $customer,
            ])
        </div>

        {{-- Certifications --}}
        <div class="col-12">
            @include('page.admin.customer.profile.partials.section', [
                'title' => 'Certifications',
                'icon' => 'fas fa-certificate',
                'color' => 'dark',
                'createRoute' => route('admin.customers.profile.certification.create', $customer->id),
                'items' => $customer->certifications,
                'empty' => 'No certifications added yet.',
                'template' => 'certification',
                'customer' => $customer,
            ])
        </div>

    </div>
@endsection
