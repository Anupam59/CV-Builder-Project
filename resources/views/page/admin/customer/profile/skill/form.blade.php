@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($skill) ? 'Edit Skill' : 'Add Skill')
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
                        <h2>{{ isset($skill) ? 'Edit' : 'Add' }} Skill</h2>
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
                        action="{{ isset($skill)
                            ? route('admin.customers.profile.skill.update', [$customer->id, $skill->id])
                            : route('admin.customers.profile.skill.store', $customer->id) }}">
                        @csrf
                        @if (isset($skill))
                            @method('PUT')
                        @endif

                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Skill Name</label>
                                <input type="text" name="name"
                                    class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    value="{{ old('name', $skill->name ?? '') }}" placeholder="e.g. PHP, Photoshop">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">দক্ষতার নাম (বাংলা)</label>
                                <input type="text" name="name_bn" class="form-control form-control-solid"
                                    value="{{ old('name_bn', $skill->name_bn ?? '') }}" placeholder="যেমন: ফটোশপ">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="form-label">Level</label>
                            <select name="level" class="form-select form-select-solid">
                                <option value="">Select level</option>
                                @foreach (['beginner', 'intermediate', 'expert'] as $lvl)
                                    <option value="{{ $lvl }}"
                                        {{ old('level', $skill->level ?? '') === $lvl ? 'selected' : '' }}>
                                        {{ ucfirst($lvl) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($skill) ? 'Update' : 'Save' }}
                                Skill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
