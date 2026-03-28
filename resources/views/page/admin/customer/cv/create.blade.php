@extends('layout.admin.adminLayout')

@section('page_title', 'Create CV')
@section('page_subtitle', $customer->name)

@push('toolbar_actions')
    <a href="{{ route('admin.customers.profile.show', $customer->id) }}" class="btn btn-sm btn-light">← Back to Profile</a>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">

            {{-- Data completeness warning --}}
            @if (!$customer->detail)
                <div class="alert alert-warning d-flex align-items-center p-4 mb-5">
                    <i class="fas fa-exclamation-triangle text-warning fs-4 me-3"></i>
                    <div>
                        Personal information is not added yet.
                        <a href="{{ route('admin.customers.profile.detail.edit', $customer->id) }}" class="fw-bold ms-1">Add
                            now →</a>
                    </div>
                </div>
            @endif

            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <i class="fas fa-file-alt text-success me-2 fs-3"></i>
                        <h2>Create CV for {{ $customer->name }}</h2>
                    </div>
                </div>
                <div class="card-body pt-5">

                    <form method="POST" action="{{ route('admin.cvs.store') }}">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                        <div class="row mb-6">
                            <div class="col-sm-8">
                                <label class="form-label">CV Title</label>
                                <input type="text" name="title" class="form-control form-control-solid"
                                    value="{{ old('title', $customer->name . ' - CV') }}"
                                    placeholder="e.g. John Doe - Software Engineer CV">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label required">Language</label>
                                <select name="language" class="form-select form-select-solid">
                                    <option value="en" {{ old('language') === 'en' ? 'selected' : '' }}>English</option>
                                    <option value="bn" {{ old('language') === 'bn' ? 'selected' : '' }}>বাংলা</option>
                                </select>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>

                        {{-- Preview of what will be included --}}
                        <div class="mb-4 fw-bold text-dark fs-6">
                            The following data will be included in the CV:
                        </div>

                        {{-- Personal Info --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light-primary rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-id-card text-primary fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Personal Information</div>
                                    <div class="text-muted fs-8">Name, contact, DOB, nationality etc.</div>
                                </div>
                            </div>
                            <span class="badge badge-light-{{ $customer->detail ? 'success' : 'warning' }}">
                                {{ $customer->detail ? 'Ready' : 'Missing' }}
                            </span>
                        </div>

                        {{-- Education --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-graduation-cap text-primary fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Education</div>
                                    <div class="text-muted fs-8">{{ $customer->educations->count() }} record(s)</div>
                                </div>
                            </div>
                            <span class="badge badge-light-{{ $customer->educations->count() ? 'success' : 'secondary' }}">
                                {{ $customer->educations->count() }} items
                            </span>
                        </div>

                        {{-- Experience --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-briefcase text-success fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Experience</div>
                                    <div class="text-muted fs-8">{{ $customer->experiences->count() }} record(s)</div>
                                </div>
                            </div>
                            <span
                                class="badge badge-light-{{ $customer->experiences->count() ? 'success' : 'secondary' }}">
                                {{ $customer->experiences->count() }} items
                            </span>
                        </div>

                        {{-- Skills --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-tools text-warning fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Skills</div>
                                    <div class="text-muted fs-8">{{ $customer->skills->count() }} skill(s)</div>
                                </div>
                            </div>
                            <span class="badge badge-light-{{ $customer->skills->count() ? 'success' : 'secondary' }}">
                                {{ $customer->skills->count() }} items
                            </span>
                        </div>

                        {{-- Languages --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-language text-info fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Languages</div>
                                    <div class="text-muted fs-8">{{ $customer->languages->count() }} language(s)</div>
                                </div>
                            </div>
                            <span class="badge badge-light-{{ $customer->languages->count() ? 'success' : 'secondary' }}">
                                {{ $customer->languages->count() }} items
                            </span>
                        </div>

                        {{-- Projects --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-code text-danger fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Projects</div>
                                    <div class="text-muted fs-8">{{ $customer->projects->count() }} project(s)</div>
                                </div>
                            </div>
                            <span class="badge badge-light-{{ $customer->projects->count() ? 'success' : 'secondary' }}">
                                {{ $customer->projects->count() }} items
                            </span>
                        </div>

                        {{-- Certifications --}}
                        <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded mb-6">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-certificate text-dark fs-4"></i>
                                <div>
                                    <div class="fw-bold text-dark">Certifications</div>
                                    <div class="text-muted fs-8">{{ $customer->certifications->count() }} certification(s)
                                    </div>
                                </div>
                            </div>
                            <span
                                class="badge badge-light-{{ $customer->certifications->count() ? 'success' : 'secondary' }}">
                                {{ $customer->certifications->count() }} items
                            </span>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-success btn-lg px-10">
                                <i class="fas fa-save me-2"></i> Generate & Save CV
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
