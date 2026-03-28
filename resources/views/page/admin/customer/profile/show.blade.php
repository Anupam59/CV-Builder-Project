@extends('layout.admin.adminLayout')

@section('page_title', 'Customer Profile')
@section('page_subtitle', $customer->name)

@push('toolbar_actions')
    <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-light btn-active-primary">
        ← Back to Customer
    </a>
@endpush

@section('content')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center p-4 mb-5">
            <i class="fas fa-check-circle text-success fs-4 me-3"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- Customer Info Bar --}}
    <div class="card mb-6">
        <div class="card-body py-4 d-flex align-items-center gap-5">
            <div class="symbol symbol-55px">
                <span class="symbol-label bg-light-info text-info fw-bolder fs-3">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                </span>
            </div>
            <div>
                <div class="text-dark fw-bolder fs-4">{{ $customer->name }}</div>
                <div class="text-muted fs-7">{{ $customer->phone }}
                    @if ($customer->email)
                        · {{ $customer->email }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6">

        {{-- ── EDUCATION ── --}}
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

        {{-- ── EXPERIENCE ── --}}
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

        {{-- ── SKILLS ── --}}
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

        {{-- ── LANGUAGES ── --}}
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

        {{-- ── PROJECTS ── --}}
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

        {{-- ── CERTIFICATIONS ── --}}
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
