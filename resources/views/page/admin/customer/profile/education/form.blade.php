@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($education) ? 'Edit Education' : 'Add Education')
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
                        <h2>{{ isset($education) ? 'Edit' : 'Add' }} Education</h2>
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
                        action="{{ isset($education)
                            ? route('admin.customers.profile.education.update', [$customer->id, $education->id])
                            : route('admin.customers.profile.education.store', $customer->id) }}">
                        @csrf
                        @if (isset($education))
                            @method('PUT')
                        @endif

                        {{-- Degree --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Degree</label>
                                <input type="text" name="degree"
                                    class="form-control form-control-solid @error('degree') is-invalid @enderror"
                                    value="{{ old('degree', $education->degree ?? '') }}" placeholder="e.g. B.Sc, MBA">
                                @error('degree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">ডিগ্রি (বাংলা)</label>
                                <input type="text" name="degree_bn" class="form-control form-control-solid"
                                    value="{{ old('degree_bn', $education->degree_bn ?? '') }}"
                                    placeholder="যেমন: বিএসসি, এমবিএ">
                            </div>
                        </div>

                        {{-- Field of Study --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Field of Study</label>
                                <input type="text" name="field_of_study" class="form-control form-control-solid"
                                    value="{{ old('field_of_study', $education->field_of_study ?? '') }}"
                                    placeholder="e.g. Computer Science">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">বিষয় (বাংলা)</label>
                                <input type="text" name="field_of_study_bn" class="form-control form-control-solid"
                                    value="{{ old('field_of_study_bn', $education->field_of_study_bn ?? '') }}"
                                    placeholder="যেমন: কম্পিউটার বিজ্ঞান">
                            </div>
                        </div>

                        {{-- Institute --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Institute</label>
                                <input type="text" name="institute"
                                    class="form-control form-control-solid @error('institute') is-invalid @enderror"
                                    value="{{ old('institute', $education->institute ?? '') }}"
                                    placeholder="University / College name">
                                @error('institute')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রতিষ্ঠান (বাংলা)</label>
                                <input type="text" name="institute_bn" class="form-control form-control-solid"
                                    value="{{ old('institute_bn', $education->institute_bn ?? '') }}"
                                    placeholder="যেমন: ঢাকা বিশ্ববিদ্যালয়">
                            </div>
                        </div>

                        {{-- Result, Year --}}
                        <div class="row mb-5">
                            <div class="col-sm-4">
                                <label class="form-label">Result / GPA</label>
                                <input type="text" name="result" class="form-control form-control-solid"
                                    value="{{ old('result', $education->result ?? '') }}" placeholder="e.g. 3.80">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Start Year</label>
                                <input type="text" name="start_year" class="form-control form-control-solid"
                                    value="{{ old('start_year', $education->start_year ?? '') }}" placeholder="e.g. 2018">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">End Year</label>
                                <input type="text" name="end_year" class="form-control form-control-solid"
                                    value="{{ old('end_year', $education->end_year ?? '') }}" placeholder="e.g. 2022">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="3" placeholder="Additional details...">{{ old('description', $education->description ?? '') }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">বিবরণ (বাংলা)</label>
                                <textarea name="description_bn" class="form-control form-control-solid" rows="3" placeholder="অতিরিক্ত বিবরণ...">{{ old('description_bn', $education->description_bn ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($education) ? 'Update' : 'Save' }}
                                Education</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
