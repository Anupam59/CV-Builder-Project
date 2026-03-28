@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($certification) ? 'Edit Certification' : 'Add Certification')
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
                        <h2>{{ isset($certification) ? 'Edit' : 'Add' }} Certification</h2>
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
                        action="{{ isset($certification)
                            ? route('admin.customers.profile.certification.update', [$customer->id, $certification->id])
                            : route('admin.customers.profile.certification.store', $customer->id) }}">
                        @csrf
                        @if (isset($certification))
                            @method('PUT')
                        @endif

                        {{-- Title --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Certificate Title</label>
                                <input type="text" name="title"
                                    class="form-control form-control-solid @error('title') is-invalid @enderror"
                                    value="{{ old('title', $certification->title ?? '') }}"
                                    placeholder="e.g. AWS Certified Developer">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">সার্টিফিকেটের নাম (বাংলা)</label>
                                <input type="text" name="title_bn" class="form-control form-control-solid"
                                    value="{{ old('title_bn', $certification->title_bn ?? '') }}"
                                    placeholder="যেমন: এডব্লিউএস সার্টিফাইড">
                            </div>
                        </div>

                        {{-- Organization --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Issuing Organization</label>
                                <input type="text" name="organization" class="form-control form-control-solid"
                                    value="{{ old('organization', $certification->organization ?? '') }}"
                                    placeholder="e.g. Amazon, Google">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রতিষ্ঠানের নাম (বাংলা)</label>
                                <input type="text" name="organization_bn" class="form-control form-control-solid"
                                    value="{{ old('organization_bn', $certification->organization_bn ?? '') }}"
                                    placeholder="যেমন: আমাজন">
                            </div>
                        </div>

                        {{-- Dates & Credential --}}
                        <div class="row mb-5">
                            <div class="col-sm-4">
                                <label class="form-label">Issue Date</label>
                                <input type="date" name="issue_date" class="form-control form-control-solid"
                                    value="{{ old('issue_date', isset($certification->issue_date) ? $certification->issue_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" name="expiry_date" class="form-control form-control-solid"
                                    value="{{ old('expiry_date', isset($certification->expiry_date) ? $certification->expiry_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Credential ID</label>
                                <input type="text" name="credential_id" class="form-control form-control-solid"
                                    value="{{ old('credential_id', $certification->credential_id ?? '') }}"
                                    placeholder="ABC-12345">
                            </div>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($certification) ? 'Update' : 'Save' }}
                                Certification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
