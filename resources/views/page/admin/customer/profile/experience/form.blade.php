@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($experience) ? 'Edit Experience' : 'Add Experience')
@push('toolbar_actions')
    <a href="{{ route('admin.customers.profile.show', $customer->id) }}" class="btn btn-sm btn-light">
        ← Back</a>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <h2>{{ isset($experience) ? 'Edit' : 'Add' }} Experience</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-6">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST"
                        action="{{ isset($experience)
                            ? route('admin.customers.profile.experience.update', [$customer->id, $experience->id])
                            : route('admin.customers.profile.experience.store', $customer->id) }}">
                        @csrf
                        @if (isset($experience))
                            @method('PUT')
                        @endif

                        {{-- Job Title --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Job Title</label>
                                <input type="text" name="job_title"
                                    class="form-control form-control-solid @error('job_title') is-invalid @enderror"
                                    value="{{ old('job_title', $experience->job_title ?? '') }}"
                                    placeholder="e.g. Software Engineer">
                                @error('job_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">পদবি (বাংলা)</label>
                                <input type="text" name="job_title_bn" class="form-control form-control-solid"
                                    value="{{ old('job_title_bn', $experience->job_title_bn ?? '') }}"
                                    placeholder="যেমন: সফটওয়্যার ইঞ্জিনিয়ার">
                            </div>
                        </div>

                        {{-- Company Name --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Company Name</label>
                                <input type="text" name="company_name"
                                    class="form-control form-control-solid @error('company_name') is-invalid @enderror"
                                    value="{{ old('company_name', $experience->company_name ?? '') }}"
                                    placeholder="e.g. Google">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রতিষ্ঠানের নাম (বাংলা)</label>
                                <input type="text" name="company_name_bn" class="form-control form-control-solid"
                                    value="{{ old('company_name_bn', $experience->company_name_bn ?? '') }}"
                                    placeholder="যেমন: গুগল">
                            </div>
                        </div>

                        {{-- Employment Type, is_current --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Employment Type</label>
                                <select name="employment_type" class="form-select form-select-solid">
                                    <option value="">Select type</option>
                                    @foreach (['full-time', 'part-time', 'freelance', 'contract', 'internship'] as $type)
                                        <option value="{{ $type }}"
                                            {{ old('employment_type', $experience->employment_type ?? '') === $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Currently Working Here</label>
                                <div class="form-check form-switch form-check-custom form-check-solid mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_current" value="1"
                                        id="is_current"
                                        {{ old('is_current', $experience->is_current ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_current">Yes, currently working here</label>
                                </div>
                            </div>
                        </div>

                        {{-- Dates --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control form-control-solid"
                                    value="{{ old('start_date', isset($experience->start_date) ? $experience->start_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control form-control-solid"
                                    value="{{ old('end_date', isset($experience->end_date) ? $experience->end_date->format('Y-m-d') : '') }}">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="3"
                                    placeholder="Responsibilities, achievements...">{{ old('description', $experience->description ?? '') }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">বিবরণ (বাংলা)</label>
                                <textarea name="description_bn" class="form-control form-control-solid" rows="3" placeholder="দায়িত্ব, অর্জন...">{{ old('description_bn', $experience->description_bn ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($experience) ? 'Update' : 'Save' }}
                                Experience</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
