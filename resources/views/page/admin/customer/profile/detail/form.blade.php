@extends('layout.admin.adminLayout')

@section('page_title', 'Customer Profile')
@section('page_subtitle', 'Personal Information')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.profile.show', $customer->id) }}" class="btn btn-sm btn-light">
        ← Back</a>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <i class="fas fa-id-card text-primary me-2 fs-3"></i>
                        <h2>Personal Information — {{ $customer->name }}</h2>
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

                    <form method="POST" action="{{ route('admin.customers.profile.detail.update', $customer->id) }}"
                        class="form">
                        @csrf @method('PUT')

                        {{-- Section: Parents --}}
                        <div class="mb-2 fw-bolder text-muted fs-7 text-uppercase">Parents</div>
                        <div class="separator mb-5"></div>
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Father's Name</label>
                                <input type="text" name="father_name" class="form-control form-control-solid"
                                    value="{{ old('father_name', $detail->father_name ?? '') }}"
                                    placeholder="Father's full name">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">বাবার নাম (বাংলা)</label>
                                <input type="text" name="father_name_bn" class="form-control form-control-solid"
                                    value="{{ old('father_name_bn', $detail->father_name_bn ?? '') }}"
                                    placeholder="বাবার পুরো নাম">
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-sm-6">
                                <label class="form-label">Mother's Name</label>
                                <input type="text" name="mother_name" class="form-control form-control-solid"
                                    value="{{ old('mother_name', $detail->mother_name ?? '') }}"
                                    placeholder="Mother's full name">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">মায়ের নাম (বাংলা)</label>
                                <input type="text" name="mother_name_bn" class="form-control form-control-solid"
                                    value="{{ old('mother_name_bn', $detail->mother_name_bn ?? '') }}"
                                    placeholder="মায়ের পুরো নাম">
                            </div>
                        </div>

                        {{-- Section: Personal --}}
                        <div class="mb-2 fw-bolder text-muted fs-7 text-uppercase">Personal Details</div>
                        <div class="separator mb-5"></div>
                        <div class="row mb-5">
                            <div class="col-sm-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control form-control-solid"
                                    value="{{ old('date_of_birth', isset($detail->date_of_birth) ? $detail->date_of_birth->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select form-select-solid">
                                    <option value="">Select</option>
                                    @foreach (['male', 'female', 'other'] as $g)
                                        <option value="{{ $g }}"
                                            {{ old('gender', $detail->gender ?? '') === $g ? 'selected' : '' }}>
                                            {{ ucfirst($g) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Marital Status</label>
                                <select name="marital_status" class="form-select form-select-solid">
                                    <option value="">Select</option>
                                    @foreach (['single', 'married', 'divorced', 'widowed'] as $ms)
                                        <option value="{{ $ms }}"
                                            {{ old('marital_status', $detail->marital_status ?? '') === $ms ? 'selected' : '' }}>
                                            {{ ucfirst($ms) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Nationality</label>
                                <input type="text" name="nationality" class="form-control form-control-solid"
                                    value="{{ old('nationality', $detail->nationality ?? '') }}"
                                    placeholder="e.g. Bangladeshi">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">জাতীয়তা (বাংলা)</label>
                                <input type="text" name="nationality_bn" class="form-control form-control-solid"
                                    value="{{ old('nationality_bn', $detail->nationality_bn ?? '') }}"
                                    placeholder="যেমন: বাংলাদেশী">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Religion</label>
                                <input type="text" name="religion" class="form-control form-control-solid"
                                    value="{{ old('religion', $detail->religion ?? '') }}" placeholder="e.g. Islam, Hindu">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">ধর্ম (বাংলা)</label>
                                <input type="text" name="religion_bn" class="form-control form-control-solid"
                                    value="{{ old('religion_bn', $detail->religion_bn ?? '') }}"
                                    placeholder="যেমন: ইসলাম, হিন্দু">
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-sm-6">
                                <label class="form-label">NID Number</label>
                                <input type="text" name="nid_number" class="form-control form-control-solid"
                                    value="{{ old('nid_number', $detail->nid_number ?? '') }}"
                                    placeholder="National ID number">
                            </div>
                        </div>

                        {{-- Section: Professional --}}
                        <div class="mb-2 fw-bolder text-muted fs-7 text-uppercase">Professional</div>
                        <div class="separator mb-5"></div>
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <label class="form-label">Profession / Objective</label>
                                <input type="text" name="profession" class="form-control form-control-solid"
                                    value="{{ old('profession', $detail->profession ?? '') }}"
                                    placeholder="e.g. Software Engineer">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">পেশা (বাংলা)</label>
                                <input type="text" name="profession_bn" class="form-control form-control-solid"
                                    value="{{ old('profession_bn', $detail->profession_bn ?? '') }}"
                                    placeholder="যেমন: সফটওয়্যার ইঞ্জিনিয়ার">
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-sm-6">
                                <label class="form-label">Profile Summary</label>
                                <textarea name="profile_summary" class="form-control form-control-solid" rows="4"
                                    placeholder="Brief professional summary...">{{ old('profile_summary', $detail->profile_summary ?? '') }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">প্রোফাইল সারাংশ (বাংলা)</label>
                                <textarea name="profile_summary_bn" class="form-control form-control-solid" rows="4"
                                    placeholder="সংক্ষিপ্ত পরিচিতি...">{{ old('profile_summary_bn', $detail->profile_summary_bn ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Section: Online --}}
                        <div class="mb-2 fw-bolder text-muted fs-7 text-uppercase">Online Presence</div>
                        <div class="separator mb-5"></div>
                        <div class="row mb-7">
                            <div class="col-sm-4">
                                <label class="form-label">Website</label>
                                <input type="url" name="website"
                                    class="form-control form-control-solid @error('website') is-invalid @enderror"
                                    value="{{ old('website', $detail->website ?? '') }}"
                                    placeholder="https://yoursite.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">LinkedIn</label>
                                <input type="url" name="linkedin"
                                    class="form-control form-control-solid @error('linkedin') is-invalid @enderror"
                                    value="{{ old('linkedin', $detail->linkedin ?? '') }}"
                                    placeholder="https://linkedin.com/in/...">
                                @error('linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">GitHub</label>
                                <input type="url" name="github"
                                    class="form-control form-control-solid @error('github') is-invalid @enderror"
                                    value="{{ old('github', $detail->github ?? '') }}"
                                    placeholder="https://github.com/...">
                                @error('github')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.profile.show', $customer->id) }}"
                                class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Personal Information</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
