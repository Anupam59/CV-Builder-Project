@extends('layout.admin.adminLayout')
@section('page_title', 'Customer Profile')
@section('page_subtitle', isset($project) ? 'Edit Project' : 'Add Project')
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
                        <h2>{{ isset($project) ? 'Edit' : 'Add' }} Project</h2>
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
                        action="{{ isset($project)
                            ? route('admin.customers.profile.project.update', [$customer->id, $project->id])
                            : route('admin.customers.profile.project.store', $customer->id) }}">
                        @csrf
                        @if (isset($project))
                            @method('PUT')
                        @endif

                        {{-- Title --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label required">Project Title</label>
                                <input type="text" name="title"
                                    class="form-control form-control-solid @error('title') is-invalid @enderror"
                                    value="{{ old('title', $project->title ?? '') }}" placeholder="Project name">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রকল্পের নাম (বাংলা)</label>
                                <input type="text" name="title_bn" class="form-control form-control-solid"
                                    value="{{ old('title_bn', $project->title_bn ?? '') }}" placeholder="প্রকল্পের নাম">
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Your Role</label>
                                <input type="text" name="role" class="form-control form-control-solid"
                                    value="{{ old('role', $project->role ?? '') }}" placeholder="e.g. Lead Developer">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">আপনার ভূমিকা (বাংলা)</label>
                                <input type="text" name="role_bn" class="form-control form-control-solid"
                                    value="{{ old('role_bn', $project->role_bn ?? '') }}"
                                    placeholder="যেমন: প্রধান ডেভেলপার">
                            </div>
                        </div>

                        {{-- Technologies --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Technologies Used</label>
                                <input type="text" name="technologies" class="form-control form-control-solid"
                                    value="{{ old('technologies', $project->technologies ?? '') }}"
                                    placeholder="e.g. Laravel, Vue, MySQL">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রযুক্তি (বাংলা)</label>
                                <input type="text" name="technologies_bn" class="form-control form-control-solid"
                                    value="{{ old('technologies_bn', $project->technologies_bn ?? '') }}"
                                    placeholder="যেমন: লারাভেল, ভিউ">
                            </div>
                        </div>

                        {{-- URL --}}
                        <div class="mb-5">
                            <label class="form-label">Project URL</label>
                            <input type="url" name="project_url"
                                class="form-control form-control-solid @error('project_url') is-invalid @enderror"
                                value="{{ old('project_url', $project->project_url ?? '') }}" placeholder="https://...">
                            @error('project_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control form-control-solid" rows="3" placeholder="Project details...">{{ old('description', $project->description ?? '') }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">বিবরণ (বাংলা)</label>
                                <textarea name="description_bn" class="form-control form-control-solid" rows="3" placeholder="প্রকল্পের বিবরণ...">{{ old('description_bn', $project->description_bn ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($project) ? 'Update' : 'Save' }}
                                Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
