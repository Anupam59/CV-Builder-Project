@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($language) ? 'Edit Language' : 'Add Language')
@push('toolbar_actions')
    <a href="{{ route('admin.customers.profile.show', $customer->id) }}" class="btn btn-sm btn-light">
        ← Back</a>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <h2>{{ isset($language) ? 'Edit' : 'Add' }} Language</h2>
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
                        action="{{ isset($language)
                            ? route('admin.customers.profile.language.update', [$customer->id, $language->id])
                            : route('admin.customers.profile.language.store', $customer->id) }}">
                        @csrf
                        @if (isset($language))
                            @method('PUT')
                        @endif

                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Language</label>
                                <input type="text" name="name"
                                    class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    value="{{ old('name', $language->name ?? '') }}" placeholder="e.g. English, Bengali">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">ভাষা (বাংলা)</label>
                                <input type="text" name="name_bn" class="form-control form-control-solid"
                                    value="{{ old('name_bn', $language->name_bn ?? '') }}"
                                    placeholder="যেমন: ইংরেজি, বাংলা">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="form-label">Proficiency</label>
                            <select name="proficiency" class="form-select form-select-solid">
                                <option value="">Select level</option>
                                @foreach (['basic', 'conversational', 'fluent', 'native'] as $lvl)
                                    <option value="{{ $lvl }}"
                                        {{ old('proficiency', $language->proficiency ?? '') === $lvl ? 'selected' : '' }}>
                                        {{ ucfirst($lvl) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($language) ? 'Update' : 'Save' }}
                                Language</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
